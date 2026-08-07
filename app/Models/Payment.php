<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
   protected $fillable = [
        'order_id',
        'payment_method_id',
        'provider_transaction_id',
        'amount',
        'status',
        'provider_payload',
        'paid_at',
        'failed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'provider_payload' => 'array',
            'paid_at' => 'datetime',
            'failed_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
