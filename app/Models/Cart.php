<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
      protected $fillable = [
        'user_id',
        'session_token',
        'coupon_id',
        'status',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    /**
     * Người dùng sở hữu giỏ hàng, nếu đã đăng nhập.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mã giảm giá đang được áp dụng cho giỏ hàng.
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
    public function items(): HasMany
{
    return $this->hasMany(CartItem::class);
}
}
