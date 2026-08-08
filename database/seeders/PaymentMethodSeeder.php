<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $paymentMethods = [
            [
                'code' => 'cod',
                'name' => 'Thanh toán khi nhận hàng',
                'provider' => null,
                'logo' => null,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'code' => 'bank_transfer',
                'name' => 'Chuyển khoản ngân hàng',
                'provider' => 'Bank Transfer',
                'logo' => null,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'code' => 'vnpay',
                'name' => 'Thanh toán qua VNPay',
                'provider' => 'VNPay',
                'logo' => null,
                'is_active' => false,
                'sort_order' => 3,
            ],
            [
                'code' => 'momo',
                'name' => 'Thanh toán qua MoMo',
                'provider' => 'MoMo',
                'logo' => null,
                'is_active' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::updateOrCreate(
                ['code' => $paymentMethod['code']],
                $paymentMethod
            );
        }
    }
}
