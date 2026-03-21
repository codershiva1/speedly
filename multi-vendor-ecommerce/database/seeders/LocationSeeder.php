<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VendorProfile;
use App\Models\Order;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Update Vendors with coordinates (around Connaught Place, Delhi)
        $vendors = VendorProfile::all();
        foreach ($vendors as $vendor) {
            // Random offset within ~5km
            $lat = 28.6315 + (rand(-50, 50) / 1000);
            $lng = 77.2167 + (rand(-50, 50) / 1000);
            
            $vendor->update([
                'latitude' => $lat,
                'longitude' => $lng
            ]);
        }

        // 2. Update Orders with coordinates (around the same area)
        $orders = Order::all();
        foreach ($orders as $order) {
            // Random offset within ~10km
            $lat = 28.6315 + (rand(-100, 100) / 1000);
            $lng = 77.2167 + (rand(-100, 100) / 1000);
            
            $order->update([
                'latitude' => $lat,
                'longitude' => $lng
            ]);
        }
    }
}
