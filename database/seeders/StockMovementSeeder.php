<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockMovementSeeder extends Seeder
{
    public const UPDATED_AT = null;
    public function run(): void
    {
        
        DB::transaction(function () {
            $order = Order::query()
                ->with('items')
                ->where(
                    'order_number',
                    'ORD-DEMO-000001'
                )
                ->firstOrFail();

            $admin = User::query()
                ->where('role', 'admin')
                ->firstOrFail();

            foreach ($order->items as $orderItem) {
                $variant = ProductVariant::query()
                    ->lockForUpdate()
                    ->findOrFail(
                        $orderItem->product_variant_id
                    );

                $reference = $order->order_number
                    . '-RESERVE-'
                    . $variant->sku;

                $existingMovement = StockMovement::query()
                    ->where(
                        'product_variant_id',
                        $variant->id
                    )
                    ->where('reference', $reference)
                    ->where('type', 'reserve')
                    ->first();

                $oldReservedChange = (int) (
                    $existingMovement?->reserved_change ?? 0
                );

                // Bỏ phần giữ cũ rồi cộng lại số lượng mới.
                $reservedAfter = max(
                    0,
                    (int) $variant->reserved_quantity
                    - $oldReservedChange
                    + (int) $orderItem->quantity
                );

                StockMovement::updateOrCreate(
                    [
                        'product_variant_id' =>
                            $variant->id,
                        'reference' => $reference,
                        'type' => 'reserve',
                    ],
                    [
                        'order_id' => $order->id,
                        'stock_change' => 0,
                        'reserved_change' =>
                            $orderItem->quantity,
                        'stock_after' =>
                            $variant->stock_quantity,
                        'reserved_after' =>
                            $reservedAfter,
                        'note' =>
                            'Giữ hàng cho đơn '
                            . $order->order_number,
                        'created_by' => $admin->id,
                    ]
                );

                ProductVariant::query()
                    ->whereKey($variant->id)
                    ->update([
                        'reserved_quantity' =>
                            $reservedAfter,
                    ]);
            }
        });
    }
}