@extends('layouts.app')

@section('title', 'Pelajari Lebih Lanjut')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold text-center mb-4 text-success">Tentang Lapor Sampah</h2>

  <div class="row align-items-center">
    <div class="col-md-6">
      <img src="https://cdn-icons-png.flaticon.com/512/1048/1048945.png"
           alt="Lapor Sampah"
           class="img-fluid rounded shadow-sm mb-4 mb-md-0">
    </div>

    <div class="col-md-6">
      <p class="lead">
        <strong>Lapor Sampah</strong> adalah platform digital yang memudahkan masyarakat untuk melaporkan lokasi sampah secara cepat dan akurat. 
        Laporan Anda akan diteruskan kepada petugas kebersihan untuk ditindaklanjuti.
      </p>

      <ul class="list-unstyled">
        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Melapor dengan peta interaktif</li>
        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Pemantauan status laporan</li>
        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Transparansi dan efisiensi kebersihan lingkungan</li>
      </ul>

      <a href="{{ route('register') }}" class="btn btn-success mt-3 px-4">Daftar Sekarang</a>
    </div>
  </div>

  <hr class="my-5">

  <div class="text-center">
    <h4 class="fw-semibold mb-3">Ingin berkontribusi?</h4>
    <p class="text-muted mb-4">Laporkan sampah di sekitar Anda dan bantu ciptakan lingkungan bersih untuk semua.</p>
    <a href="{{ route('laporan.create') }}" class="btn btn-primary px-4">Mulai Lapor</a>
  </div>
</div>
@endsection
