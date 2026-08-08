<?php

namespace Database\Seeders;
use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $colors = [
            [
                'name' => 'Không phân loại màu',
                'slug' => 'one-color',
                'hex_code' => null,
                'swatch_image' => null,
                'sort_order' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Đen',
                'slug' => 'den',
                'hex_code' => '#000000',
                'swatch_image' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Trắng',
                'slug' => 'trang',
                'hex_code' => '#FFFFFF',
                'swatch_image' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Xám',
                'slug' => 'xam',
                'hex_code' => '#808080',
                'swatch_image' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Xanh navy',
                'slug' => 'xanh-navy',
                'hex_code' => '#000080',
                'swatch_image' => null,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Xanh dương',
                'slug' => 'xanh-duong',
                'hex_code' => '#2563EB',
                'swatch_image' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Xanh lá',
                'slug' => 'xanh-la',
                'hex_code' => '#16A34A',
                'swatch_image' => null,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Đỏ',
                'slug' => 'do',
                'hex_code' => '#DC2626',
                'swatch_image' => null,
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Be',
                'slug' => 'be',
                'hex_code' => '#F5F5DC',
                'swatch_image' => null,
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Nâu',
                'slug' => 'nau',
                'hex_code' => '#8B4513',
                'swatch_image' => null,
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Hồng',
                'slug' => 'hong',
                'hex_code' => '#FFC0CB',
                'swatch_image' => null,
                'sort_order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($colors as $color) {
            Color::updateOrCreate(
                ['slug' => $color['slug']],
                $color
            );
        }
    }
    }

