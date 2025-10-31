<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class DashboardPetugasController extends Controller
{
    public function index()
    {
        // Ambil semua laporan (termasuk foto)
        $laporans = Report::with(['user', 'photos'])->orderBy('created_at', 'desc')->get();
        return view('petugas.dashboard', compact('laporans'));
    }
}
