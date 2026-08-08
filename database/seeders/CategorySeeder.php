<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        /*
         * Danh mục cha phải đứng trước danh mục con
         * để lấy được parent_id.
         */
        $categories = [
            [
                'name' => 'Thời trang nam',
                'slug' => 'thoi-trang-nam',
                'parent_slug' => null,
                'sort_order' => 1,
            ],
            [
                'name' => 'Áo nam',
                'slug' => 'ao-nam',
                'parent_slug' => 'thoi-trang-nam',
                'sort_order' => 1,
            ],
            [
                'name' => 'Áo thun nam',
                'slug' => 'ao-thun-nam',
                'parent_slug' => 'ao-nam',
                'sort_order' => 1,
            ],
            [
                'name' => 'Áo polo nam',
                'slug' => 'ao-polo-nam',
                'parent_slug' => 'ao-nam',
                'sort_order' => 2,
            ],
            [
                'name' => 'Áo sơ mi nam',
                'slug' => 'ao-so-mi-nam',
                'parent_slug' => 'ao-nam',
                'sort_order' => 3,
            ],
            [
                'name' => 'Áo khoác nam',
                'slug' => 'ao-khoac-nam',
                'parent_slug' => 'ao-nam',
                'sort_order' => 4,
            ],
            [
                'name' => 'Quần nam',
                'slug' => 'quan-nam',
                'parent_slug' => 'thoi-trang-nam',
                'sort_order' => 2,
            ],
            [
                'name' => 'Quần dài nam',
                'slug' => 'quan-dai-nam',
                'parent_slug' => 'quan-nam',
                'sort_order' => 1,
            ],
            [
                'name' => 'Quần shorts nam',
                'slug' => 'quan-shorts-nam',
                'parent_slug' => 'quan-nam',
                'sort_order' => 2,
            ],
            [
                'name' => 'Đồ lót nam',
                'slug' => 'do-lot-nam',
                'parent_slug' => 'thoi-trang-nam',
                'sort_order' => 3,
            ],
            [
                'name' => 'Đồ thể thao nam',
                'slug' => 'do-the-thao-nam',
                'parent_slug' => 'thoi-trang-nam',
                'sort_order' => 4,
            ],
            [
                'name' => 'Thời trang nữ',
                'slug' => 'thoi-trang-nu',
                'parent_slug' => null,
                'sort_order' => 2,
            ],
            [
                'name' => 'Áo nữ',
                'slug' => 'ao-nu',
                'parent_slug' => 'thoi-trang-nu',
                'sort_order' => 1,
            ],
            [
                'name' => 'Quần nữ',
                'slug' => 'quan-nu',
                'parent_slug' => 'thoi-trang-nu',
                'sort_order' => 2,
            ],
            [
                'name' => 'Phụ kiện',
                'slug' => 'phu-kien',
                'parent_slug' => null,
                'sort_order' => 3,
            ],
            [
                'name' => 'Tất và vớ',
                'slug' => 'tat-va-vo',
                'parent_slug' => 'phu-kien',
                'sort_order' => 1,
            ],
            [
                'name' => 'Mũ và nón',
                'slug' => 'mu-va-non',
                'parent_slug' => 'phu-kien',
                'sort_order' => 2,
            ],
            [
                'name' => 'Túi',
                'slug' => 'tui',
                'parent_slug' => 'phu-kien',
                'sort_order' => 3,
            ],
        ];

        $categoryIds = [];

        foreach ($categories as $categoryData) {
            $parentSlug = $categoryData['parent_slug'];

            $parentId = $parentSlug !== null
                ? $categoryIds[$parentSlug]
                : null;

            unset($categoryData['parent_slug']);

            $categoryData['parent_id'] = $parentId;
            $categoryData['description'] = null;
            $categoryData['image'] = null;
            $categoryData['is_active'] = true;
            $categoryData['show_in_menu'] = true;

            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            $categoryIds[$category->slug] = $category->id;
        }
    }
}