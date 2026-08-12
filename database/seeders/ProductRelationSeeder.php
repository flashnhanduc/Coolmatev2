<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductRelation;
use Illuminate\Database\Seeder;

class ProductRelationSeeder extends Seeder
{
    public function run(): void
    {
        $relations = [
            [
                'product_code' => 'CMMTS001',
                'related_product_code' => 'CMMPLO001',
                'relation_type' => 'similar',
                'sort_order' => 1,
            ],
            [
                'product_code' => 'CMMTS001',
                'related_product_code' => 'CMMSH001',
                'relation_type' => 'frequently_bought_together',
                'sort_order' => 2,
            ],
            [
                'product_code' => 'CMMPLO001',
                'related_product_code' => 'CMMTS001',
                'relation_type' => 'similar',
                'sort_order' => 1,
            ],
            [
                'product_code' => 'CMMPLO001',
                'related_product_code' => 'CMMSH001',
                'relation_type' => 'frequently_bought_together',
                'sort_order' => 2,
            ],
            [
                'product_code' => 'CMMSH001',
                'related_product_code' => 'CMMPLO001',
                'relation_type' => 'frequently_bought_together',
                'sort_order' => 1,
            ],
            [
                'product_code' => 'CMMSH001',
                'related_product_code' => 'CMMJK001',
                'relation_type' => 'related',
                'sort_order' => 2,
            ],
            [
                'product_code' => 'CMMJK001',
                'related_product_code' => 'CMMSH001',
                'relation_type' => 'frequently_bought_together',
                'sort_order' => 1,
            ],
            [
                'product_code' => 'CMMJK001',
                'related_product_code' => 'CMMPLO001',
                'relation_type' => 'related',
                'sort_order' => 2,
            ],
            [
                'product_code' => 'CMWTS001',
                'related_product_code' => 'CMMTS001',
                'relation_type' => 'similar',
                'sort_order' => 1,
            ],
        ];

        foreach ($relations as $relationData) {
            $product = Product::query()
                ->where(
                    'product_code',
                    $relationData['product_code']
                )
                ->firstOrFail();

            $relatedProduct = Product::query()
                ->where(
                    'product_code',
                    $relationData['related_product_code']
                )
                ->firstOrFail();

            ProductRelation::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'related_product_id' => $relatedProduct->id,
                    'relation_type' =>
                        $relationData['relation_type'],
                ],
                [
                    'sort_order' => $relationData['sort_order'],
                ]
            );
        }
    }
}