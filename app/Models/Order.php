<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'coupon_id',
        'shipping_method_id',
        'payment_method_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'status',
        'payment_status',
        'fulfillment_status',
        'subtotal',
        'product_discount_total',
        'coupon_discount_total',
        'shipping_fee',
        'tax_total',
        'grand_total',
        'note',
        'gift_message',
        'is_gift',
        'requires_invoice',
        'placed_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'integer',
            'product_discount_total' => 'integer',
            'coupon_discount_total' => 'integer',
            'shipping_fee' => 'integer',
            'tax_total' => 'integer',
            'grand_total' => 'integer',
            'is_gift' => 'boolean',
            'requires_invoice' => 'boolean',
            'placed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    /**
     * Tài khoản đã đặt đơn, có thể null đối với khách vãng lai.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    /**
     * Tất cả địa chỉ của đơn hàng.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(OrderAddress::class);
    }

    /**
     * Địa chỉ giao hàng.
     */
    public function shippingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class)
            ->where('type', 'shipping');
    }

    /**
     * Địa chỉ xuất hóa đơn.
     */
    public function billingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class)
            ->where('type', 'billing');
    }
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
    public function couponUsage(): HasOne
    {
        return $this->hasOne(CouponUsage::class);
    }
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
    public function statusHistories(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class)
            ->orderBy('created_at');
    }
}
