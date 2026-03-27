<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $messages = SupportMessage::with('user')
            ->latest()
            ->paginate(20);
            
        return view('admin.support.index', compact('messages'));
    }

    public function markAsRead(SupportMessage $message)
    {
        $message->update(['is_read' => true]);
        return back()->with('success', 'Message marked as read.');
    }

    public function destroy(SupportMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Message deleted.');
    }
}
