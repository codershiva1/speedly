<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class CouponService
{
    /**
     * Validate coupon with cart & user
     */
    public static function validateCoupon(string $code, float $cartTotal, int $userId)
    {
        $coupon = Coupon::where('code', strtoupper($code))->first();

        // Coupon not found
        if (!$coupon) {
            return ['error' => 'Invalid coupon code'];
        }

        // Check if usable
        if (!$coupon->isUsable()) {
            return ['error' => 'Coupon is not available'];
        }

        // Minimum cart value
        if ($coupon->min_cart_value && $cartTotal < $coupon->min_cart_value) {
            return [
                'error' => 'Minimum cart value should be ₹' . $coupon->min_cart_value
            ];
        }

        // Already used by this user
        $alreadyUsed = DB::table('coupon_user')
            ->where('coupon_id', $coupon->id)
            ->where('user_id', $userId)
            ->exists();

        if ($alreadyUsed) {
            return ['error' => 'You have already used this coupon'];
        }

        return [
            'coupon' => $coupon
        ];
    }

    /**
     * Calculate discount amount
     */
    public static function calculateDiscount(Coupon $coupon, float $cartTotal): float
    {
        if ($coupon->type === 'fixed') {
            return min($coupon->value, $cartTotal);
        }

        // percent
        return round(($cartTotal * $coupon->value) / 100, 2);
    }
}
