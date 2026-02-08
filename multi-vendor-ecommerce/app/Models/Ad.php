<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
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

    public function adPlacement()
    {
        return $this->belongsTo(AdPlacement::class, 'ad_placement_id');
    }

    /* ===================== Dynamic Target ===================== */

   /**
     * Dynamic ad target (safe)
     */
    public function target()
    {
        return $this->morphTo();
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
