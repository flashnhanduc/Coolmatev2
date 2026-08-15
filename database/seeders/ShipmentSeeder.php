<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $order = Order::query()
                ->where(
                    'order_number',
                    'ORD-DEMO-000001'
                )
                ->firstOrFail();

            Shipment::updateOrCreate(
                [
                    'tracking_number' =>
                        'GHN-DEMO-000001',
                ],
                [
                    'order_id' => $order->id,
                    'carrier' => 'GHN',
                    'status' => 'pending',
                    'fee' => $order->shipping_fee,

                    'tracking_payload' => [
                        'source' => 'database_seeder',
                        'service' => 'standard',
                        'message' =>
                            'Đang chờ đơn vị vận chuyển lấy hàng.',
                    ],

                    'shipped_at' => null,
                    'delivered_at' => null,
                ]
            );
        });
    }
}