<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdClick extends Model
{
    protected $fillable = [
        'ad_id',
        'user_id',
        'ip_address',
    ];

    /**
     * Get the ad that was clicked.
     */
    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }

    /**
     * Get the user who clicked the ad.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}