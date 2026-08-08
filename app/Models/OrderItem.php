<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
  protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'product_name_snapshot',
        'sku_snapshot',
        'variant_snapshot',
        'image_snapshot',
        'unit_price',
        'discount_amount',
        'quantity',
        'line_total',
    ];

    protected function casts(): array
    {
        return [
            'variant_snapshot' => 'array',
            'unit_price' => 'integer',
            'discount_amount' => 'integer',
            'quantity' => 'integer',
            'line_total' => 'integer',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Sản phẩm hiện tại, có thể null nếu sản phẩm đã bị xóa.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Biến thể hiện tại, có thể null nếu biến thể đã bị xóa.
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }
    public function review(): HasOne
{
    return $this->hasOne(Review::class);    
}
}
