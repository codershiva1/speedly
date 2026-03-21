<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryWithdrawalRequest extends Model
{
    protected $fillable = [
        'user_id', 
        'amount', 
        'status', 
        'bank_details', 
        'admin_notes', 
        'processed_at'
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
