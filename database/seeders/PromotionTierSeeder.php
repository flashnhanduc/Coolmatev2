<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\PromotionTier;
use Illuminate\Database\Seeder;

class PromotionTierSeeder extends Seeder
{
    public function run(): void
    {
        $promotion = Promotion::query()
            ->where('name', 'Mua nhiều giảm nhiều')
            ->where('promotion_type', 'tiered')
            ->firstOrFail();

        $tiers = [
            [
                'minimum_quantity' => 2,
                'discount_type' => 'percent',
                'discount_value' => 5,
            ],
            [
                'minimum_quantity' => 3,
                'discount_type' => 'percent',
                'discount_value' => 10,
            ],
            [
                'minimum_quantity' => 5,
                'discount_type' => 'percent',
                'discount_value' => 15,
            ],
        ];

        foreach ($tiers as $tierData) {
            PromotionTier::updateOrCreate(
                [
                    'promotion_id' => $promotion->id,
                    'minimum_quantity' =>
                        $tierData['minimum_quantity'],
                ],
                [
                    'discount_type' =>
                        $tierData['discount_type'],
                    'discount_value' =>
                        $tierData['discount_value'],
                ]
            );
        }
    }
}