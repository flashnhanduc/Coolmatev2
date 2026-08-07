<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
    ];

    /**
     * Danh sách yêu thích thuộc về một người dùng.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function items(): HasMany
{
    return $this->hasMany(WishlistItem::class)
        ->latest('created_at');
}
}
