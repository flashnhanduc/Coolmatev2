<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    protected $fillable = [
        'name',
        'promotion_type',
        'label',
        'discount_value',
        'minimum_order_amount',
        'maximum_discount',
        'is_stackable',
        'rules',
        'status',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'discount_value' => 'decimal:2',
            'minimum_order_amount' => 'integer',
            'maximum_discount' => 'integer',
            'is_stackable' => 'boolean',
            'rules' => 'array',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    /**
     * Những sản phẩm được áp dụng khuyến mãi.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'promotion_product'
        );
    }

    /**
     * Những danh mục được áp dụng khuyến mãi.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'promotion_category'
        );
    }
    public function tiers(): HasMany
{
    return $this->hasMany(PromotionTier::class)
        ->orderBy('minimum_quantity');
}
}
