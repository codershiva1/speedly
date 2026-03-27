<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Traits\Loggable;

class Brand extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'status',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
