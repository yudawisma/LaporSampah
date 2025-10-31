@extends('layouts.user')

@section('title', 'Dashboard Pengguna')

@section('content')

<style>
  body {
    font-family: 'Public Sans', sans-serif;
    background-color: #f6f8f6;
    color: #333;
  }

  .bg-primary-custom {
    background-color: #17cf17 !important;
  }

  .text-primary-custom {
    color: #17cf17 !important;
  }

  .btn-primary-custom {
    background-color: #17cf17 !important;
    border-color: #17cf17 !important;
    color: #fff !important;
  }

  .btn-primary-custom:hover {
    background-color: #13b813 !important;
    border-color: #13b813 !important;
  }

  .fade-in {
    animation: fadeIn 0.8s ease-in-out;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<main class="flex-grow-1 py-5">
  <div class="container">

    <!-- Hero Section -->
    <div class="card border-0 shadow-sm mb-5 bg-primary-custom text-white rounded-4 fade-in">
      <div class="card-body py-4 px-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h4 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }} 👋</h4>
          <p class="mb-0">Terima kasih sudah peduli dengan kebersihan lingkungan 🌿</p>
        </div>
        <img src="/images/cleaning-illustration.svg" alt="Ilustrasi Kebersihan" style="height: 90px;">
      </div>
    </div>

    <!-- Statistik dan Ajak Lapor -->
    <div class="row g-4 fade-in">

      <!-- Card Poin -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 rounded-4">
          <div class="d-flex align-items-center">
            <div class="bg-primary-custom bg-opacity-10 p-3 rounded-3 me-3">
              <i class="bi bi-star-fill fs-3 text-primary-custom"></i>
            </div>
            <div>
              <h6 class="fw-semibold mb-1 text-muted">Total Poin</h6>
              <h3 class="fw-bold text-primary-custom mb-0">{{ Auth::user()->poin ?? 0 }}</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Ajak Lapor -->
      <div class="col-md-8">
        <div class="card border-0 shadow-sm p-4 rounded-4 bg-light d-flex flex-column flex-md-row align-items-center justify-content-between">
          <div class="mb-3 mb-md-0">
            <h5 class="fw-semibold mb-1">Siap membuat lingkungan lebih bersih?</h5>
            <p class="text-muted mb-0">Laporkan sampah di sekitar Anda dan dapatkan poin!</p>
          </div>
          <a href="{{ route('laporan.create') }}" class="btn btn-primary-custom fw-bold px-4 py-2">
            <i class="bi bi-plus-circle me-1"></i> Lapor Sampah
          </a>
        </div>
      </div>
    </div>

    <!-- Riwayat Laporan -->
    <div class="mt-5 fade-in">
      <h4 class="fw-bold mb-3">Riwayat Laporan</h4>
      <div class="table-responsive bg-white shadow-sm rounded-4">
        <table class="table table-borderless align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th>Tanggal</th>
              <th>Deskripsi</th>
              <th>Alamat</th>
              <th>Status</th>
              <th class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($laporans as $laporan)
            <tr class="fade-in">
              <td>{{ $laporan->created_at->format('Y-m-d H:i') }}</td>
              <td>{{ Str::limit($laporan->deskripsi, 30) }}</td>
              <td>{{ Str::limit($laporan->alamat, 40) }}</td>
              <td>
                @if ($laporan->status == 'baru')
                <span class="badge rounded-pill bg-secondary"><i class="bi bi-clock me-1"></i>Baru</span>
                @elseif ($laporan->status == 'diproses')
                <span class="badge rounded-pill bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Diproses</span>
                @elseif ($laporan->status == 'selesai')
                <span class="badge rounded-pill bg-success"><i class="bi bi-check-circle me-1"></i>Selesai</span>
                @else
                <span class="badge rounded-pill bg-danger"><i class="bi bi-x-circle me-1"></i>Ditolak</span>
                @endif
              </td>
              <td class="text-end">
                <a href="{{ route('laporan.show', $laporan->id) }}" class="btn btn-sm btn-outline-primary">
                  <i class="bi bi-eye"></i> Lihat
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center text-muted py-5">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                Belum ada laporan yang dikirim.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Tips Kebersihan -->
    <div class="mt-5 fade-in">
      <h5 class="fw-bold mb-3">Tips Kebersihan Hari Ini 💡</h5>
      <div class="alert alert-success bg-opacity-10 border-0 text-success rounded-4">
        <i class="bi bi-recycle me-2"></i> Pisahkan sampah organik dan anorganik sebelum dibuang untuk memudahkan daur ulang!
      </div>
    </div>

  </div>
</main>




@endsection
