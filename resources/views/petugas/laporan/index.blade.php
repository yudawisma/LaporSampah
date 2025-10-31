@extends('layouts.petugas')

@section('title', 'Laporan Saya')

@section('content')
<main class="container py-5">
    <h2 class="fw-bold mb-4">Laporan Saya</h2>

    @if($laporans->isEmpty())
        <div class="alert alert-info">Belum ada laporan yang sedang dikerjakan.</div>
    @endif

    <div class="d-flex flex-column gap-4">
        @foreach($laporans as $laporan)
        <div class="card shadow-sm d-flex flex-row flex-wrap align-items-stretch">
            
            <!-- Foto laporan -->
            <div class="flex-shrink-0" style="width: 300px; height: 200px;">
                <img src="{{ $laporan->photos->first() ? asset('storage/' . $laporan->photos->first()->path) : asset('images/default-report.jpg') }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Foto Laporan">
            </div>

            <!-- Info laporan -->
            <div class="flex-grow-1 p-4 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="fw-bold">{{ $laporan->deskripsi }}</h5>
                    <p class="text-muted mb-1">Dilaporkan oleh: {{ $laporan->user->name ?? 'User tidak ditemukan' }}</p>
                    <p class="text-muted mb-3">Alamat: {{ $laporan->alamat }}</p>
                    <span class="badge 
                        @if($laporan->status=='baru') bg-secondary
                        @elseif($laporan->status=='diproses') bg-warning text-dark
                        @elseif($laporan->status=='selesai') bg-success
                        @else bg-danger @endif">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </div>

                <div class="mt-3 text-end">
                    <a href="{{ route('petugas.laporan.show', $laporan->id) }}" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>
@endsection
