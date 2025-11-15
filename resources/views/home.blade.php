@extends('layouts.app')

@section('title', 'Beranda - Lapor Sampah')

@section('content')

<!-- Hero Section -->
<section class="position-relative text-white text-center">
  <div class="position-absolute top-0 start-0 w-100 h-100"
    style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuB2ZO_Lj_vOGXfMhTnbbVTHeZMF7We2ZC0Du4eYb2B2wH-wlFDVAhxwOwbM3_7Co54hH7zsqf3a2k_bRO08YqfdgsCNEGAZgeLPQeQ45nyYQXW2dwthao5nSz0ujyHrXMhDARrKpuLS5reOiNGV8Zx0viysvYH1dK2DaJNOsJx5d5HjQVwXTnXE_DZhmWt4UVl_mzuFUoxVuILKUCGS3OEnpelJHAfT4T6MIO51DriuBcOXbL-_lfCvxci_NUygzc4rC9bR9iBydhEQ'); background-size:cover; background-position:center;"></div>
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>

  <div class="position-relative container py-5 my-5">
    <h1 class="fw-black display-5 mb-3">Bersihkan Lingkunganmu, Satu Laporan Sampah</h1>
    <p class="lead mx-auto mb-4" style="max-width:700px;">
      Lapor Sampah adalah aplikasi yang menghubungkan warga dengan petugas kebersihan untuk menciptakan lingkungan yang lebih bersih dan sehat.
    </p>

    <div class="d-flex flex-wrap justify-content-center gap-3">
      @auth
      <a href="{{ route('laporan.create') }}" class="btn bg-primary-custom text-white px-4 py-2">
        Lapor Sekarang
      </a>
      @else
      <button class="btn bg-primary-custom text-white px-4 py-2" id="btnLaporSekarang">
        Lapor Sekarang
      </button>
      @endauth

      <a href="{{ route('pelajari') }}" class="btn btn-outline-light px-4 py-2">
        Pelajari Lebih Lanjut
      </a>
    </div>
  </div>
</section>

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById('btnLaporSekarang');
    if (btn) {
      btn.addEventListener('click', function() {
        alert('Silakan login atau daftar terlebih dahulu untuk membuat laporan.');
      });
    }
  });
</script>
@endpush


<!-- Cara Melapor -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">Cara Melapor Sampah</h2>
    <p class="text-muted mb-5">Ikuti langkah-langkah mudah ini untuk membuat lingkungan kita lebih bersih.</p>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="p-3">
          <div class="bg-success-subtle rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:70px; height:70px;">
            <span class="fw-bold fs-4 text-primary-custom">1</span>
          </div>
          <h5 class="fw-bold">Daftar / Masuk</h5>
          <p class="text-muted small">Buat akun atau masuk ke akun Anda yang sudah ada untuk memulai.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="p-3">
          <div class="bg-success-subtle rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:70px; height:70px;">
            <span class="fw-bold fs-4 text-primary-custom">2</span>
          </div>
          <h5 class="fw-bold">Buat Laporan</h5>
          <p class="text-muted small">Klik tombol <strong>'Lapor Sekarang'</strong>, tandai lokasi, dan unggah foto sampah.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="p-3">
          <div class="bg-success-subtle rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:70px; height:70px;">
            <span class="fw-bold fs-4 text-primary-custom">3</span>
          </div>
          <h5 class="fw-bold">Tunggu Verifikasi</h5>
          <p class="text-muted small">Petugas akan memverifikasi laporan Anda dan mengambil tindakan di lokasi.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="p-3">
          <div class="bg-success-subtle rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:70px; height:70px;">
            <span class="fw-bold fs-4 text-primary-custom">4</span>
          </div>
          <h5 class="fw-bold">Dapatkan Poin </h5>
          <p class="text-muted small">Setiap laporan yang valid akan memberi Anda poin yang bisa ditukar dengan uang tunai atau saldo digital.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Tukar Poin -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Cara Menukar Poin</h2>
      <p class="text-muted">Setiap laporan yang terverifikasi akan mendapatkan poin yang bisa ditukar dengan hadiah menarik.</p>
    </div>
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <h4 class="fw-bold">Kumpulkan Poin Anda</h4>
        <p class="text-muted">Setelah laporan Anda diverifikasi oleh petugas, Anda akan secara otomatis menerima poin. Semakin banyak Anda melapor, semakin banyak poin yang Anda kumpulkan.</p>
        <h4 class="fw-bold mt-3">Tukarkan dengan Hadiah</h4>
        <p class="text-muted">Kunjungi halaman 'Tukar Poin' di profil Anda untuk melihat katalog hadiah. Pilih hadiah yang Anda inginkan dan ikuti instruksi penukaran.</p>
        <p class="small text-muted mt-2">*Syarat dan ketentuan berlaku.</p>
      </div>
      <div class="col-md-6 text-center">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJiyIYTm4gd4FNB05LSI9Teum7q92zreVsUfV9jTOhGrGEMrzIGEOZaxZ77xzeqpMbG02IrFO5HON7_k3cg1pZNpIwo2XDM3XCNKrBez2hI6vHlO0iO1VOXZRqsq4k5aeoGNS-7-G53l8_pfhSKaGMPAmuA3U5wg1TDhXX9zFwbMjf5hx4hPDcf3Xc-uQlZAocY5EtyXhnqZoGssdwKbX1iuVgT4ARdkNaouX3jhMyOF2XT2VvARJFDsGw-JXfk_HA1Ugpm8qp5p20"
          alt="Reward illustration" class="img-fluid rounded">
      </div>
    </div>
  </div>
</section>

<!-- Testimoni -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Testimoni</h2>
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="card border-0">
          <div class="ratio ratio-1x1 rounded" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuBY_ClB8cG3UjYMRc-WcawnCrH8G74C2BgfIUbTbqJ6dr9BzPODVIW37iI53GbbDrTpNl3OAaxkGv23D2uHCvZjN-AVk5vX0mqSdqoDADz5C98fr7he4cL_3ow1jUAXv8ICZUtJvnv25zpIDEQVfK5VPY6l7JRgwKgghhA2npNFdLU0u--xF65PD1Ydp5pwYxq7GaztaxNZK9F9Xp9HQ40PfrZqBn0SJxHebbQcjLyvCRNicGN-jQ9-uZAgi8XXwHtVG7yLeFEjCSXm'); background-size:cover; background-position:center;"></div>
          <div class="card-body">
            <p>"Aplikasi ini sangat membantu! Saya bisa melaporkan sampah dengan cepat dan mudah."</p>
            <p class="text-muted small">- Sarah, Pengguna</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card border-0">
          <div class="ratio ratio-1x1 rounded" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuA7qCj0biPzZnpFeoAUb6eWNDH9b5mhQ0dLVjNHPjU4u9zOubjc3BusP4xmrQ0TJohTIo1KTnXppJn-fdU5XzT1_V_hSEqUqOxWQ0ysq6QF2islHDXPwp66bR9k8fnr0ohL0dAp1G-utX5VxbuPqeVlXOaQAPV6fMeTxMnvxM9hcQAeFlUd2kDrUvMF44sBiZp2TsBaPYlhwX-jk7t6iUCSF_Hj_P9-GvivGSr_T_weRVmUnPlvIXOgd-OSx5O0PqReo77SEPZPOK7o'); background-size:cover; background-position:center;"></div>
          <div class="card-body">
            <p>"Saya senang dengan respons cepat dari petugas kebersihan setelah saya melaporkan."</p>
            <p class="text-muted small">- Budi, Pengguna</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card border-0">
          <div class="ratio ratio-1x1 rounded" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuC9WhiEcN62D25cuAK_4uYWONZAo927_lcfT9Nq8BG0D7XWndlmYa4zKLTIJYeUkS90sFF-oy2s0ru9SeNNXC9Help2Gr8UY-9m-k5yrAf5rQ9jw-bcjt9zcSBWbN5bwyD1ir2WmadHC8hb78vQAuqo1I0jv__WbqEkzdapVQ-nL0Cerh5bPgNkiW-K9FBd8h4o8-vwIfTNIIX7bzeZv_dqu-IFPIVeBmIlg5Sonu6WnHg_4L-CNaOaknHPbK2VZy1nJ-8QvrC9fAQK'); background-size:cover; background-position:center;"></div>
          <div class="card-body">
            <p>"Lapor Sampah membuat saya merasa berkontribusi dalam menjaga kebersihan lingkungan."</p>
            <p class="text-muted small">- Ayu, Pengguna</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Ajakan -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <h2 class="fw-bold mb-4">Mulai Laporkan Sampah Sekarang!</h2>
    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
      <a href="{{ route('register') }}" class="btn bg-primary-custom text-white fw-semibold">Daftar</a>
      <a href="{{ route('login') }}" class="btn btn-outline-primary-custom fw-semibold">Masuk</a>
    </div>
  </div>
</section>

@endsection