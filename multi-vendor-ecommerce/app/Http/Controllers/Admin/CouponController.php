<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code'],
            'type' => ['required', 'in:fixed,percent'],
            'value' => ['required', 'numeric', 'min:1'],
            'min_cart_value' => ['required', 'numeric', 'min:0'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'expires_at' => ['nullable', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        $data['used_count'] = 0;

        Coupon::create($data);

        return redirect()
            ->route('admin.coupons.index')
            ->with('status', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

     // Update coupon
    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code,' . $coupon->id],
            'type' => ['required', 'in:fixed,percent'],
            'value' => ['required', 'numeric', 'min:1'],
            'min_cart_value' => ['required', 'numeric', 'min:0'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'expires_at' => ['nullable', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        $coupon->update($data);

        return redirect()
            ->route('admin.coupons.index')
            ->with('status', 'Coupon updated successfully.');
    }

    public function toggle(Coupon $coupon)
    {
        $coupon->update([
            'is_active' => ! $coupon->is_active
        ]);

        return back()->with('status', 'Coupon status updated.');
    }
}
