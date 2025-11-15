<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfilPetugasController extends Controller
{
    public function create()
    {
        $userId = session('pending_petugas_id');
        if (!$userId)
            return redirect()->route('login')->with('error', 'Sesi pendaftaran sudah berakhir.');

        $user = User::findOrFail($userId);
        if ($user->status_request !== 'pending') {
            return redirect()->route('login')->with('error', 'Akun sudah diverifikasi dan di Tolak! Lengkapi profil anda..');
        }

        return view('petugas.profil.lengkapi', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        $user = User::findOrFail(session('pending_petugas_id'));

        $data = [
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profil_petugas', 'public');
        }

        $user->update($data);

        // Setelah profil lengkap, admin bisa meninjau
        session()->forget('pending_petugas_id');

        return redirect()->route('login')->with('success', 'Profil berhasil dilengkapi. Tunggu persetujuan admin.');
    }
}
