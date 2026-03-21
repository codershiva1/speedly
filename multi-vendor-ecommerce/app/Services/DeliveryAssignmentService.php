<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;

class DeliveryAssignmentService
{
    /**
     * Automatically assign an order to an online delivery boy.
     */
    public static function autoAssign(Order $order): bool
    {
        // Don't assign if already assigned
        if ($order->delivery_boy_id) {
            return false;
        }

        // Get the pickup location (Vendor)
        $vendor = $order->items->first()?->vendor?->vendorProfile;
        if (!$vendor || !$vendor->latitude || !$vendor->longitude) {
            // Fallback to basic assignment if coordinates are missing
            return self::assignToFewestOrders($order);
        }

        $vLat = $vendor->latitude;
        $vLng = $vendor->longitude;

        // Find an online delivery boy within 5km, sorted by proximity
        // Using Haversine formula directly in the query
        $availableRider = User::where('role', 'delivery_boy')
            ->whereHas('deliveryBoyProfile', function ($query) {
                $query->where('is_online', true);
            })
            ->select('users.*')
            ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$vLat, $vLng, $vLat])
            ->having('distance', '<=', 5.0) // 5km limit
            ->withCount(['deliveries as active_deliveries_count' => function ($query) {
                $query->whereIn('delivery_status', ['assigned', 'picked_up', 'out_for_delivery']);
            }])
            ->orderBy('distance', 'asc')
            ->orderBy('active_deliveries_count', 'asc')
            ->first();

        if ($availableRider) {
            return self::performAssignment($order, $availableRider);
        }

        return self::assignToFewestOrders($order);
    }

    private static function assignToFewestOrders(Order $order): bool
    {
        $availableRider = User::where('role', 'delivery_boy')
            ->whereHas('deliveryBoyProfile', function ($query) {
                $query->where('is_online', true);
            })
            ->withCount(['deliveries as active_deliveries_count' => function ($query) {
                $query->whereIn('delivery_status', ['assigned', 'picked_up', 'out_for_delivery']);
            }])
            ->orderBy('active_deliveries_count', 'asc')
            ->first();

        if ($availableRider) {
            return self::performAssignment($order, $availableRider);
        }

        return false;
    }

    private static function performAssignment(Order $order, User $rider): bool
    {
        $order->update([
            'delivery_boy_id' => $rider->id,
            'delivery_status' => 'assigned',
            'assigned_at' => now(),
            'delivery_otp' => rand(1000, 9999)
        ]);
        
        return true;
    }
}
