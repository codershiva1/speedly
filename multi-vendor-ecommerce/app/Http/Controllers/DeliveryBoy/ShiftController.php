<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function toggleShift(Request $request)
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile;

        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found.'], 404);
        }

        $isOnShift = $request->boolean('is_on_shift');
        
        $profile->is_on_shift = $isOnShift;
        
        if ($isOnShift) {
            $profile->last_shift_start = Carbon::now();
            $profile->last_shift_end = null;
            $profile->is_online = true; // Automatically go online when starting shift
        } else {
            $profile->last_shift_end = Carbon::now();
            $profile->is_on_break = false; // Cannot be on break if shift ended
            $profile->is_online = false; // Automatically go offline when ending shift
        }

        $profile->save();

        return response()->json([
            'success' => true, 
            'is_on_shift' => $profile->is_on_shift,
            'is_online' => $profile->is_online,
            'message' => $isOnShift ? 'Shift started.' : 'Shift ended.'
        ]);
    }

    public function toggleBreak(Request $request)
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile;

        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found.'], 404);
        }

        if (!$profile->is_on_shift) {
            return response()->json(['success' => false, 'message' => 'You must be on shift to take a break.'], 400);
        }

        $isOnBreak = $request->boolean('is_on_break');
        $profile->is_on_break = $isOnBreak;
        
        // If on break, maybe mark as busy/offline for assignments?
        // For now, just track the state.
        $profile->is_online = !$isOnBreak; 

        $profile->save();

        return response()->json([
            'success' => true, 
            'is_on_break' => $profile->is_on_break,
            'is_online' => $profile->is_online,
            'message' => $isOnBreak ? 'Break started.' : 'Break ended.'
        ]);
    }
}
