<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CouponService;
use App\Models\Cart;


class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        if (!auth()->check()) {
            return redirect()->route('login')
                ->withErrors(['coupon' => 'Please login to apply coupon']);
        }

        $cart = \App\Models\Cart::where('user_id', auth()->id())
            ->with('items')
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return back()->withErrors(['coupon' => 'Cart is empty']);
        }

        $cartTotal = $cart->items->sum('total_price');

        $result = CouponService::validateCoupon(
            $request->code,
            $cartTotal,
            auth()->id()
        );

        if (isset($result['error'])) {
            return back()->withErrors(['coupon' => $result['error']]);
        }

        $coupon   = $result['coupon'];
        $discount = CouponService::calculateDiscount($coupon, $cartTotal);

        session()->put('applied_coupon', [
            'id'       => $coupon->id,
            'code'     => $coupon->code,
            'discount' => round($discount, 2),
            'type'     => $coupon->type,
        ]);

        return back()->with('success', 'Coupon applied successfully');
    }


    public function remove()
    {
        session()->forget('applied_coupon');

        return back()->with('success', 'Coupon removed');
    }
}
