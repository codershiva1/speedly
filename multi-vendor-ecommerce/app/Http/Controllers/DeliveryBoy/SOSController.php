<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAlert;
use Illuminate\Http\Request;

class SOSController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:breakdown,accident,medical,other',
            'notes' => 'nullable|string|max:500',
            'location' => 'nullable|array',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        $alert = DeliveryAlert::create([
            'user_id' => auth()->id(),
            'order_id' => $request->order_id,
            'type' => $request->type,
            'notes' => $request->notes,
            'location' => $request->location,
            'status' => 'pending',
        ]);

        // In a real app, we would trigger a real-time event/notification to admin here
        
        return response()->json([
            'success' => true,
            'message' => 'Emergency alert sent. Help is on the way.',
            'alert' => $alert
        ]);
    }
}
