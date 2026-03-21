<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryBoyShift extends Model
{
    protected $fillable = [
        'user_id', 'shift_date', 'start_time', 'end_time', 
        'total_hours', 'break_time_minutes', 'status'
    ];

    protected $casts = [
        'shift_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'total_hours' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
