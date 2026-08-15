<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $user = User::query()
                ->where('role', 'customer')
                ->firstOrFail();

            $wishlist = Wishlist::updateOrCreate(
                [
                    'user_id' => $user->id,
                ]
            );

            $variantSkus = [
                'CMMJK001-NVY-L',
                'CMWTS001-PNK-S',
                'CMMSH001-BLK-M',
            ];

            foreach ($variantSkus as $variantSku) {
                $variant = ProductVariant::query()
                    ->where('sku', $variantSku)
                    ->firstOrFail();

                WishlistItem::updateOrCreate(
                    [
                        'wishlist_id' => $wishlist->id,
                        'product_id' => $variant->product_id,
                    ],
                    [
                        'preferred_variant_id' =>
                            $variant->id,
                    ]
                );
            }
        });
    }
}