<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdImpression extends Model
{
    protected $fillable = [
        'ad_id',
        'user_id',
        'ip_address',
    ];

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }
}