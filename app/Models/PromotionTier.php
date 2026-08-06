<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotionTier extends Model
{
    protected $fillable = [
        'promotion_id',
        'minimum_quantity',
        'discount_type',
        'discount_value',
    ];

    protected function casts(): array
    {
        return [
            'minimum_quantity' => 'integer',
            'discount_value' => 'decimal:2',
        ];
    }

    /**
     * Mức giảm này thuộc về một chương trình khuyến mãi.
     */
    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }
}
