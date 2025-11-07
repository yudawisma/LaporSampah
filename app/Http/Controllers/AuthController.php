<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') return redirect()->route('admin.dashboard');
            if ($user->role === 'petugas') return redirect()->route('petugas.dashboard');
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:user,petugas'
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
