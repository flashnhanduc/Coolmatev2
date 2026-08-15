<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $order = Order::query()
                ->with([
                    'user',
                    'items.product',
                ])
                ->where(
                    'order_number',
                    'ORD-DEMO-000001'
                )
                ->firstOrFail();

            if ($order->user === null) {
                throw new RuntimeException(
                    'Đơn hàng mẫu không có người dùng.'
                );
            }

            $reviewData = [
                'CMMTS001' => [
                    'rating' => 5,
                    'title' => 'Áo mặc rất thoải mái',
                    'content' =>
                        'Chất vải mềm, thoáng mát và form áo vừa vặn. '
                        . 'Sản phẩm phù hợp để mặc hằng ngày.',
                ],
                'CMMPLO001' => [
                    'rating' => 4,
                    'title' => 'Chất liệu tốt, dễ vận động',
                    'content' =>
                        'Áo co giãn tốt, thấm hút nhanh và mặc khá '
                        . 'thoải mái khi vận động.',
                ],
            ];

            $affectedProductIds = [];

            foreach ($order->items as $orderItem) {
                $product = $orderItem->product;

                if ($product === null) {
                    continue;
                }

                $productCode = $product->product_code;

                if (! isset($reviewData[$productCode])) {
                    continue;
                }

                $data = $reviewData[$productCode];

                Review::updateOrCreate(
                    [
                        'order_item_id' => $orderItem->id,
                    ],
                    [
                        'product_id' => $product->id,
                        'user_id' => $order->user_id,
                        'rating' => $data['rating'],
                        'title' => $data['title'],
                        'content' => $data['content'],
                        'is_verified_purchase' => true,
                        'status' => 'approved',
                        'published_at' => now(),
                    ]
                );

                $affectedProductIds[] = $product->id;
            }

            foreach (
                array_unique($affectedProductIds)
                as $productId
            ) {
                $reviewQuery = Review::query()
                    ->where('product_id', $productId)
                    ->where('status', 'approved')
                    ->whereNotNull('published_at');

                $reviewsCount = $reviewQuery->count();

                $ratingAverage = $reviewsCount > 0
                    ? round(
                        (float) $reviewQuery->avg('rating'),
                        2
                    )
                    : 0;

                Product::query()
                    ->whereKey($productId)
                    ->update([
                        'reviews_count' => $reviewsCount,
                        'rating_average' => $ratingAverage,
                    ]);
            }
        });
    }
}