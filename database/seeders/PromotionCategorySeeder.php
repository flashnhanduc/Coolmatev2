<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $promotion = Promotion::query()
            ->where('name', 'Mua nhiều giảm nhiều')
            ->where('promotion_type', 'tiered')
            ->firstOrFail();

        $categorySlugs = [
            'ao-thun-nam',
            'ao-polo-nam',
            'quan-shorts-nam',
            'ao-thun-nu',
        ];

        $categoryIds = Category::query()
            ->whereIn('slug', $categorySlugs)
            ->pluck('id')
            ->all();

        $promotion->categories()->sync($categoryIds);
    }
}