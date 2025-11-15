<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RedeemRequest;

class RedeemController extends Controller
{
    // Halaman redeem
    public function index()
    {
        $user = auth()->user();
        $redeems = $user->redeemRequests()->latest()->get();
        return view('user.redeem', compact('user', 'redeems'));
    }

    // Simpan request penukaran poin
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_poin' => 'required|integer|min:1000',
            'no_rekening' => 'required|string',
            'bank'        => 'required|string',
            'atas_nama'  => 'nullable|string|max:150',
        ]);

        $user = auth()->user();

        if ($request->jumlah_poin > $user->poin) {
            return redirect()->back()->with('error', 'Poin tidak cukup.');
        }

        // Hitung nominal, misal 1000 poin = 100.000
        $nominal = ($request->jumlah_poin / 1000) * 100000;

        RedeemRequest::create([
            'user_id'     => $user->id,
            'jumlah_poin' => $request->jumlah_poin,
            'nominal'     => $nominal,
            'bank'        => $request->bank,
            'no_rekening' => $request->no_rekening,
            'atas_nama'   => $request->atas_nama,
            'status'      => 'menunggu',
        ]);

        // Kurangi poin sementara
        $user->decrement('poin', $request->jumlah_poin);

        return redirect()->route('user.redeem')->with('success', 'Permintaan penukaran sedang diproses.');
    }
}
