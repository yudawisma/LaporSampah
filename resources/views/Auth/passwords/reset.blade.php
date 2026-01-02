@extends('layouts.app')
@section('title','Reset Password')

@section('content')
<main class="d-flex align-items-center justify-content-center py-5">
  <div class="container" style="max-width:420px">
    <div class="bg-white p-4 rounded-4 shadow">
      <h3 class="fw-bold mb-3 text-center">Reset Password</h3>

      <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
          <input type="email"
                 name="email"
                 value="{{ $email ?? old('email') }}"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <input type="password"
                 name="password"
                 class="form-control"
                 placeholder="Password baru"
                 required>
        </div>

        <div class="mb-3">
          <input type="password"
                 name="password_confirmation"
                 class="form-control"
                 placeholder="Konfirmasi password"
                 required>
        </div>

        <button class="btn bg-primary-custom text-white w-100">
          Reset Password
        </button>
      </form>
    </div>
  </div>
</main>
@endsection
