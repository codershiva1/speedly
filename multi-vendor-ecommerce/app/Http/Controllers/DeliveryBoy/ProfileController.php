<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryBoyProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile ?? new DeliveryBoyProfile();

        return view('delivery.profile', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'nullable|string',
            'vehicle_number' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048'
        ]);

        $user = auth()->user();

        // Update User info including avatar
        if ($request->hasFile('avatar')) {
            $user->image_url = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->filled('name'))
            $user->name = $request->name;
        if ($request->filled('last_name'))
            $user->last_name = $request->last_name;
        if ($request->filled('mobile'))
            $user->mobile = $request->mobile;

        $user->save();

        $profile = $user->deliveryBoyProfile ?? new DeliveryBoyProfile(['user_id' => $user->id]);

        $data = $request->only([
            'vehicle_type',
            'vehicle_number',
            'bank_account_number',
            'bank_name',
            'bank_ifsc'
        ]);

        if ($request->hasFile('rc_document')) {
            $data['rc_document_path'] = $request->file('rc_document')->store('documents', 'public');
        }

        $profile->fill($data); // Use fill instead of individual assignments
        $profile->save(); // Save the profile

        return back()->with('status', 'Profile updated successfully.');
    }

    public function updateOnlineStatus(Request $request)
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile ?? new \App\Models\DeliveryBoyProfile(['user_id' => $user->id]);

        $profile->is_online = $request->boolean('is_online');
        $profile->save();

        return response()->json(['success' => true, 'is_online' => $profile->is_online]);
    }
}
