<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\ProductVariant;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $user = User::query()
                ->where('role', 'customer')
                ->firstOrFail();

            $coupon = Coupon::query()
                ->where('code', 'WELCOME10')
                ->firstOrFail();

            $shippingMethod = ShippingMethod::query()
                ->where('code', 'standard')
                ->firstOrFail();

            $paymentMethod = PaymentMethod::query()
                ->where('code', 'cod')
                ->firstOrFail();

            $itemDefinitions = [
                [
                    'sku' => 'CMMTS001-BLK-M',
                    'quantity' => 2,
                    'image' =>
                        'products/cmmts001/black-front.webp',
                ],
                [
                    'sku' => 'CMMPLO001-NVY-L',
                    'quantity' => 1,
                    'image' =>
                        'products/cmmpolo001/navy-front.webp',
                ],
            ];

            $preparedItems = [];
            $subtotal = 0;

            foreach ($itemDefinitions as $itemData) {
                $variant = ProductVariant::query()
                    ->with([
                        'product',
                        'color',
                        'size',
                    ])
                    ->where('sku', $itemData['sku'])
                    ->firstOrFail();

                $unitPrice = (int) $variant->price;
                $quantity = $itemData['quantity'];
                $lineTotal = $unitPrice * $quantity;

                $subtotal += $lineTotal;

                $preparedItems[] = [
                    'variant' => $variant,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                    'image' => $itemData['image'],
                ];
            }

            $productDiscountTotal = 0;
            $couponDiscountTotal = 0;

            $minimumOrderAmount =
                (int) ($coupon->minimum_order_amount ?? 0);

            if ($subtotal >= $minimumOrderAmount) {
                if ($coupon->discount_type === 'percent') {
                    $couponDiscountTotal = (int) round(
                        $subtotal
                        * (float) $coupon->discount_value
                        / 100
                    );

                    if ($coupon->maximum_discount !== null) {
                        $couponDiscountTotal = min(
                            $couponDiscountTotal,
                            (int) $coupon->maximum_discount
                        );
                    }
                }

                if ($coupon->discount_type === 'fixed') {
                    $couponDiscountTotal = min(
                        (int) $coupon->discount_value,
                        $subtotal
                    );
                }
            }

            $shippingFee = 30000;
            $taxTotal = 0;

            $grandTotal = $subtotal
                - $productDiscountTotal
                - $couponDiscountTotal
                + $shippingFee
                + $taxTotal;

            $order = Order::updateOrCreate(
                [
                    'order_number' => 'ORD-DEMO-000001',
                ],
                [
                    'user_id' => $user->id,
                    'coupon_id' => $coupon->id,
                    'shipping_method_id' =>
                        $shippingMethod->id,
                    'payment_method_id' =>
                        $paymentMethod->id,

                    'customer_name' => $user->name,
                    'customer_email' => $user->email,
                    'customer_phone' =>
                        $user->phone ?? '0900000002',

                    'status' => 'pending',
                    'payment_status' => 'unpaid',
                    'fulfillment_status' => 'unfulfilled',

                    'subtotal' => $subtotal,
                    'product_discount_total' =>
                        $productDiscountTotal,
                    'coupon_discount_total' =>
                        $couponDiscountTotal,
                    'shipping_fee' => $shippingFee,
                    'tax_total' => $taxTotal,
                    'grand_total' => $grandTotal,

                    'note' =>
                        'Đơn hàng mẫu được tạo từ seeder.',
                    'gift_message' => null,
                    'is_gift' => false,
                    'requires_invoice' => false,
                    'placed_at' => now(),
                    'cancelled_at' => null,
                ]
            );

            foreach ($preparedItems as $preparedItem) {
                $variant = $preparedItem['variant'];

                OrderItem::updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'product_variant_id' => $variant->id,
                    ],
                    [
                        'product_id' => $variant->product_id,
                        'product_name_snapshot' =>
                            $variant->product->name,
                        'sku_snapshot' => $variant->sku,

                        'variant_snapshot' => [
                            'color' =>
                                $variant->color?->name,
                            'size' =>
                                $variant->size?->name,
                        ],

                        'image_snapshot' =>
                            $preparedItem['image'],
                        'unit_price' =>
                            $preparedItem['unit_price'],
                        'discount_amount' => 0,
                        'quantity' =>
                            $preparedItem['quantity'],
                        'line_total' =>
                            $preparedItem['line_total'],
                    ]
                );
            }

            OrderAddress::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'type' => 'shipping',
                ],
                [
                    'recipient_name' => $user->name,
                    'phone' =>
                        $user->phone ?? '0900000002',
                    'province_code' => '79',
                    'province_name' =>
                        'Thành phố Hồ Chí Minh',
                    'district_code' => '769',
                    'district_name' =>
                        'Thành phố Thủ Đức',
                    'ward_code' => '26734',
                    'ward_name' => 'Phường Linh Trung',
                    'address_line' =>
                        '123 đường Võ Văn Ngân',
                ]
            );

            OrderAddress::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'type' => 'billing',
                ],
                [
                    'recipient_name' => $user->name,
                    'phone' =>
                        $user->phone ?? '0900000002',
                    'province_code' => '79',
                    'province_name' =>
                        'Thành phố Hồ Chí Minh',
                    'district_code' => '769',
                    'district_name' =>
                        'Thành phố Thủ Đức',
                    'ward_code' => '26734',
                    'ward_name' => 'Phường Linh Trung',
                    'address_line' =>
                        '123 đường Võ Văn Ngân',
                ]
            );
        });
    }
}