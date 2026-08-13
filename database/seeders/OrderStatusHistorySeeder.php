<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderStatusHistorySeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::query()
            ->where('order_number', 'ORD-DEMO-000001')
            ->firstOrFail();

        $admin = User::query()
            ->where('role', 'admin')
            ->firstOrFail();

        OrderStatusHistory::updateOrCreate(
            [
                'order_id' => $order->id,
                'status_type' => 'order_status',
                'to_status' => 'pending',
            ],
            [
                'from_status' => null,
                'note' => 'Đơn hàng đã được tạo thành công.',
                'changed_by' => $admin->id,
            ]
        );
    }
}