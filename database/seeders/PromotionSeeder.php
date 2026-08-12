<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        $promotions = [
            [
                'name' => 'Giảm 10% toàn bộ sản phẩm',
                'promotion_type' => 'percent',
                'label' => 'Giảm 10%',
                'discount_value' => 10,
                'minimum_order_amount' => 300000,
                'maximum_discount' => 100000,
                'is_stackable' => false,
                'rules' => [
                    'applies_to' => 'all_products',
                    'customer_group' => 'all',
                ],
                'status' => 'active',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()
                    ->addMonths(3)
                    ->endOfDay(),
            ],
            [
                'name' => 'Giảm 50.000đ cho đơn từ 499.000đ',
                'promotion_type' => 'fixed',
                'label' => 'Giảm 50K',
                'discount_value' => 50000,
                'minimum_order_amount' => 499000,
                'maximum_discount' => null,
                'is_stackable' => false,
                'rules' => [
                    'applies_to' => 'all_products',
                    'customer_group' => 'all',
                ],
                'status' => 'active',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()
                    ->addMonths(3)
                    ->endOfDay(),
            ],
            [
                'name' => 'Mua nhiều giảm nhiều',
                'promotion_type' => 'tiered',
                'label' => 'Mua nhiều giảm nhiều',
                'discount_value' => null,
                'minimum_order_amount' => null,
                'maximum_discount' => null,
                'is_stackable' => false,
                'rules' => [
                    'applies_to' => 'selected_products',
                    'calculation_basis' => 'product_quantity',
                ],
                'status' => 'active',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()
                    ->addMonths(3)
                    ->endOfDay(),
            ],
        ];

        foreach ($promotions as $promotionData) {
            Promotion::updateOrCreate(
                [
                    'name' => $promotionData['name'],
                ],
                $promotionData
            );
        }
    }
}