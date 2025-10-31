@extends('layouts.user')

@section('title', 'Laporan Saya')

@section('content')
<style>
  .btn-primary-custom {
    background-color: #17cf17 !important;
    border-color: #17cf17 !important;
    color: #fff !important;
  }
  .btn-primary-custom:hover {
    background-color: #13b813 !important;
    border-color: #13b813 !important;
  }
</style>

<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-dark">Laporan Saya</h3>
    <a href="{{ route('laporan.create') }}" class="btn btn-primary-custom fw-semibold">
      <i class="bi bi-plus-circle me-1"></i> Buat Laporan Baru
    </a>
  </div>

  {{-- Notifikasi sukses --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Jika belum ada laporan --}}
  @if($laporans->isEmpty())
    <div class="text-center text-muted py-5">
      <i class="bi bi-clipboard-x" style="font-size: 3rem;"></i>
      <p class="mt-3">Belum ada laporan yang kamu buat.</p>
      <a href="{{ route('laporan.create') }}" class="btn btn-primary-custom mt-2">
        <i class="bi bi-plus-circle"></i> Buat Laporan Sekarang
      </a>
    </div>
  @else
    {{-- Tabel laporan --}}
    <div class="table-responsive bg-white shadow-sm rounded-3">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th class="text-center" width="5%">#</th>
            <th width="15%">Tanggal</th>
            <th width="30%">Deskripsi</th>
            <th width="25%">Alamat</th>
            <th width="10%">Status</th>
            <th class="text-end" width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($laporans as $laporan)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $laporan->created_at->format('d M Y, H:i') }}</td>
            <td>{{ Str::limit($laporan->deskripsi, 50) }}</td>
            <td>{{ Str::limit($laporan->alamat, 40) }}</td>
            <td>
              @if($laporan->status == 'baru')
                <span class="badge bg-secondary">Baru</span>
              @elseif($laporan->status == 'diproses')
                <span class="badge bg-warning text-dark">Diproses</span>
              @elseif($laporan->status == 'selesai')
                <span class="badge bg-success">Selesai</span>
              @else
                <span class="badge bg-danger">Ditolak</span>
              @endif
            </td>
            <td class="text-end">
              <a href="{{ route('laporan.show', $laporan->id) }}" class="btn btn-sm btn-outline-success">
                <i class="bi bi-eye"></i> Detail
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
      {{ $laporans->links('pagination::bootstrap-5') }}
    </div>
  @endif

</div>
@endsection
