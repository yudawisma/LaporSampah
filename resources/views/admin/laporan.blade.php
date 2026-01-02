@extends('layouts.admin')
@section('title', 'Laporan Selesai')

@section('content')
<div class="container py-5">

  {{-- Header + Action --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="fw-bold mb-1">Laporan Selesai</h1>
      <p class="text-muted mb-0">
        Daftar laporan sampah yang telah diselesaikan oleh petugas.
      </p>
    </div>

    <form action="{{ route('admin.laporan.deleteAll') }}" method="POST"
      onsubmit="return confirm('Yakin ingin menghapus SEMUA laporan selesai?')">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i> Hapus Semua
      </button>
    </form>
  </div>

  {{-- Alert --}}
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  {{-- Table --}}
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle small">
      <thead class="table-light text-center">
        <tr>
          <th>Pelapor</th>
          <th>Petugas</th>
          <th>Lokasi</th>
          <th>Tanggal Selesai</th>
          <th>Deskripsi</th>
          <th>Bukti </th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($laporanSelesai as $laporan)
        <tr>
          <td>{{ $laporan->user->name }}</td>

          <td>{{ $laporan->petugas?->name ?? '-' }}</td>

          <td>
            <span title="{{ $laporan->alamat }}">
              {{ Str::limit($laporan->alamat, 40) }}
            </span>
          </td>

          <td class="text-center">
            {{ $laporan->updated_at->format('d M Y') }}
          </td>

          <td>{{ Str::limit($laporan->deskripsi, 60) }}</td>

          {{-- Bukti Awal --}}
          <td class="text-center">
            @forelse($laporan->photos->where('type','before') as $photo)
            <a href="{{ asset('storage/'.$photo->path) }}"
              target="_blank"
              class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-eye"></i>
            </a>
            @empty
            <span class="text-muted">-</span>
            @endforelse
          </td>



          <td class="text-center">
            <span class="badge bg-success">
              {{ ucfirst($laporan->status) }}
            </span>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center text-muted">
            Tidak ada laporan selesai.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection