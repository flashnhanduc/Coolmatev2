<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Collection;
use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'main_banner',
                'type' => 'banner',
                'banner_name' => 'homepage-main-banner',
                'collection_slug' => null,
                'title' => null,
                'subtitle' => null,
                'settings' => [
                    'full_width' => true,
                    'show_title' => false,
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'section_key' => 'new_products',
                'type' => 'collection',
                'banner_name' => null,
                'collection_slug' => 'san-pham-moi',
                'title' => 'Sản phẩm mới',
                'subtitle' =>
                    'Khám phá những sản phẩm mới nhất dành cho bạn.',
                'settings' => [
                    'product_limit' => 8,
                    'columns_desktop' => 4,
                    'columns_mobile' => 2,
                    'show_view_all' => true,
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'section_key' => 'sports_banner',
                'type' => 'banner',
                'banner_name' => 'homepage-sports-banner',
                'collection_slug' => null,
                'title' => null,
                'subtitle' => null,
                'settings' => [
                    'full_width' => true,
                    'show_title' => false,
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'section_key' => 'best_selling_products',
                'type' => 'collection',
                'banner_name' => null,
                'collection_slug' => 'san-pham-ban-chay',
                'title' => 'Sản phẩm bán chạy',
                'subtitle' =>
                    'Những sản phẩm được khách hàng yêu thích.',
                'settings' => [
                    'product_limit' => 8,
                    'columns_desktop' => 4,
                    'columns_mobile' => 2,
                    'show_view_all' => true,
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'section_key' => 'best_seller_banner',
                'type' => 'banner',
                'banner_name' =>
                    'homepage-best-seller-banner',
                'collection_slug' => null,
                'title' => null,
                'subtitle' => null,
                'settings' => [
                    'full_width' => false,
                    'show_title' => false,
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'section_key' => 'sports_products',
                'type' => 'collection',
                'banner_name' => null,
                'collection_slug' =>
                    'do-the-thao-nang-dong',
                'title' => 'Đồ thể thao năng động',
                'subtitle' =>
                    'Trang phục thoải mái dành cho tập luyện và vận động.',
                'settings' => [
                    'product_limit' => 8,
                    'columns_desktop' => 4,
                    'columns_mobile' => 2,
                    'show_view_all' => true,
                ],
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $sectionData) {
            $bannerId = null;
            $collectionId = null;

            if ($sectionData['banner_name'] !== null) {
                $banner = Banner::query()
                    ->where(
                        'name',
                        $sectionData['banner_name']
                    )
                    ->firstOrFail();

                $bannerId = $banner->id;
            }

            if ($sectionData['collection_slug'] !== null) {
                $collection = Collection::query()
                    ->where(
                        'slug',
                        $sectionData['collection_slug']
                    )
                    ->firstOrFail();

                $collectionId = $collection->id;
            }

            // Hai trường này chỉ dùng để tìm dữ liệu liên quan.
            unset(
                $sectionData['banner_name'],
                $sectionData['collection_slug']
            );

            $sectionData['banner_id'] = $bannerId;
            $sectionData['collection_id'] = $collectionId;

            HomepageSection::updateOrCreate(
                [
                    'section_key' =>
                        $sectionData['section_key'],
                ],
                $sectionData
            );
        }
    }
}