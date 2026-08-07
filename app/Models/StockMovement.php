<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'product_variant_id',
        'order_id',
        'type',
        'stock_change',
        'reserved_change',
        'stock_after',
        'reserved_after',
        'reference',
        'note',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'stock_change' => 'integer',
            'reserved_change' => 'integer',
            'stock_after' => 'integer',
            'reserved_after' => 'integer',
        ];
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Người thực hiện thay đổi tồn kho.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}
