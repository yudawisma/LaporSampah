<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $totalLaporan = Report::count();

        $laporanSelesai = Report::where('status', 'selesai')->count();

        $persentaseSelesai = $totalLaporan > 0
            ? round(($laporanSelesai / $totalLaporan) * 100)
            : 0;

        $avgWaktu = Report::where('status', 'selesai')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_jam')
            ->value('avg_jam');

        return view('home', compact(
            'totalLaporan',
            'persentaseSelesai',
            'avgWaktu'
        ));
    }
}
