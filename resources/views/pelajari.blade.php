@extends('layouts.app')

@section('title', 'Pelajari Lebih Lanjut')

@section('content')
<div class="container py-5">

  <h2 class="fw-bold text-center mb-4" style="color:#17cf17;">
    Tentang Lapor Sampah
  </h2>

  <div class="row align-items-center">
    <div class="col-md-6">
      <img src="https://cdn-icons-png.flaticon.com/512/1048/1048945.png"
           alt="Lapor Sampah"
           class="img-fluid rounded shadow-sm mb-4 mb-md-0">
    </div>

    <div class="col-md-6">
      <p class="lead">
        <strong style="color:#17cf17;">Lapor Sampah</strong> adalah platform digital yang memudahkan masyarakat
        untuk melaporkan lokasi sampah secara cepat dan akurat. 
        Laporan Anda akan diteruskan kepada petugas kebersihan untuk ditindaklanjuti.
      </p>

      <ul class="list-unstyled">
        <li>
          <i class="bi bi-check-circle-fill me-2" style="color:#17cf17;"></i>
          Melapor dengan peta interaktif
        </li>
        <li>
          <i class="bi bi-check-circle-fill me-2" style="color:#17cf17;"></i>
          Pemantauan status laporan
        </li>
        <li>
          <i class="bi bi-check-circle-fill me-2" style="color:#17cf17;"></i>
          Transparansi dan efisiensi kebersihan lingkungan
        </li>
      </ul>

      <a href="{{ route('register') }}"
         class="btn text-white mt-3 px-4"
         style="background-color:#17cf17;">
        Daftar Sekarang
      </a>
    </div>
  </div>

  

</div>
@endsection
