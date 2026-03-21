<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
    'name', 
    'last_name',   // Added
    'email', 
    'mobile',      // Added
    'gender',      // Added
    'dob',         // Added
    'password', 
    'role',
    'image_url'
];
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDeliveryBoy(): bool
    {
        return $this->role === 'delivery_boy';
    }

    public function isVendor(): bool
    {
        return $this->role === 'vendor';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function vendorProfile()
    {
        return $this->hasOne(VendorProfile::class);
    }

    public function customerProfile()
    {
        return $this->hasOne(CustomerProfile::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function deliveryBoyProfile()
    {
        return $this->hasOne(DeliveryBoyProfile::class);
    }

    public function deliveryBoyEarnings()
    {
        return $this->hasMany(DeliveryBoyEarning::class);
    }

    public function deliveryBoyShifts()
    {
        return $this->hasMany(DeliveryBoyShift::class);
    }
    
    /**
     * Get the deliveries assigned to the user (Delivery Boy).
     */
    public function deliveries()
    {
        return $this->hasMany(Order::class, 'delivery_boy_id');
    }

    public function deliveryReviewsReceived()
    {
        return $this->hasMany(DeliveryReview::class, 'delivery_boy_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function hasInWishlist($productId)
    {
        return $this->wishlist()
            ->where('product_id', $productId)
            ->exists();
    }


    public function defaultAddress()
    {
        return $this->hasOne(\App\Models\Address::class)->where('is_default', 1);
    }
}
