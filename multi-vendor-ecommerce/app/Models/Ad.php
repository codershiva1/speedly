<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Ad extends Model
{
    protected $fillable = [
        'ad_placement_id',
        'target_type',
        'target_id',
        'title',
        'banner_image',
        'starts_at',
        'ends_at',
        'priority',
        'is_active',
        'max_impressions',
        'max_clicks',
    ];

    /* ===================== Relationships ===================== */

    public function placement()
    {
        return $this->belongsTo(AdPlacement::class);
    }

    /* ===================== Dynamic Target ===================== */

    public function target()
    {
        return match ($this->target_type) {
            'product'  => $this->belongsTo(Product::class, 'target_id'),
            'category' => $this->belongsTo(Category::class, 'target_id'),
            default    => null,
        };
    }

    /* ===================== Scopes ===================== */

    public function scopeActive(Builder $query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')
                  ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')
                  ->orWhere('ends_at', '>=', now());
            });
    }
}
