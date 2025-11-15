<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Report;
use App\Models\RedeemRequest;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalUsers = User::count();
        $totalReports = Report::count();
        $totalRedeems = RedeemRequest::count();
        $totalPoinDitukar = RedeemRequest::sum('jumlah_poin');

        // Pengguna terbaru (3)
        $latestUsers = User::latest()->take(3)->get();

        // Laporan terbaru (3)
        $latestReports = Report::with('user')->latest()->take(3)->get();

        // Penukaran terbaru (3)
        $latestRedeems = RedeemRequest::with('user')->latest()->take(3)->get();

        // Grafik aktivitas bulanan laporan
        $monthlyReports = Report::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

        // Data lengkap ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalReports',
            'totalRedeems',
            'totalPoinDitukar',
            'latestUsers',
            'latestReports',
            'latestRedeems',
            'monthlyReports'
        ));
    }
}
