<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
  protected $fillable = [
        'order_id',
        'carrier',
        'tracking_number',
        'status',
        'fee',
        'tracking_payload',
        'shipped_at',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'fee' => 'integer',
            'tracking_payload' => 'array',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    /**
     * Kiện hàng này thuộc về một đơn hàng.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
