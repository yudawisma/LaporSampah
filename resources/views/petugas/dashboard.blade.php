@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')

@section('content')
<style>
    body {
        font-family: "Public Sans", sans-serif;
        background-color: #f6f8f6;
        color: #233323;
        min-height: 100vh;
    }

    .text-primary {
        color: #17cf17 !important;
    }

    .bg-primary {
        background-color: #17cf17 !important;
    }

    .report-card {
        border: 1px solid #e7f3e7;
        border-radius: 1rem;
        background-color: #fff;
        overflow: hidden;
        transition: transform .2s;
    }

    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
    }

    .report-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .material-symbols-outlined {
        vertical-align: middle;
        font-size: 18px;
    }

    .btn-custom {
        background-color: #17cf17;
        border: none;
        color: #000;
        font-weight: 700;
        border-radius: 10px;
    }

    .btn-custom:hover {
        opacity: .85;
    }

    .status-box {
        background-color: rgba(161, 177, 161, 0.3);
        color: #233323;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: .5rem 1rem;
    }
</style>

<main class="container">
    <div class="mb-4 small text-muted">
        <a href="" class="text text-decoration-none">Beranda</a> /
    </div>
    <div class="mb-5">
        <h2 class="fw-bold display-6">Daftar Laporan Sampah</h2>
        <p class="text-secondary">Berikut adalah laporan sampah yang masuk dari pengguna.</p>
    </div>

    @if($laporans->isEmpty())
    <div class="alert alert-info">Belum ada laporan yang masuk.</div>
    @endif

    <div class="d-flex flex-column gap-4">
        @foreach($laporans as $laporan)
        <div class="report-card d-flex flex-column flex-md-row {{ $laporan->petugas_id ? 'opacity-75' : '' }}">

            {{-- Foto laporan --}}
            <img src="{{ $laporan->photos->first() ? asset('storage/' . $laporan->photos->first()->path) : asset('images/no-image.png') }}" class="report-img" alt="Foto laporan">

            {{-- Deskripsi laporan --}}
            <div class="p-4 flex-grow-1">
                <h5 class="fw-bold mb-2">{{ $laporan->judul ?? 'Laporan Sampah' }}</h5>
                <p class="text-muted small">{{ $laporan->deskripsi }}</p>
                <div class="d-flex align-items-center text-primary small">
                    <span class="material-symbols-outlined me-1"></span>
                    {{ $laporan->alamat ?? 'Lokasi tidak diketahui' }}
                </div>
            </div>

            {{-- Tombol Ambil / Status --}}
            <div class="p-4 d-flex align-items-center justify-content-center">
                @if(is_null($laporan->petugas_id))
<form action="{{ route('petugas.laporan.assign', $laporan->id) }}" method="POST" class="w-100">
    @csrf
    <button type="submit" class="btn btn-custom w-100">Ambil Laporan</button>
</form>
@elseif($laporan->petugas_id == Auth::id())
<div class="status-box">
    <span class="material-symbols-outlined"></span> Tugas Saya
</div>
@else
<div class="status-box text-muted">Sudah Diambil</div>
@endif

            </div>


        </div>
        @endforeach
    </div>
</main>
@endsection