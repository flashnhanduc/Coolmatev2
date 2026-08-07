<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderAddress extends Model
{
   protected $fillable = [
        'order_id',
        'type',
        'recipient_name',
        'phone',
        'province_code',
        'province_name',
        'district_code',
        'district_name',
        'ward_code',
        'ward_name',
        'address_line',
    ];

    /**
     * Địa chỉ này thuộc về một đơn hàng.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
