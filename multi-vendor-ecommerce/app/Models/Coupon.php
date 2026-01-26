<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use App\Models\User; 

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_cart_value',
        'max_uses',
        'used_count',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active'  => 'boolean',
    ];

    /* ---------------------------------
        RELATIONSHIPS
    --------------------------------- */

    /**
     * Users who have already used this coupon
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('used_at')
            ->withTimestamps();
    }

    /* ---------------------------------
        HELPER METHODS
    --------------------------------- */

    // Check if coupon is expired
    public function isExpired(): bool
    {
        return $this->expires_at && now()->gt($this->expires_at);
    }

    // Check if coupon is usable
    public function isUsable(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->isExpired()) {
            return false;
        }

        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) {
            return false;
        }

        return true;
    }
}
