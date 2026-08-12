<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Sản phẩm mới',
                'slug' => 'san-pham-moi',
                'description' =>
                    'Những sản phẩm mới nhất vừa được ra mắt.',
                'cover_image' => null,
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'product_codes' => [
                    'CMMTS001',
                    'CMMPLO001',
                    'CMMSH001',
                    'CMMJK001',
                    'CMWTS001',
                ],
            ],
            [
                'name' => 'Sản phẩm bán chạy',
                'slug' => 'san-pham-ban-chay',
                'description' =>
                    'Những sản phẩm được khách hàng yêu thích.',
                'cover_image' => null,
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'product_codes' => [
                    'CMMTS001',
                    'CMMPLO001',
                    'CMMSH001',
                ],
            ],
            [
                'name' => 'Đồ thể thao năng động',
                'slug' => 'do-the-thao-nang-dong',
                'description' =>
                    'Các sản phẩm phù hợp cho tập luyện và vận động.',
                'cover_image' => null,
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'product_codes' => [
                    'CMMPLO001',
                    'CMMSH001',
                    'CMMJK001',
                ],
            ],
            [
                'name' => 'Trang phục hằng ngày',
                'slug' => 'trang-phuc-hang-ngay',
                'description' =>
                    'Sản phẩm đơn giản, thoải mái và dễ phối đồ.',
                'cover_image' => null,
                'status' => 'active',
                'starts_at' => null,
                'ends_at' => null,
                'product_codes' => [
                    'CMMTS001',
                    'CMWTS001',
                    'CMMPLO001',
                ],
            ],
        ];

        foreach ($collections as $collectionData) {
            $productCodes = $collectionData['product_codes'];

            // product_codes chỉ dùng trong seeder, không phải cột database.
            unset($collectionData['product_codes']);

            $collection = Collection::updateOrCreate(
                [
                    'slug' => $collectionData['slug'],
                ],
                $collectionData
            );

            $productSync = [];

            foreach ($productCodes as $index => $productCode) {
                $product = Product::query()
                    ->where('product_code', $productCode)
                    ->firstOrFail();

                $productSync[$product->id] = [
                    'sort_order' => $index + 1,
                ];
            }

            $collection->products()->sync($productSync);
        }
    }
}