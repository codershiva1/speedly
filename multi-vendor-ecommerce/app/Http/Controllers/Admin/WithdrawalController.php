<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryWithdrawalRequest;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        $requests = DeliveryWithdrawalRequest::with(['user', 'user.deliveryBoyProfile'])
            ->latest()
            ->paginate(15);
            
        return view('admin.withdrawals.index', compact('requests'));
    }

    public function approve(DeliveryWithdrawalRequest $request)
    {
        if ($request->status !== 'pending') {
            return back()->with('error', 'Request already processed.');
        }

        $request->update([
            'status' => 'approved',
            'processed_at' => now(),
            'transaction_id' => 'TXN-' . strtoupper(uniqid())
        ]);

        return back()->with('status', 'Withdrawal request approved successfully.');
    }

    public function reject(Request $request, DeliveryWithdrawalRequest $withdrawalRequest)
    {
        if ($withdrawalRequest->status !== 'pending') {
            return back()->with('error', 'Request already processed.');
        }

        $request->validate(['reason' => 'required|string']);

        $withdrawalRequest->update([
            'status' => 'rejected',
            'admin_note' => $request->reason,
            'processed_at' => now()
        ]);

        return back()->with('status', 'Withdrawal request rejected.');
    }
}
