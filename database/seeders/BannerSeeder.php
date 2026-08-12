<?php

namespace Database\Seeders;
use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'name' => 'homepage-main-banner',
                'location' => 'homepage_hero',
                'title' => 'Mặc đẹp mỗi ngày',
                'subtitle' =>
                    'Khám phá những sản phẩm mới nhất dành cho bạn.',
                'image_desktop' =>
                    'banners/homepage-main-desktop.webp',
                'image_mobile' =>
                    'banners/homepage-main-mobile.webp',
                'button_text' => 'Khám phá ngay',
                'link' => '/collections/san-pham-moi',
                'sort_order' => 1,
                'is_active' => true,
                'starts_at' => null,
                'ends_at' => null,
            ],
            [
                'name' => 'homepage-sports-banner',
                'location' => 'homepage_hero',
                'title' => 'Đồ thể thao năng động',
                'subtitle' =>
                    'Thoải mái vận động với chất liệu co giãn.',
                'image_desktop' =>
                    'banners/sports-desktop.webp',
                'image_mobile' =>
                    'banners/sports-mobile.webp',
                'button_text' => 'Mua ngay',
                'link' =>
                    '/collections/do-the-thao-nang-dong',
                'sort_order' => 2,
                'is_active' => true,
                'starts_at' => null,
                'ends_at' => null,
            ],
            [
                'name' => 'homepage-best-seller-banner',
                'location' => 'homepage_middle',
                'title' => 'Sản phẩm bán chạy',
                'subtitle' =>
                    'Những lựa chọn được khách hàng yêu thích.',
                'image_desktop' =>
                    'banners/best-seller-desktop.webp',
                'image_mobile' =>
                    'banners/best-seller-mobile.webp',
                'button_text' => 'Xem sản phẩm',
                'link' =>
                    '/collections/san-pham-ban-chay',
                'sort_order' => 1,
                'is_active' => true,
                'starts_at' => null,
                'ends_at' => null,
            ],
            [
                'name' => 'homepage-daily-wear-banner',
                'location' => 'homepage_middle',
                'title' => 'Trang phục hằng ngày',
                'subtitle' =>
                    'Thiết kế đơn giản, thoải mái và dễ phối đồ.',
                'image_desktop' =>
                    'banners/daily-wear-desktop.webp',
                'image_mobile' =>
                    'banners/daily-wear-mobile.webp',
                'button_text' => 'Khám phá',
                'link' =>
                    '/collections/trang-phuc-hang-ngay',
                'sort_order' => 2,
                'is_active' => true,
                'starts_at' => null,
                'ends_at' => null,
            ],
        ];

        foreach ($banners as $bannerData) {
            Banner::updateOrCreate(
                [
                    'name' => $bannerData['name'],
                ],
                $bannerData
            );
        }
    }
}