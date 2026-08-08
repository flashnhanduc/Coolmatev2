<?php

namespace Database\Seeders;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $sizes = [
            [
                'name' => 'Không phân loại size',
                'code' => 'ONE_SIZE',
                'sort_order' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Extra Small',
                'code' => 'XS',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Small',
                'code' => 'S',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Medium',
                'code' => 'M',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Large',
                'code' => 'L',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Extra Large',
                'code' => 'XL',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Double Extra Large',
                'code' => '2XL',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Triple Extra Large',
                'code' => '3XL',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($sizes as $size) {
            Size::updateOrCreate(
                ['code' => $size['code']],
                $size
            );
        }
    
    }
}
