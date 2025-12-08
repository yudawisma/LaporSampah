<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\PointTransaction;

class UserController extends Controller
{
    public function index(Request $request)
    {


        // Ambil parameter tab, default: pengguna
        $tab = $request->get('tab', 'pengguna');

        // Tentukan role berdasarkan tab
        switch ($tab) {
            case 'petugas':
                $role = 'petugas';
                break;
            case 'admin':
                $role = 'admin';
                break;
            default:
                $role = 'user';
                break;
        }

        $users = \App\Models\User::where('role', $role)
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter users berdasarkan role
        $users = User::where('role', $role)->orderBy('created_at', 'desc')->get();
        // Hitung total
        $totalUsers = User::where('role', 'user')->count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalReports = Report::count();

        // Total poin semua user
        $totalPoin = User::sum('poin');

        // Pendaftar petugas baru (misalnya role masih user tapi ingin jadi petugas)
        // Jika kamu punya tabel request_petugas, ganti ini sesuai kebutuhan
        $pendaftarPetugas = User::where('role', 'petugas')
            ->where('status_request', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();




        return view('admin.pengguna', compact(
            'users',
            'tab',
            'totalUsers',
            'totalPetugas',
            'totalAdmin',
            'totalReports',
            'totalPoin',
            'pendaftarPetugas',
            'users'
        ));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.show', compact('user'));
    }


    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'role' => 'petugas',
            'status_request' => 'approved'
        ]);


        // Kirim notifikasi (opsional)
        // Notification::send($user, new PetugasApprovedNotification());

        return redirect()->route('admin.pengguna')->with('success', 'Pendaftar berhasil disetujui menjadi petugas.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status_request' => 'rejected']);

        // Bisa hapus akun atau tandai ditolak
        // $user->delete();
        // atau
        // $user->update(['status_request' => 'rejected']);

        return redirect()->route('admin.pengguna')->with('error', 'Pendaftar ditolak.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:user,petugas,admin',
        ];

        // Poin hanya untuk user biasa
        if ($request->role === 'user') {
            $rules['poin'] = 'nullable|integer|min=0';
        }

        $validated = $request->validate($rules);

        // Update data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($validated['role'] === 'user') {
            $user->poin = $validated['poin'] ?? $user->poin;
        } else {
            // Pastikan petugas/admin tidak punya poin
            $user->poin = null;
        }

        $user->save();

        return redirect()
            ->route('admin.pengguna')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
