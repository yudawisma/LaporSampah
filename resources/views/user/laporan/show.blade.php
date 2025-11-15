@extends('layouts.user')

@section('title', 'Detail Laporan')

@section('content')
<div class="container py-4">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h4 class="fw-bold mb-3">Detail Laporan</h4>

      <div class="mb-3">
        <h6 class="fw-semibold mb-1">Tanggal Laporan</h6>
        <p class="mb-0 text-muted">{{ $laporan->created_at->format('d M Y H:i') }}</p>
      </div>

      <div class="mb-3">
        <h6 class="fw-semibold mb-1">Status</h6>
        @if ($laporan->status == 'baru')
          <span class="badge bg-secondary">Baru</span>
        @elseif ($laporan->status == 'diproses')
          <span class="badge bg-warning text-dark">Diproses</span>
        @elseif ($laporan->status == 'selesai')
          <span class="badge bg-success">Selesai</span>
        @else
          <span class="badge bg-danger">Ditolak</span>
        @endif
      </div>

      <div class="mb-3">
        <h6 class="fw-semibold mb-1">Deskripsi</h6>
        <p class="mb-0">{{ $laporan->deskripsi }}</p>
      </div>

      <div class="mb-3">
        <h6 class="fw-semibold mb-1">Alamat / Lokasi</h6>
        @if ($laporan->lokasi)
          <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($laporan->lokasi) }}"
             target="_blank" class="text-decoration-none text-primary">
            <i class="bi bi-geo-alt-fill me-1"></i> {{ $laporan->lokasi }}
          </a>
        @else
          <p class="text-muted mb-0">Tidak ada lokasi yang ditentukan</p>
        @endif
      </div>

      <div class="mb-3">
        <h6 class="fw-semibold mb-1">Foto Laporan</h6>
        @if ($laporan->photos && $laporan->photos->count() > 0)
          <div class="row">
            @foreach ($laporan->photos as $photo)
              <div class="col-md-3 mb-3">
                <img src="{{ asset('storage/' . $photo->path) }}" class="img-fluid rounded shadow-sm">
              </div>
            @endforeach
          </div>
        @else
          <p class="text-muted mb-0">Tidak ada foto yang diunggah.</p>
        @endif
      </div>

      <div class="text-end mt-4">
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Kembali 
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
