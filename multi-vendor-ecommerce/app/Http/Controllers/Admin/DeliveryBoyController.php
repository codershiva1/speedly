<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DeliveryBoyProfile;
use Illuminate\Http\Request;

class DeliveryBoyController extends Controller
{
    public function index()
    {
        $deliveryBoys = User::where('role', 'delivery_boy')
            ->with('deliveryBoyProfile')
            ->latest()
            ->paginate(10);
        return view('admin.delivery-boys.index', compact('deliveryBoys'));
    }

    public function show(User $deliveryBoy)
    {
        $deliveryBoy->load(['deliveryBoyProfile', 'deliveries' => function($q) {
            $q->latest()->take(10);
        }]);

        $stats = [
            'total_deliveries' => $deliveryBoy->deliveries()->where('status', 'delivered')->count(),
            'total_earnings' => $deliveryBoy->deliveryBoyEarnings()->sum('amount'),
            'rating' => $deliveryBoy->deliveryBoyProfile->rating ?? '0.0',
        ];

        return view('admin.delivery-boys.show', compact('deliveryBoy', 'stats'));
    }

    public function approve(User $deliveryBoy)
    {
        // For now, approval can just be a success message or a flag if we add it.
        // Assuming we might add 'status' to DeliveryBoyProfile later.
        return back()->with('success', 'Delivery Boy approved.');
    }

    public function reject(User $deliveryBoy)
    {
        return back()->with('success', 'Delivery Boy rejected.');
    }
}
