<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductContentSection;
use Illuminate\Database\Seeder;

class ProductContentSectionSeeder extends Seeder
{
    public function run(): void
    {
        $productSections = [
            'CMMTS001' => [
                [
                    'title' => 'Thông tin sản phẩm',
                    'content' => '
                        <p>Áo thun Cotton Compact 2S có thiết kế đơn giản,
                        phù hợp để mặc hằng ngày.</p>
                        <ul>
                            <li>Kiểu dáng regular fit.</li>
                            <li>Chất liệu mềm mại và thoáng khí.</li>
                            <li>Phù hợp đi học, đi làm và đi chơi.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => true,
                ],
                [
                    'title' => 'Chất liệu và bảo quản',
                    'content' => '
                        <p>Sản phẩm sử dụng chất liệu Cotton Compact.</p>
                        <ul>
                            <li>Giặt máy ở chế độ nhẹ.</li>
                            <li>Không sử dụng chất tẩy mạnh.</li>
                            <li>Không phơi trực tiếp dưới nắng gắt.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => false,
                ],
            ],

            'CMMPLO001' => [
                [
                    'title' => 'Thông tin sản phẩm',
                    'content' => '
                        <p>Áo Polo thể thao ProMax được thiết kế dành cho
                        các hoạt động thể thao và sử dụng hằng ngày.</p>
                        <ul>
                            <li>Co giãn 4 chiều.</li>
                            <li>Thấm hút mồ hôi tốt.</li>
                            <li>Khô nhanh và thoáng khí.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => true,
                ],
                [
                    'title' => 'Hướng dẫn bảo quản',
                    'content' => '
                        <ul>
                            <li>Giặt sản phẩm với nước lạnh.</li>
                            <li>Không sử dụng nước tẩy.</li>
                            <li>Ủi ở nhiệt độ thấp.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => false,
                ],
            ],

            'CMMSH001' => [
                [
                    'title' => 'Thông tin sản phẩm',
                    'content' => '
                        <p>Quần shorts Active phù hợp cho chạy bộ,
                        tập gym và các hoạt động ngoài trời.</p>
                        <ul>
                            <li>Thiết kế thể thao năng động.</li>
                            <li>Túi khóa kéo an toàn.</li>
                            <li>Vải co giãn và nhanh khô.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => true,
                ],
                [
                    'title' => 'Hướng dẫn sử dụng',
                    'content' => '
                        <p>Lựa chọn đúng kích thước để sản phẩm mang lại
                        cảm giác thoải mái nhất khi vận động.</p>
                    ',
                    'image' => null,
                    'open_by_default' => false,
                ],
            ],

            'CMMJK001' => [
                [
                    'title' => 'Thông tin sản phẩm',
                    'content' => '
                        <p>Áo khoác thể thao chống nắng được thiết kế nhẹ,
                        tiện lợi và phù hợp hoạt động ngoài trời.</p>
                        <ul>
                            <li>Hỗ trợ chống tia UV.</li>
                            <li>Khả năng cản gió.</li>
                            <li>Dễ dàng gấp gọn và mang theo.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => true,
                ],
                [
                    'title' => 'Chất liệu và bảo quản',
                    'content' => '
                        <ul>
                            <li>Giặt riêng với sản phẩm khác màu.</li>
                            <li>Không dùng chất tẩy mạnh.</li>
                            <li>Phơi sản phẩm ở nơi thoáng mát.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => false,
                ],
            ],

            'CMWTS001' => [
                [
                    'title' => 'Thông tin sản phẩm',
                    'content' => '
                        <p>Áo thun nữ Cotton có kiểu dáng hiện đại,
                        mềm mại và dễ phối đồ.</p>
                        <ul>
                            <li>Phom áo thoải mái.</li>
                            <li>Chất liệu thoáng mát.</li>
                            <li>Phù hợp sử dụng hằng ngày.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => true,
                ],
                [
                    'title' => 'Hướng dẫn bảo quản',
                    'content' => '
                        <ul>
                            <li>Giặt máy ở chế độ nhẹ.</li>
                            <li>Không giặt chung với sản phẩm dễ ra màu.</li>
                            <li>Ủi ở nhiệt độ thấp.</li>
                        </ul>
                    ',
                    'image' => null,
                    'open_by_default' => false,
                ],
            ],
        ];

        foreach ($productSections as $productCode => $sections) {
            $product = Product::query()
                ->where('product_code', $productCode)
                ->firstOrFail();

            foreach ($sections as $index => $sectionData) {
                ProductContentSection::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'title' => $sectionData['title'],
                    ],
                    [
                        'content' => trim($sectionData['content']),
                        'image' => $sectionData['image'],
                        'sort_order' => $index + 1,
                        'open_by_default' =>
                            $sectionData['open_by_default'],
                    ]
                );
            }
        }
    }
}