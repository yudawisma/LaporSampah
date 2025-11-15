<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PointTransaction;
use App\Models\Notification;


class LaporanPetugasController extends Controller
{

    public function index()
    {
        $petugasId = auth()->id();
        $laporans = Report::with(['user', 'photos'])
            ->where('petugas_id', $petugasId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.laporan.index', compact('laporans'));
    }

    public function assign(Report $laporan)
    {
        if (is_null($laporan->petugas_id)) {
            $laporan->update([
                'petugas_id' => Auth::id(),
                'status' => 'diproses',
            ]);

            // Redirect ke detail laporan petugas
            return redirect()->route('petugas.laporan.show', $laporan->id)
                ->with('success', 'Laporan berhasil diambil.');
        }

        return redirect()->back()->with('warning', 'Laporan sudah diambil petugas lain.');
    }


    public function show(Report $laporan)
    {
        $laporan->load(['user', 'photos']); // eager load relasi
        return view('petugas.laporan.show', compact('laporan'));
    }





    public function validateReport(Request $request, Report $laporan)
    {
        $request->validate([
            'catatan' => 'nullable|string',
            'bukti_foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan bukti foto
        if ($request->hasFile('bukti_foto')) {
            foreach ($request->file('bukti_foto') as $file) {
                $path = $file->store('reports', 'public');
                $laporan->photos()->create(['path' => $path]);
            }
        }

        // Update status laporan
        $laporan->update([
            'status' => 'selesai',
            'catatan_petugas' => $request->catatan,
        ]);

        Notification::create([
            'user_id' => $laporan->user_id,
            'title' => 'Laporan Selesai',
            'message' => 'Laporan Anda dengan ID #' . $laporan->id . ' telah selesai diproses oleh petugas.',
        ]);

        // ===== Tambahkan poin otomatis ke user =====
        $jumlahPoin = 10; // misal 10 poin per laporan selesai

        PointTransaction::create([
            'user_id' => $laporan->user_id,
            'report_id' => $laporan->id,
            'jumlah_poin' => $jumlahPoin,
            'tipe' => 'tambah',
            'keterangan' => 'Poin dari laporan selesai'
        ]);

        $laporan->user->increment('poin', $jumlahPoin);
        // ============================================

        return redirect()->route('petugas.laporan.show', $laporan->id)
            ->with('success', 'Laporan berhasil divalidasi dan poin ditambahkan.');
    }
}
