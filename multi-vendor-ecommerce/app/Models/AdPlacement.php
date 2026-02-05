<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPlacement extends Model
{
    protected $fillable = [
        'key',
        'name',
        'is_active',
    ];

     public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
