<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'name' => 'Giảm 10% cho khách hàng mới',
                'discount_type' => 'percent',
                'discount_value' => 10,
                'minimum_order_amount' => 199000,
                'maximum_discount' => 50000,
                'usage_limit' => 1000,
                'per_user_limit' => 1,
                'status' => 'active',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()
                    ->addMonths(6)
                    ->endOfDay(),
            ],
            [
                'code' => 'COOL50K',
                'name' => 'Giảm 50.000đ cho đơn từ 499.000đ',
                'discount_type' => 'fixed',
                'discount_value' => 50000,
                'minimum_order_amount' => 499000,
                'maximum_discount' => null,
                'usage_limit' => 500,
                'per_user_limit' => 2,
                'status' => 'active',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()
                    ->addMonths(3)
                    ->endOfDay(),
            ],
            [
                'code' => 'SPORT15',
                'name' => 'Giảm 15% sản phẩm thể thao',
                'discount_type' => 'percent',
                'discount_value' => 15,
                'minimum_order_amount' => 599000,
                'maximum_discount' => 150000,
                'usage_limit' => 300,
                'per_user_limit' => 1,
                'status' => 'active',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()
                    ->addMonths(2)
                    ->endOfDay(),
            ],
            [
                'code' => 'VIP100K',
                'name' => 'Giảm 100.000đ cho đơn từ 999.000đ',
                'discount_type' => 'fixed',
                'discount_value' => 100000,
                'minimum_order_amount' => 999000,
                'maximum_discount' => null,
                'usage_limit' => 100,
                'per_user_limit' => 1,
                'status' => 'active',
                'starts_at' => now()->startOfDay(),
                'ends_at' => now()
                    ->addMonth()
                    ->endOfDay(),
            ],
        ];

        foreach ($coupons as $couponData) {
            Coupon::updateOrCreate(
                [
                    'code' => $couponData['code'],
                ],
                $couponData
            );
        }
    }
}