<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Notification;



class LaporanController extends Controller
{
    // Dashboard laporan user
    public function dashboard()
    {
        $user = Auth::user();
        $laporans = Report::where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        return view('user.dashboard', compact('user', 'laporans'));
    }

    public function index()
    {
        $user = Auth::user();
        $laporans = Report::where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        return view('user.laporan.index', compact('laporans'));
    }


    // Form buat laporan
    public function create()
    {
        return view('user.laporan.create');
    }

    // Simpan laporan baru
    public function store(Request $request)
    {


        $request->validate([
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $report = Report::create([
            'user_id' => Auth::id(),
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'status' => 'baru',
        ]);

        
        $petugasList = User::where('role', 'petugas')->get();

        foreach ($petugasList as $petugas) {
            Notification::create([
                'user_id' => $petugas->id,
                'message' => 'Ada laporan baru masuk dari user: ' . Auth::user()->name,
                'is_read' => false,
                'role' => 'petugas',
            ]);
        }



        if ($request->hasFile('foto')) {
            $files = $request->file('foto');
            if (count($files) > 5) {
                return back()->with('error', 'Maksimal 5 foto saja')->withInput();
            }

            foreach ($files as $file) {
                $path = $file->store('laporan_foto', 'public');
                $report->photos()->create([
                    'path' => $path,
                    'type' => 'before',
                ]);
            }
        }

        return redirect()->route('user.dashboard')
            ->with('success', 'Laporan berhasil dikirim dengan alamat: ' . $report->alamat);
    }


    // Detail laporan
    public function show($id)
    {
        $laporan = Report::findOrFail($id);
        return view('user.laporan.show', compact('laporan'));
    }

    public function destroy($id)
    {
        $laporan = Report::where('id', $id)
            ->where('user_id', Auth::id()) // keamanan: hanya user pemilik
            ->firstOrFail();

        // Hanya boleh hapus jika status masih baru atau ditolak
        if (!in_array($laporan->status, ['baru', 'ditolak'])) {
            return back()->with('error', 'Laporan tidak dapat dihapus karena sedang diproses atau sudah selesai.');
        }

        // Hapus semua foto
        foreach ($laporan->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
        }

        // Hapus laporan
        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
