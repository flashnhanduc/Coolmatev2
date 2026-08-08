<?php

namespace Database\Seeders;
use App\Models\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingMethods = [
            [
                'code' => 'standard',
                'name' => 'Giao hàng tiêu chuẩn',
                'base_fee' => 30000,
                'free_shipping_threshold' => 500000,
                'estimated_days' => '2-4 ngày',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'code' => 'express',
                'name' => 'Giao hàng nhanh',
                'base_fee' => 50000,
                'free_shipping_threshold' => null,
                'estimated_days' => '1-2 ngày',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'code' => 'economy',
                'name' => 'Giao hàng tiết kiệm',
                'base_fee' => 20000,
                'free_shipping_threshold' => 700000,
                'estimated_days' => '4-7 ngày',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($shippingMethods as $shippingMethod) {
            ShippingMethod::updateOrCreate(
                ['code' => $shippingMethod['code']],
                $shippingMethod
            );
        }
    }
}
