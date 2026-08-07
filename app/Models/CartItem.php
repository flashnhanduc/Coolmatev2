<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
  protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
        'unit_price_snapshot',
        'discount_snapshot',
        'is_selected',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'unit_price_snapshot' => 'integer',
            'discount_snapshot' => 'integer',
            'is_selected' => 'boolean',
        ];
    }

    /**
     * Sản phẩm này thuộc giỏ hàng nào.
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Biến thể sản phẩm được thêm vào giỏ.
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }
}
