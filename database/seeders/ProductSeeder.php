<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SizeGuide;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Áo thun Cotton Compact 2S',
                'slug' => 'ao-thun-cotton-compact-2s',
                'product_code' => 'CMMTS001',
                'primary_category_slug' => 'ao-thun-nam',
                'category_slugs' => [
                    'thoi-trang-nam',
                    'ao-nam',
                    'ao-thun-nam',
                ],
                'size_guide_name' => 'Bảng size áo nam',
                'short_description' =>
                    'Áo thun cotton mềm mại, thoáng khí và co giãn.',
                'description' =>
                    '<p>Áo thun nam sử dụng chất liệu Cotton Compact, phù hợp mặc hằng ngày.</p>',
                'material' => '95% Cotton Compact, 5% Spandex',
                'fit' => 'Regular Fit',
                'origin' => 'Việt Nam',
                'care_instructions' =>
                    'Giặt máy ở nhiệt độ thường, không sử dụng chất tẩy mạnh.',
                'audience' => 'men',
                'status' => 'active',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'name' => 'Áo Polo thể thao ProMax',
                'slug' => 'ao-polo-the-thao-promax',
                'product_code' => 'CMMPLO001',
                'primary_category_slug' => 'ao-polo-nam',
                'category_slugs' => [
                    'thoi-trang-nam',
                    'ao-nam',
                    'ao-polo-nam',
                    'do-the-thao-nam',
                ],
                'size_guide_name' => 'Bảng size áo nam',
                'short_description' =>
                    'Áo polo thể thao co giãn, thoát ẩm và nhanh khô.',
                'description' =>
                    '<p>Thiết kế polo lịch sự kết hợp chất liệu thể thao thoáng khí.</p>',
                'material' => 'Polyester và Spandex',
                'fit' => 'Athletic Fit',
                'origin' => 'Việt Nam',
                'care_instructions' =>
                    'Giặt nhẹ, không sấy ở nhiệt độ cao.',
                'audience' => 'men',
                'status' => 'active',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'name' => 'Quần shorts thể thao Active',
                'slug' => 'quan-shorts-the-thao-active',
                'product_code' => 'CMMSH001',
                'primary_category_slug' => 'quan-shorts-nam',
                'category_slugs' => [
                    'thoi-trang-nam',
                    'quan-nam',
                    'quan-shorts-nam',
                    'do-the-thao-nam',
                ],
                'size_guide_name' => 'Bảng size quần nam',
                'short_description' =>
                    'Quần shorts nhẹ, co giãn và phù hợp luyện tập.',
                'description' =>
                    '<p>Quần shorts thể thao có túi khóa kéo và lớp vải nhanh khô.</p>',
                'material' => '90% Polyester, 10% Spandex',
                'fit' => 'Regular Fit',
                'origin' => 'Việt Nam',
                'care_instructions' =>
                    'Giặt với sản phẩm cùng màu, không dùng chất tẩy.',
                'audience' => 'men',
                'status' => 'active',
                'is_featured' => true,
                'published_at' => now(),
            ],
            [
                'name' => 'Áo khoác thể thao chống nắng',
                'slug' => 'ao-khoac-the-thao-chong-nang',
                'product_code' => 'CMMJK001',
                'primary_category_slug' => 'ao-khoac-nam',
                'category_slugs' => [
                    'thoi-trang-nam',
                    'ao-nam',
                    'ao-khoac-nam',
                    'do-the-thao-nam',
                ],
                'size_guide_name' => 'Bảng size áo nam',
                'short_description' =>
                    'Áo khoác nhẹ, chống nắng và phù hợp hoạt động ngoài trời.',
                'description' =>
                    '<p>Áo khoác có khả năng chống tia UV và thoát ẩm tốt.</p>',
                'material' => 'Polyester',
                'fit' => 'Regular Fit',
                'origin' => 'Việt Nam',
                'care_instructions' =>
                    'Giặt nhẹ bằng nước lạnh, không ủi trực tiếp.',
                'audience' => 'men',
                'status' => 'active',
                'is_featured' => false,
                'published_at' => now(),
            ],
            [
                'name' => 'Áo thun nữ Cotton mềm mại',
                'slug' => 'ao-thun-nu-cotton-mem-mai',
                'product_code' => 'CMWTS001',
                'primary_category_slug' => 'ao-nu',
                'category_slugs' => [
                    'thoi-trang-nu',
                    'ao-nu',
                ],
                'size_guide_name' => 'Bảng size áo nữ',
                'short_description' =>
                    'Áo thun nữ mềm mại, nhẹ và dễ phối đồ.',
                'description' =>
                    '<p>Thiết kế tối giản, phù hợp mặc hằng ngày.</p>',
                'material' => '95% Cotton, 5% Spandex',
                'fit' => 'Slim Fit',
                'origin' => 'Việt Nam',
                'care_instructions' =>
                    'Giặt nhẹ, lộn trái sản phẩm trước khi giặt.',
                'audience' => 'women',
                'status' => 'active',
                'is_featured' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($products as $productData) {
            $primaryCategory = Category::query()
                ->where(
                    'slug',
                    $productData['primary_category_slug']
                )
                ->firstOrFail();

            $sizeGuide = SizeGuide::query()
                ->where(
                    'name',
                    $productData['size_guide_name']
                )
                ->firstOrFail();

            $categorySlugs = $productData['category_slugs'];

            unset(
                $productData['primary_category_slug'],
                $productData['category_slugs'],
                $productData['size_guide_name']
            );

            $productData['primary_category_id'] =
                $primaryCategory->id;

            $productData['size_guide_id'] =
                $sizeGuide->id;

            $product = Product::updateOrCreate(
                [
                    'product_code' =>
                        $productData['product_code'],
                ],
                $productData
            );

            $categorySync = [];

            foreach ($categorySlugs as $index => $categorySlug) {
                $category = Category::query()
                    ->where('slug', $categorySlug)
                    ->firstOrFail();

                $categorySync[$category->id] = [
                    'sort_order' => $index + 1,
                ];
            }

            $product->categories()->sync($categorySync);
        }
    }
}