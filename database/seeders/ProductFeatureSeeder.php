<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductFeature;
use Illuminate\Database\Seeder;

class ProductFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $productFeatures = [
            'CMMTS001' => [
                [
                    'name' => 'Cotton Compact mềm mại',
                    'icon' => 'cotton',
                    'description' =>
                        'Chất liệu Cotton Compact mềm mại và thoáng khí.',
                ],
                [
                    'name' => 'Co giãn thoải mái',
                    'icon' => 'stretch',
                    'description' =>
                        'Vải co giãn giúp người mặc vận động dễ dàng.',
                ],
                [
                    'name' => 'Giữ form tốt',
                    'icon' => 'shirt',
                    'description' =>
                        'Sản phẩm ít nhăn và giữ được form sau nhiều lần giặt.',
                ],
            ],

            'CMMPLO001' => [
                [
                    'name' => 'Thấm hút nhanh',
                    'icon' => 'water',
                    'description' =>
                        'Khả năng thấm hút mồ hôi tốt khi vận động.',
                ],
                [
                    'name' => 'Nhanh khô',
                    'icon' => 'quick-dry',
                    'description' =>
                        'Chất liệu giúp sản phẩm khô nhanh hơn.',
                ],
                [
                    'name' => 'Co giãn 4 chiều',
                    'icon' => 'stretch',
                    'description' =>
                        'Hỗ trợ vận động linh hoạt theo nhiều hướng.',
                ],
            ],

            'CMMSH001' => [
                [
                    'name' => 'Co giãn linh hoạt',
                    'icon' => 'stretch',
                    'description' =>
                        'Phù hợp cho chạy bộ, tập gym và hoạt động hằng ngày.',
                ],
                [
                    'name' => 'Túi khóa kéo an toàn',
                    'icon' => 'pocket',
                    'description' =>
                        'Giúp bảo quản điện thoại và vật dụng cá nhân.',
                ],
                [
                    'name' => 'Thoáng khí',
                    'icon' => 'wind',
                    'description' =>
                        'Hạn chế cảm giác nóng bí khi vận động.',
                ],
            ],

            'CMMJK001' => [
                [
                    'name' => 'Chống tia UV',
                    'icon' => 'sun',
                    'description' =>
                        'Hỗ trợ bảo vệ da khi hoạt động ngoài trời.',
                ],
                [
                    'name' => 'Trọng lượng nhẹ',
                    'icon' => 'feather',
                    'description' =>
                        'Thiết kế nhẹ, dễ mặc và dễ mang theo.',
                ],
                [
                    'name' => 'Cản gió',
                    'icon' => 'wind',
                    'description' =>
                        'Giúp hạn chế ảnh hưởng của gió khi di chuyển.',
                ],
            ],

            'CMWTS001' => [
                [
                    'name' => 'Mềm mại với làn da',
                    'icon' => 'cotton',
                    'description' =>
                        'Chất liệu mềm mại, phù hợp sử dụng hằng ngày.',
                ],
                [
                    'name' => 'Thoáng mát',
                    'icon' => 'wind',
                    'description' =>
                        'Giúp người mặc cảm thấy thoải mái trong thời tiết nóng.',
                ],
                [
                    'name' => 'Giữ form tốt',
                    'icon' => 'shirt',
                    'description' =>
                        'Hạn chế biến dạng sau nhiều lần sử dụng.',
                ],
            ],
        ];

        foreach ($productFeatures as $productCode => $features) {
            $product = Product::query()
                ->where('product_code', $productCode)
                ->firstOrFail();

            foreach ($features as $index => $featureData) {
                ProductFeature::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $featureData['name'],
                    ],
                    [
                        'icon' => $featureData['icon'],
                        'description' =>
                            $featureData['description'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }
    }
}