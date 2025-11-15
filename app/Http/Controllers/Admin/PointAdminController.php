<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RedeemRequest;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Notification; 

class PointAdminController extends Controller
{
    public function index()
    {
        // Ganti Redeem jadi RedeemRequest biar sesuai dengan model kamu
        $totalPending = RedeemRequest::where('status', 'menunggu')->count();
        $totalSaldo   = RedeemRequest::where('status', 'selesai')->sum('nominal');
        $totalPoin    = RedeemRequest::sum('jumlah_poin');
        $permintaan   = RedeemRequest::where('status', 'menunggu')->get();
        $riwayat      = ActivityLog::latest()->take(10)->get();


        return view('admin.point', compact(
            'totalPending',
            'totalSaldo',
            'totalPoin',
            'permintaan',
            'riwayat'
        ));
    }

    public function proses($id)
    {
        $redeem = RedeemRequest::with('user')->findOrFail($id);

        return view('admin.point-proses', compact('redeem'));
    }


    public function selesai(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'catatan' => 'nullable|string|max:255',
        ]);

        $redeem = RedeemRequest::findOrFail($id);

        // Upload file bukti transfer
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bukti_transfer', $filename, 'public');
            $redeem->bukti_tf = $path; // ✅ ubah ini
        }


        $redeem->status = 'selesai';
        $redeem->catatan_admin = $request->catatan ?? null;
        $redeem->save();

         
    Notification::create([
        'user_id' => $redeem->user_id,
        'title' => 'Penukaran Point Selesai!',
        'message' => 'Penukaran Anda dengan ID #' . $redeem->id . ' telah diproses dan selesai.',
        'is_read' => false,
    ]);

        return redirect()->route('admin.point')->with('success', 'Penukaran selesai dan bukti transfer telah diunggah.');
    }


    public function tolak($id)
    {
        $redeem = RedeemRequest::findOrFail($id);
        $redeem->status = 'ditolak';
        $redeem->save();

        return redirect()->back()->with('success', 'Penukaran ditolak.');
    }
}
