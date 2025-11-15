<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notif = Notification::where('user_id', Auth::id())->findOrFail($id);
        $notif->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }
}
