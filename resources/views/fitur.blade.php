@extends('layouts.app')

@section('title', 'Fitur Lapor Sampah')

@section('content')
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Fitur Utama Lapor Sampah</h2>
    <p class="text-muted mb-5 mx-auto" style="max-width: 700px;">
      Kami menyediakan berbagai fitur untuk memudahkan masyarakat melaporkan sampah, memantau status laporan,
      dan mendapatkan penghargaan atas kontribusinya dalam menjaga kebersihan lingkungan.
    </p>

    <div class="row g-4">
      <!-- Fitur 1 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4">
          <div class="text-success fs-1 mb-3"><i class="bi bi-geo-alt-fill"></i></div>
          <h5 class="fw-bold">Laporan Lokasi Sampah</h5>
          <p class="text-muted small">
            Laporkan lokasi sampah dengan mudah menggunakan peta interaktif. Sistem akan otomatis mengambil alamat Anda.
          </p>
        </div>
      </div>

      <!-- Fitur 2 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4">
          <div class="text-success fs-1 mb-3"><i class="bi bi-images"></i></div>
          <h5 class="fw-bold">Unggah Foto Bukti</h5>
          <p class="text-muted small">
            Tambahkan hingga 5 foto untuk memperjelas kondisi sampah yang dilaporkan.
          </p>
        </div>
      </div>

      <!-- Fitur 3 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4">
          <div class="text-success fs-1 mb-3"><i class="bi bi-check-circle-fill"></i></div>
          <h5 class="fw-bold">Status Verifikasi</h5>
          <p class="text-muted small">
            Pantau status laporan Anda dari “Menunggu Verifikasi” hingga “Selesai Dibersihkan”.
          </p>
        </div>
      </div>

      <!-- Fitur 4 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4">
          <div class="text-success fs-1 mb-3"><i class="bi bi-coin"></i></div>
          <h5 class="fw-bold">Dapatkan Poin & Tukar Uang</h5>
          <p class="text-muted small">
            Setiap laporan yang valid akan memberi Anda poin. Kumpulkan poin dan tukarkan dengan uang tunai atau voucher.
          </p>
        </div>
      </div>

      <!-- Fitur 5 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4">
          <div class="text-success fs-1 mb-3"><i class="bi bi-person-badge"></i></div>
          <h5 class="fw-bold">Profil & Riwayat Laporan</h5>
          <p class="text-muted small">
            Kelola profil Anda dan lihat seluruh riwayat laporan yang pernah dikirim.
          </p>
        </div>
      </div>

      <!-- Fitur 6 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4">
          <div class="text-success fs-1 mb-3"><i class="bi bi-bar-chart-line-fill"></i></div>
          <h5 class="fw-bold">Dashboard Admin & Statistik</h5>
          <p class="text-muted small">
            Admin dapat melihat laporan secara real-time, meninjau status, dan menampilkan data dalam grafik interaktif.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
