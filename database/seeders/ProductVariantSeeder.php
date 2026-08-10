<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $productVariantGroups = [
            [
                'product_code' => 'CMMTS001',
                'price' => 299000,
                'compare_at_price' => 349000,
                'cost_price' => 140000,
                'weight_grams' => 220,
                'colors' => [
                    ['slug' => 'den', 'sku_code' => 'BLK'],
                    ['slug' => 'trang', 'sku_code' => 'WHT'],
                    ['slug' => 'xanh-navy', 'sku_code' => 'NVY'],
                ],
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'product_code' => 'CMMPLO001',
                'price' => 399000,
                'compare_at_price' => 449000,
                'cost_price' => 190000,
                'weight_grams' => 280,
                'colors' => [
                    ['slug' => 'den', 'sku_code' => 'BLK'],
                    ['slug' => 'trang', 'sku_code' => 'WHT'],
                    ['slug' => 'xanh-navy', 'sku_code' => 'NVY'],
                ],
                'sizes' => ['M', 'L', 'XL'],
            ],
            [
                'product_code' => 'CMMSH001',
                'price' => 329000,
                'compare_at_price' => 379000,
                'cost_price' => 160000,
                'weight_grams' => 250,
                'colors' => [
                    ['slug' => 'den', 'sku_code' => 'BLK'],
                    ['slug' => 'xam', 'sku_code' => 'GRY'],
                    ['slug' => 'xanh-navy', 'sku_code' => 'NVY'],
                ],
                'sizes' => ['M', 'L', 'XL'],
            ],
            [
                'product_code' => 'CMMJK001',
                'price' => 499000,
                'compare_at_price' => 599000,
                'cost_price' => 250000,
                'weight_grams' => 380,
                'colors' => [
                    ['slug' => 'den', 'sku_code' => 'BLK'],
                    ['slug' => 'xanh-navy', 'sku_code' => 'NVY'],
                ],
                'sizes' => ['M', 'L', 'XL'],
            ],
            [
                'product_code' => 'CMWTS001',
                'price' => 279000,
                'compare_at_price' => 329000,
                'cost_price' => 130000,
                'weight_grams' => 200,
                'colors' => [
                    ['slug' => 'trang', 'sku_code' => 'WHT'],
                    ['slug' => 'hong', 'sku_code' => 'PNK'],
                    ['slug' => 'den', 'sku_code' => 'BLK'],
                ],
                'sizes' => ['XS', 'S', 'M', 'L'],
            ],
        ];

        foreach ($productVariantGroups as $group) {
            $product = Product::query()
                ->where('product_code', $group['product_code'])
                ->firstOrFail();

            foreach ($group['colors'] as $colorData) {
                $color = Color::query()
                    ->where('slug', $colorData['slug'])
                    ->firstOrFail();

                foreach ($group['sizes'] as $sizeCode) {
                    $size = Size::query()
                        ->where('code', $sizeCode)
                        ->firstOrFail();

                    $sku = $product->product_code
                        . '-'
                        . $colorData['sku_code']
                        . '-'
                        . $sizeCode;

                    ProductVariant::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'color_id' => $color->id,
                            'size_id' => $size->id,
                        ],
                        [
                            'sku' => $sku,
                            'barcode' => null,
                            'price' => $group['price'],
                            'compare_at_price' =>
                                $group['compare_at_price'],
                            'cost_price' => $group['cost_price'],
                            'stock_quantity' => 30,
                            'low_stock_threshold' => 5,
                            'weight_grams' => $group['weight_grams'],
                            'status' => 'active',
                        ]
                    );
                }
            }
        }
    }
}