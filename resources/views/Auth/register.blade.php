@extends('layouts.app')

@section('title', 'Lapor Sampah - Register')

@section('content')
  <!-- Main -->
  <main class="d-flex align-items-center justify-content-center py-5" style="min-height: 80vh;">
    <div class="container" style="max-width: 420px;">
      <div class="card shadow border-0">
        <div class="card-body p-4">
          <h2 class="text-center fw-bold mb-3">Buat Akun Baru</h2>
          <p class="text-center text-muted mb-4">Pilih peran Anda untuk memulai.</p>

          <form action="{{ route('register.post') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <!-- Pilih Peran -->
            <div class="mb-4 text-center">
              <input type="hidden" name="role" id="role" value="user">

              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary-custom flex-fill me-2 fw-semibold role-btn active" data-role="user">
                  Pengguna
                </button>
                <button type="button" class="btn btn-outline-primary-custom flex-fill fw-semibold role-btn" data-role="petugas">
                  Petugas
                </button>
              </div>
            </div>

            <!-- Input Fields -->
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" id="nama" name="name" class="form-control" placeholder="Nama lengkap" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Alamat email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Kata Sandi</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Kata sandi" required>
            </div>
            <div class="mb-4">
              <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi" required>
            </div>

            <!-- Tombol -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary-custom fw-semibold">Daftar</button>
            </div>

            <div class="text-center mt-3">
              <p class="mb-0 text-muted">Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary-custom text-decoration-none">Masuk</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  
  <script>
    // Ganti role berdasarkan tombol yang diklik
    document.querySelectorAll('.role-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        document.getElementById('role').value = this.getAttribute('data-role');

        document.querySelectorAll('.role-btn').forEach(b => {
          b.classList.remove('btn-primary-custom', 'active');
          b.classList.add('btn-outline-primary-custom');
        });

        this.classList.remove('btn-outline-primary-custom');
        this.classList.add('btn-primary-custom', 'active');
      });
    });
  </script>
@endsection