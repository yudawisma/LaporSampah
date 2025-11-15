<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🔹 Form Login
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // 🔹 Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // 🔸 Cek role dan status
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'petugas') {
                if ($user->status_request === 'pending') {
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => 'Akun Anda sedang menunggu persetujuan admin.'
                    ]);
                }

                if ($user->status_request === 'rejected') {
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => 'Pendaftaran Anda ditolak oleh admin.'
                    ]);
                }

                return redirect()->route('petugas.dashboard');
            }

            // 🔸 Default user biasa
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // 🔹 Form Register
    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    // 🔹 Proses Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,petugas',
        ]);

        if ($validated['role'] === 'petugas') {
            // 🔸 Buat akun petugas dengan status "pending"
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'petugas',
                'status_request' => 'pending',
            ]);

            // Simpan id user ke session supaya bisa isi profil
            session(['pending_petugas_id' => $user->id]);

            return redirect()->route('petugas.profil.lengkapi')
                ->with('info', 'Lengkapi profil Anda sebelum akun disetujui admin.');
        }

        // 🔸 User biasa langsung aktif
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'status_request' => 'approved', // opsional, biar seragam field-nya
        ]);

        Auth::login($user);
        return redirect()->route('user.dashboard');
    }

    // 🔹 Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
