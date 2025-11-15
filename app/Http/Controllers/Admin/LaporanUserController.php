<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

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
}
