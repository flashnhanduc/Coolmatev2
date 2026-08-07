<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'birthday',
        'gender',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthday' => 'date',
            'password' => 'hashed',
        ];
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function couponUsages(): HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }
    public function createdStockMovements(): HasMany
    {
        return $this->hasMany(
            StockMovement::class,
            'created_by'
        );
    }
    public function orderStatusChanges(): HasMany
    {
        return $this->hasMany(
            OrderStatusHistory::class,
            'changed_by'
        );
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function wishlist(): HasOne
    {
        return $this->hasOne(Wishlist::class);
    }
    public function recentlyViewedRecords(): HasMany
    {
        return $this->hasMany(RecentlyViewedProduct::class)
            ->latest('viewed_at');
    }
}
