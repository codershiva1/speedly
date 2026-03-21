<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryBoyProfile extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_type', 'vehicle_number', 'dl_number', 'dl_image', 
        'rc_number', 'rc_image', 'aadhaar_number', 'aadhaar_image', 'bank_name', 
        'bank_account_number', 'bank_ifsc', 'is_online', 'is_on_shift', 
        'is_on_break', 'last_shift_start', 'last_shift_end', 'last_online_at',
        'current_lat', 'current_lng', 'delivery_zone', 'rating', 
        'total_deliveries', 'cash_in_hand', 'wallet_balance'
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'is_on_shift' => 'boolean',
        'is_on_break' => 'boolean',
        'last_shift_start' => 'datetime',
        'last_shift_end' => 'datetime',
        'last_online_at' => 'datetime',
        'current_lat' => 'decimal:8',
        'current_lng' => 'decimal:8',
        'rating' => 'decimal:2',
        'cash_in_hand' => 'decimal:2',
        'wallet_balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
