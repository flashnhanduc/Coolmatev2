<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Database\Seeder;

class ReviewImageSeeder extends Seeder
{
    public function run(): void
    {
        $reviewImages = [
            'CMMTS001' => [
                'reviews/cmmts001/customer-review-1.webp',
                'reviews/cmmts001/customer-review-2.webp',
            ],
            'CMMPLO001' => [
                'reviews/cmmpolo001/customer-review-1.webp',
            ],
        ];

        foreach (
            $reviewImages as $productCode => $imagePaths
        ) {
            $product = Product::query()
                ->where('product_code', $productCode)
                ->firstOrFail();

            $review = Review::query()
                ->where('product_id', $product->id)
                ->where('status', 'approved')
                ->firstOrFail();

            foreach ($imagePaths as $index => $imagePath) {
                ReviewImage::updateOrCreate(
                    [
                        'review_id' => $review->id,
                        'path' => $imagePath,
                    ],
                    [
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }
    }
}