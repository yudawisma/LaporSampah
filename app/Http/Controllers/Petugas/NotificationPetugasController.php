<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationPetugasController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            
            ->latest()
            ->get();

        
    return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notif = Notification::where('user_id', Auth::id())
            ->findOrFail($id);

        $notif->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }
}
