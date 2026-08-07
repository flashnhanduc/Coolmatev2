<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class WishlistItem extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'wishlist_id',
        'product_id',
        'preferred_variant_id',
    ];

    public function wishlist(): BelongsTo
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Màu và size người dùng yêu thích, nếu đã chọn.
     */
    public function preferredVariant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'preferred_variant_id'
        );
    }
}
