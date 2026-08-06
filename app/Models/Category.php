<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
   protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
        'sort_order',
        'is_active',
        'show_in_menu',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'show_in_menu' => 'boolean',
        ];
    }

    /**
     * Danh mục cha của danh mục hiện tại.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
public function primaryProducts(): HasMany
{
    return $this->hasMany(
        Product::class,
        'primary_category_id'
    );
}

/**
 * Những sản phẩm thuộc danh mục này.
 */
public function products(): BelongsToMany
{
    return $this->belongsToMany(
        Product::class,
        'category_product'
    )
        ->withPivot('sort_order')
        ->orderByPivot('sort_order');
}
    /**
     * Danh sách danh mục con.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('sort_order');
    }
    public function promotions(): BelongsToMany
{
    return $this->belongsToMany(
        Promotion::class,
        'promotion_category'
    );
}
}
