<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\RecentlyViewedProduct;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecentlyViewedProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->where('role', 'customer')
            ->firstOrFail();

        $visitorKey = 'user-' . $user->id;

        $viewedProducts = [
            [
                'product_code' => 'CMMTS001',
                'viewed_at' => now()->subMinutes(5),
            ],
            [
                'product_code' => 'CMMPLO001',
                'viewed_at' => now()->subMinutes(15),
            ],
            [
                'product_code' => 'CMMSH001',
                'viewed_at' => now()->subMinutes(30),
            ],
            [
                'product_code' => 'CMMJK001',
                'viewed_at' => now()->subHour(),
            ],
            [
                'product_code' => 'CMWTS001',
                'viewed_at' => now()->subHours(2),
            ],
        ];

        foreach ($viewedProducts as $viewedData) {
            $product = Product::query()
                ->where(
                    'product_code',
                    $viewedData['product_code']
                )
                ->firstOrFail();

            RecentlyViewedProduct::updateOrCreate(
                [
                    'visitor_key' => $visitorKey,
                    'product_id' => $product->id,
                ],
                [
                    'user_id' => $user->id,
                    'session_token' => null,
                    'viewed_at' => $viewedData['viewed_at'],
                ]
            );
        }
    }
}