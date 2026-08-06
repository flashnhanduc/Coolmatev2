<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRelation extends Model
{
    protected $fillable = [
        'product_id',
        'related_product_id',
        'relation_type',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * Sản phẩm chính.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Sản phẩm được liên kết.
     */
    public function relatedProduct(): BelongsTo
    {
        return $this->belongsTo(
            Product::class,
            'related_product_id'
        );
    }
}
