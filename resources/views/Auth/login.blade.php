@extends('layouts.app')

@section('title', 'Lapor Sampah - Login')

@section('content')
<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
  <div class="container" style="max-width: 420px;">
    <div class="bg-white rounded-4 shadow p-4">
      <div class="text-center mb-4">
        <h2 class="fw-bold">Masuk ke akun Anda</h2>
      </div>

      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label visually-hidden">Email atau Nama Pengguna</label>
          <input
            type="text"
            id="email"
            name="email"
            class="form-control form-control-lg border-secondary-subtle"
            placeholder="Email atau Nama Pengguna"
            required>
        </div>

        <!-- Password -->
        <div class="mb-2">
          <label for="password" class="form-label visually-hidden">Kata Sandi</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control form-control-lg border-secondary-subtle"
            placeholder="Kata Sandi"
            required>
        </div>

        <!-- Forgot password -->
        <a href="{{ route('password.request') }}"
          class="text-primary-custom text-decoration-none fw-medium small">
          Lupa Password?
        </a>


        <!-- Button -->
        <div class="d-grid mb-3">
          <button type="submit" class="btn bg-primary-custom text-white fw-bold py-2">
            Masuk
          </button>
        </div>

        <!-- Register link -->
        <p class="text-center small text-muted mb-0">
          Belum punya akun?
          <a href="{{ route('register') }}" class="text-primary-custom fw-medium text-decoration-none">Daftar di sini</a>
        </p>
      </form>
    </div>
  </div>
</main>
@endsection