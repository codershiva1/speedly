<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrderAssignment extends Model
{
    protected $fillable = [
        'order_id', 
        'delivery_boy_id', 
        'status', 
        'assigned_at', 
        'responded_at', 
        'rejection_reason'
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function deliveryBoy()
    {
        return $this->belongsTo(User::class, 'delivery_boy_id');
    }
}
