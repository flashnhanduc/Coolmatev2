<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CouponUsageSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $order = Order::query()
                ->with([
                    'user',
                    'coupon',
                ])
                ->where(
                    'order_number',
                    'ORD-DEMO-000001'
                )
                ->firstOrFail();

            if ($order->coupon === null) {
                throw new RuntimeException(
                    'Đơn hàng mẫu chưa được áp dụng coupon.'
                );
            }

            CouponUsage::updateOrCreate(
                [
                    'order_id' => $order->id,
                ],
                [
                    'coupon_id' => $order->coupon_id,
                    'user_id' => $order->user_id,
                    'discount_amount' =>
                        $order->coupon_discount_total,
                    'used_at' =>
                        $order->placed_at ?? now(),
                ]
            );

            $usedCount = CouponUsage::query()
                ->where('coupon_id', $order->coupon_id)
                ->count();

            Coupon::query()
                ->whereKey($order->coupon_id)
                ->update([
                    'used_count' => $usedCount,
                ]);
        });
    }
}