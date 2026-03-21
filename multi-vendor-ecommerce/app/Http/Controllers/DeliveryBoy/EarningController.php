<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DeliveryBoyEarning;

class EarningController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile;
        
        // 1. Earnings Stats
        $todayEarnings = DeliveryBoyEarning::where('user_id', $user->id)
                            ->whereDate('created_at', today())
                            ->sum('amount');
                            
        $weeklyEarnings = DeliveryBoyEarning::where('user_id', $user->id)
                            ->where('created_at', '>=', now()->startOfWeek())
                            ->sum('amount');
                            
        $totalIncentives = DeliveryBoyEarning::where('user_id', $user->id)
                            ->where('type', 'incentive')
                            ->sum('amount');
                            
        $totalEarnings = DeliveryBoyEarning::where('user_id', $user->id)->sum('amount');
        
        // 2. COD & Wallet
        $codCollected = $profile->cash_in_hand ?? 0;
        
        // 3. Activity & History
        $earningsList = DeliveryBoyEarning::where('user_id', $user->id)
                            ->latest()
                            ->paginate(10);
                            
        $withdrawalRequests = \App\Models\DeliveryWithdrawalRequest::where('user_id', $user->id)
                                ->latest()
                                ->get();

        return view('delivery.earnings', compact(
            'todayEarnings', 
            'weeklyEarnings', 
            'totalIncentives', 
            'totalEarnings', 
            'earningsList', 
            'codCollected',
            'withdrawalRequests'
        ));
    }

    public function requestWithdrawal(Request $request)
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile;

        $request->validate([
            'amount' => 'required|numeric|min:100', // Min 100 withdrawal
        ]);

        if ($request->amount > ($profile->wallet_balance ?? 0)) {
            return back()->with('error', 'Insufficient wallet balance.');
        }

        \App\Models\DeliveryWithdrawalRequest::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
            'bank_details' => "A/C: {$profile->bank_account_number}, IFSC: {$profile->bank_ifsc}"
        ]);

        // Deduct from wallet immediately or on approval? Usually on approval, but we can hold it.
        // For now, just record the request.

        return back()->with('success', 'Withdrawal request submitted successfully.');
    }
}
