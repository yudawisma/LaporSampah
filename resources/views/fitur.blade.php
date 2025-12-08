@extends('layouts.app')

@section('title', 'Fitur Lapor Sampah')

@section('content')
<section class="py-5 bg-light">
  <div class="container text-center">

    <h2 class="fw-bold mb-4">Fitur Utama Lapor Sampah</h2>
    <p class="text-muted mb-5 mx-auto" style="max-width: 700px;">
      Nikmati berbagai fitur modern untuk memudahkan pelaporan sampah, memonitor status, 
      dan mendapatkan poin penghargaan dari kontribusi Anda menjaga lingkungan.
    </p>

    <style>
      .fitur-card {
        transition: all .25s ease-in-out;
        border-radius: 18px;
      }
      .fitur-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 2rem rgba(0,0,0,0.12);
      }
      .fitur-img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        margin-bottom: 20px;
      }
    </style>

    <div class="row g-4">

      <!-- Fitur 1 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 fitur-card">
          <img src="https://undraw.co/api/illustrations/map.svg" class="fitur-img" alt="Laporan Lokasi">
          <h5 class="fw-bold mb-2">Laporan Lokasi Sampah</h5>
          <p class="text-muted small">
            Laporkan lokasi sampah dengan peta interaktif yang langsung mengambil titik lokasi Anda.
          </p>
        </div>
      </div>

      <!-- Fitur 2 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 fitur-card">
          <img src="https://undraw.co/api/illustrations/photo.svg" class="fitur-img" alt="Unggah Foto">
          <h5 class="fw-bold mb-2">Unggah Foto Bukti</h5>
          <p class="text-muted small">
            Tambahkan hingga 5 foto agar petugas dapat melihat kondisi sampah secara akurat.
          </p>
        </div>
      </div>

      <!-- Fitur 3 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 fitur-card">
          <img src="https://undraw.co/api/illustrations/checked.svg" class="fitur-img" alt="Verifikasi">
          <h5 class="fw-bold mb-2">Status Verifikasi</h5>
          <p class="text-muted small">
            Pantau perkembangan laporan dari Menunggu Verifikasi hingga Selesai Dibersihkan.
          </p>
        </div>
      </div>

      <!-- Fitur 4 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 fitur-card">
          <img src="https://undraw.co/api/illustrations/reward.svg" class="fitur-img" alt="Poin">
          <h5 class="fw-bold mb-2">Dapatkan Poin & Tukar Uang</h5>
          <p class="text-muted small">
            Kumpulkan poin dari laporan valid dan tukarkan menjadi uang atau voucher menarik.
          </p>
        </div>
      </div>

      <!-- Fitur 5 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 fitur-card">
          <img src="https://undraw.co/api/illustrations/profile.svg" class="fitur-img" alt="Profil">
          <h5 class="fw-bold mb-2">Profil & Riwayat Laporan</h5>
          <p class="text-muted small">
            Kelola profil Anda dan lihat seluruh riwayat laporan secara terstruktur.
          </p>
        </div>
      </div>

      <!-- Fitur 6 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 fitur-card">
          <img src="https://undraw.co/api/illustrations/statistics.svg" class="fitur-img" alt="Dashboard">
          <h5 class="fw-bold mb-2">Dashboard Admin & Statistik</h5>
          <p class="text-muted small">
            Admin dapat memantau laporan real-time, mengontrol data dan melihat grafik interaktif.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>
@endsection
