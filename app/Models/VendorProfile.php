<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class VendorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'slug',
        'logo',
        'banner',
        'description',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'postal_code',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'vendor_id', 'user_id');
    }
}
