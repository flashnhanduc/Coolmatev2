<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()
            ->where('role', 'customer')
            ->firstOrFail();

        $coupon = Coupon::query()
            ->where('code', 'WELCOME10')
            ->where('status', 'active')
            ->firstOrFail();

        $cart = Cart::updateOrCreate(
            [
                'user_id' => $user->id,
                'status' => 'active',
            ],
            [
                // Người dùng đã đăng nhập nên không cần session_token.
                'session_token' => null,
                'coupon_id' => $coupon->id,
                'expires_at' => now()->addDays(7),
            ]
        );

        $items = [
            [
                'sku' => 'CMMTS001-BLK-M',
                'quantity' => 2,
                'discount_snapshot' => 0,
                'is_selected' => true,
            ],
            [
                'sku' => 'CMMPLO001-NVY-L',
                'quantity' => 1,
                'discount_snapshot' => 0,
                'is_selected' => true,
            ],
            [
                'sku' => 'CMMSH001-GRY-M',
                'quantity' => 1,
                'discount_snapshot' => 0,
                'is_selected' => false,
            ],
        ];

        foreach ($items as $itemData) {
            $variant = ProductVariant::query()
                ->where('sku', $itemData['sku'])
                ->firstOrFail();

            CartItem::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_variant_id' => $variant->id,
                ],
                [
                    'quantity' => $itemData['quantity'],
                    'unit_price_snapshot' => $variant->price,
                    'discount_snapshot' =>
                        $itemData['discount_snapshot'],
                    'is_selected' =>
                        $itemData['is_selected'],
                ]
            );
        }
    }
}