<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
class LaporanUserController extends Controller
{
 

 public function index()
    {
        // Ambil laporan dengan status 'selesai', beserta user, petugas, dan photo
        $laporanSelesai = Report::with(['user', 'petugas', 'photos'])
            ->where('status', 'selesai')
            ->latest()
            ->get();

        return view('admin.laporan', compact('laporanSelesai'));
    }

    public function deleteAll()
{
    $laporan = Report::where('status', 'selesai')->with('photos')->get();

    foreach ($laporan as $item) {
        foreach ($item->photos as $photo) {
            Storage::delete($photo->path);
            $photo->delete();
        }
        $item->delete();
    }

    return redirect()->route('admin.laporan')
        ->with('success', 'Semua laporan selesai berhasil dihapus.');
}
}
