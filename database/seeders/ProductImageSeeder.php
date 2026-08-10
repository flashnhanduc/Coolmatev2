<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $productImages = [
            'CMMTS001' => [
                [
                    'color_slug' => 'den',
                    'path' => 'products/cmmts001/black-front.webp',
                    'alt_text' => 'Áo thun Cotton Compact màu đen mặt trước',
                    'is_primary' => true,
                    'sort_order' => 1,
                ],
                [
                    'color_slug' => 'den',
                    'path' => 'products/cmmts001/black-back.webp',
                    'alt_text' => 'Áo thun Cotton Compact màu đen mặt sau',
                    'is_primary' => false,
                    'sort_order' => 2,
                ],
                [
                    'color_slug' => 'trang',
                    'path' => 'products/cmmts001/white-front.webp',
                    'alt_text' => 'Áo thun Cotton Compact màu trắng',
                    'is_primary' => false,
                    'sort_order' => 3,
                ],
                [
                    'color_slug' => 'xanh-navy',
                    'path' => 'products/cmmts001/navy-front.webp',
                    'alt_text' => 'Áo thun Cotton Compact màu xanh navy',
                    'is_primary' => false,
                    'sort_order' => 4,
                ],
            ],

            'CMMPLO001' => [
                [
                    'color_slug' => 'den',
                    'path' => 'products/cmmpolo001/black-front.webp',
                    'alt_text' => 'Áo Polo ProMax màu đen',
                    'is_primary' => true,
                    'sort_order' => 1,
                ],
                [
                    'color_slug' => 'trang',
                    'path' => 'products/cmmpolo001/white-front.webp',
                    'alt_text' => 'Áo Polo ProMax màu trắng',
                    'is_primary' => false,
                    'sort_order' => 2,
                ],
                [
                    'color_slug' => 'xanh-navy',
                    'path' => 'products/cmmpolo001/navy-front.webp',
                    'alt_text' => 'Áo Polo ProMax màu xanh navy',
                    'is_primary' => false,
                    'sort_order' => 3,
                ],
            ],

            'CMMSH001' => [
                [
                    'color_slug' => 'den',
                    'path' => 'products/cmmsh001/black-front.webp',
                    'alt_text' => 'Quần shorts Active màu đen',
                    'is_primary' => true,
                    'sort_order' => 1,
                ],
                [
                    'color_slug' => 'xam',
                    'path' => 'products/cmmsh001/gray-front.webp',
                    'alt_text' => 'Quần shorts Active màu xám',
                    'is_primary' => false,
                    'sort_order' => 2,
                ],
                [
                    'color_slug' => 'xanh-navy',
                    'path' => 'products/cmmsh001/navy-front.webp',
                    'alt_text' => 'Quần shorts Active màu xanh navy',
                    'is_primary' => false,
                    'sort_order' => 3,
                ],
            ],

            'CMMJK001' => [
                [
                    'color_slug' => 'den',
                    'path' => 'products/cmmjk001/black-front.webp',
                    'alt_text' => 'Áo khoác chống nắng màu đen',
                    'is_primary' => true,
                    'sort_order' => 1,
                ],
                [
                    'color_slug' => 'den',
                    'path' => 'products/cmmjk001/black-back.webp',
                    'alt_text' => 'Áo khoác chống nắng màu đen mặt sau',
                    'is_primary' => false,
                    'sort_order' => 2,
                ],
                [
                    'color_slug' => 'xanh-navy',
                    'path' => 'products/cmmjk001/navy-front.webp',
                    'alt_text' => 'Áo khoác chống nắng màu xanh navy',
                    'is_primary' => false,
                    'sort_order' => 3,
                ],
            ],

            'CMWTS001' => [
                [
                    'color_slug' => 'trang',
                    'path' => 'products/cmwts001/white-front.webp',
                    'alt_text' => 'Áo thun nữ Cotton màu trắng',
                    'is_primary' => true,
                    'sort_order' => 1,
                ],
                [
                    'color_slug' => 'hong',
                    'path' => 'products/cmwts001/pink-front.webp',
                    'alt_text' => 'Áo thun nữ Cotton màu hồng',
                    'is_primary' => false,
                    'sort_order' => 2,
                ],
                [
                    'color_slug' => 'den',
                    'path' => 'products/cmwts001/black-front.webp',
                    'alt_text' => 'Áo thun nữ Cotton màu đen',
                    'is_primary' => false,
                    'sort_order' => 3,
                ],
            ],
        ];

        foreach ($productImages as $productCode => $images) {
            $product = Product::query()
                ->where('product_code', $productCode)
                ->firstOrFail();

            foreach ($images as $imageData) {
                $color = Color::query()
                    ->where('slug', $imageData['color_slug'])
                    ->firstOrFail();

                ProductImage::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'path' => $imageData['path'],
                    ],
                    [
                        'product_variant_id' => null,
                        'color_id' => $color->id,
                        'alt_text' => $imageData['alt_text'],
                        'is_primary' => $imageData['is_primary'],
                        'sort_order' => $imageData['sort_order'],
                    ]
                );
            }
        }
    }
}