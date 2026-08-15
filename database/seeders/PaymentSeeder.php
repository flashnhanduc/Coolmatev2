<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
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

            $paymentMethod = PaymentMethod::query()
                ->where('code', 'cod')
                ->firstOrFail();

            Payment::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'payment_method_id' =>
                        $paymentMethod->id,
                ],
                [
                    'provider_transaction_id' => null,
                    'amount' => $order->grand_total,
                    'status' => 'pending',

                    'provider_payload' => [
                        'source' => 'database_seeder',
                        'method' => 'cash_on_delivery',
                        'message' =>
                            'Thanh toán khi nhận hàng.',
                    ],

                    'paid_at' => null,
                    'failed_at' => null,
                ]
            );
        });
    }
}