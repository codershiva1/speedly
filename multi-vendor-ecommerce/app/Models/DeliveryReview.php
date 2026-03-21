<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryReview extends Model
{
    protected $fillable = [
        'order_id', 
        'user_id', 
        'delivery_boy_id', 
        'rating', 
        'comment'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deliveryBoy()
    {
        return $this->belongsTo(User::class, 'delivery_boy_id');
    }
}
