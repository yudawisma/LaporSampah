@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Tentang Lapor Sampah</h2>
    <p class="text-muted mb-5 mx-auto" style="max-width: 700px;">
      <strong>Lapor Sampah</strong> adalah platform digital yang menghubungkan masyarakat dengan petugas kebersihan
      untuk menciptakan lingkungan yang lebih bersih, sehat, dan berkelanjutan.  
      Kami percaya bahwa setiap warga memiliki peran penting dalam menjaga kebersihan lingkungan.
    </p>

    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h5 class="fw-bold">🌱 Misi Kami</h5>
            <p class="text-muted small">
              Meningkatkan kesadaran masyarakat terhadap pentingnya kebersihan dengan memanfaatkan teknologi yang mudah digunakan.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h5 class="fw-bold">🤝 Kolaborasi</h5>
            <p class="text-muted small">
              Bekerja sama dengan pemerintah daerah, komunitas, dan individu untuk mempercepat aksi kebersihan kota.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h5 class="fw-bold">💡 Visi Kami</h5>
            <p class="text-muted small">
              Menjadi aplikasi pelaporan kebersihan terdepan yang membantu menciptakan lingkungan bebas sampah di seluruh Indonesia.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
