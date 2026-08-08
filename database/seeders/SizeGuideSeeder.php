<?php

namespace Database\Seeders;

use App\Models\SizeGuide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeGuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $sizeGuides = [
            [
                'name' => 'Bảng size áo nam',
                'image' => null,
                'content' => '
                    <h3>Hướng dẫn chọn size áo nam</h3>
                    <ul>
                        <li>Size S: 45-55 kg</li>
                        <li>Size M: 55-65 kg</li>
                        <li>Size L: 65-75 kg</li>
                        <li>Size XL: 75-85 kg</li>
                        <li>Size 2XL: 85-95 kg</li>
                    </ul>
                ',
                'is_active' => true,
            ],
            [
                'name' => 'Bảng size quần nam',
                'image' => null,
                'content' => '
                    <h3>Hướng dẫn chọn size quần nam</h3>
                    <ul>
                        <li>Size S: Vòng eo 68-72 cm</li>
                        <li>Size M: Vòng eo 73-77 cm</li>
                        <li>Size L: Vòng eo 78-82 cm</li>
                        <li>Size XL: Vòng eo 83-87 cm</li>
                        <li>Size 2XL: Vòng eo 88-92 cm</li>
                    </ul>
                ',
                'is_active' => true,
            ],
            [
                'name' => 'Bảng size áo nữ',
                'image' => null,
                'content' => '
                    <h3>Hướng dẫn chọn size áo nữ</h3>
                    <ul>
                        <li>Size XS: 38-43 kg</li>
                        <li>Size S: 43-48 kg</li>
                        <li>Size M: 48-53 kg</li>
                        <li>Size L: 53-58 kg</li>
                        <li>Size XL: 58-65 kg</li>
                    </ul>
                ',
                'is_active' => true,
            ],
            [
                'name' => 'Bảng size quần nữ',
                'image' => null,
                'content' => '
                    <h3>Hướng dẫn chọn size quần nữ</h3>
                    <ul>
                        <li>Size XS: Vòng eo 58-62 cm</li>
                        <li>Size S: Vòng eo 63-67 cm</li>
                        <li>Size M: Vòng eo 68-72 cm</li>
                        <li>Size L: Vòng eo 73-77 cm</li>
                        <li>Size XL: Vòng eo 78-82 cm</li>
                    </ul>
                ',
                'is_active' => true,
            ],
        ];

        foreach ($sizeGuides as $sizeGuide) {
            SizeGuide::updateOrCreate(
                ['name' => $sizeGuide['name']],
                $sizeGuide
            );
        }
    }
}
