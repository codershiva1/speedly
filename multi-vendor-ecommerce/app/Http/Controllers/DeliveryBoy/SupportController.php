<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $messages = SupportMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('delivery.support', compact('messages'));
    }

    public function training()
    {
        return view('delivery.training');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        // Save Rider Message
        SupportMessage::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'sender_role' => 'rider'
        ]);

        // Simulate Admin Reply (Demo logic)
        if (str_contains(strtolower($request->message), 'payment') || str_contains(strtolower($request->message), 'money')) {
            $reply = "Payments are processed every Monday. You can check your wallet for the current balance.";
        } elseif (str_contains(strtolower($request->message), 'help') || str_contains(strtolower($request->message), 'order')) {
            $reply = "Our support team is looking into your active orders. Stay tuned.";
        } else {
            $reply = "Thank you for contacting Speedly Support. An agent will be with you shortly.";
        }

        SupportMessage::create([
            'user_id' => auth()->id(),
            'message' => $reply,
            'sender_role' => 'admin'
        ]);

        return response()->json([
            'status' => 'success',
            'reply' => $reply
        ]);
    }
}
