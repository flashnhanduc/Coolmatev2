<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banner extends Model
{
    protected $fillable = [
        'name',
        'location',
        'title',
        'subtitle',
        'image_desktop',
        'image_mobile',
        'button_text',
        'link',
        'sort_order',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }
    public function homepageSections(): HasMany
{
    return $this->hasMany(HomepageSection::class);
}
}
