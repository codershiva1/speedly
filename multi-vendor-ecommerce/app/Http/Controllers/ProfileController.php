<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Address;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = auth()->user();
        $addresses = $user->addresses()->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'addresses' => $addresses
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


     public function storeAddress(Request $request)
    {
        $request->validate([
            'label'         => 'required|string|max:50',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city'          => 'required|string|max:100',
            'state'         => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
        ]);

        $user = auth()->user();

        // First address ko default banao
        $isDefault = $user->addresses()->count() === 0;

        Address::create([
            'user_id'       => $user->id,
            'label'         => $request->label,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city'          => $request->city,
            'state'         => $request->state,
            'postal_code'   => $request->postal_code,
            'country'       => 'India',
            'is_default'    => $isDefault,
        ]);

        return back()->with('status', 'address-added');
    }

    public function updateAddress(Request $request, Address $address)
    {
        abort_if($address->user_id !== auth()->id(), 403);

        $request->validate([
            'label'         => 'required|string|max:50',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city'          => 'required|string|max:100',
            'state'         => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
        ]);

        $address->update($request->only([
            'label',
            'name',
            'phone',
            'address_line1',
            'address_line2',
            'city',
            'state',
            'postal_code',
        ]));

        return back()->with('status', 'address-updated');
    }

   

}
