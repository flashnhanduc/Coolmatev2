<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'primary_category_id',
        'size_guide_id',
        'name',
        'slug',
        'product_code',
        'short_description',
        'description',
        'material',
        'fit',
        'origin',
        'care_instructions',
        'audience',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'rating_average' => 'decimal:2',
            'reviews_count' => 'integer',
            'sold_count' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Danh mục chính của sản phẩm.
     */
    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'primary_category_id'
        );
    }

    /**
     * Bảng hướng dẫn chọn size của sản phẩm.
     */
    public function sizeGuide(): BelongsTo
    {
        return $this->belongsTo(SizeGuide::class);
    }
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
    /**
     * Một sản phẩm có thể nằm trong nhiều danh mục.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_product'
        )
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)
            ->orderByDesc('is_primary')
            ->orderBy('sort_order');
    }
    public function features(): HasMany
    {
        return $this->hasMany(ProductFeature::class)
            ->orderBy('sort_order');
    }
}
