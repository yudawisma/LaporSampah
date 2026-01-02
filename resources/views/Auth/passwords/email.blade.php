@extends('layouts.app')
@section('title','Lupa Password')

@section('content')
<main class="d-flex align-items-center justify-content-center py-5">
  <div class="container" style="max-width:420px">
    <div class="bg-white p-4 rounded-4 shadow">
      <h3 class="fw-bold mb-3 text-center">Lupa Password</h3>

      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
          <input type="email"
                 name="email"
                 class="form-control form-control-lg"
                 placeholder="Masukkan email"
                 required>
        </div>

        <button class="btn bg-primary-custom text-white w-100">
          Kirim Link Reset
        </button>

        <div class="text-center mt-3">
          <a href="{{ route('login') }}">Kembali ke Login</a>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection
