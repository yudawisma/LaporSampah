@extends('layouts.petugas')

@section('title', 'Detail Laporan')

@section('content')

<style>
    body {
        font-family: "Public Sans", sans-serif;
        background-color: #f6f8f6;
        color: #233323;
    }

    .text-primary-custom {
        color: #17cf17 !important;
    }

    .bg-primary-custom {
        background-color: #17cf17 !important;
    }

    .badge-status {
        font-weight: 600;
    }

    .report-img {
        object-fit: cover;
        width: 100%;
        height: 300px;
    }
</style>

<main class="container ">
    <!-- Breadcrumb -->
    <div class="mb-4 small text-muted">
        <a href="" class="text-primary-custom text-decoration-none">Laporan</a> /
        <span>Detail Laporan</span>
    </div>

    <!-- Card utama gabungan -->
    <div class="card shadow-sm p-4">

        <!-- Header Laporan -->
        <div class="row g-0 mb-4">
            <div class="col-md-6">
                <img src="{{ $laporan->photos->first() ? asset('storage/' . $laporan->photos->first()->path) : asset('images/default-report.jpg') }}" class="img-fluid rounded report-img" alt="Foto Laporan">
            </div>
            <div class="col-md-6 d-flex flex-column ps-md-4 mt-3 mt-md-0">
                <h4 class="fw-bold">{{ $laporan->deskripsi }}</h4>
                <p class="text-muted mb-1">Dilaporkan oleh: {{ $laporan->user->name ?? 'User tidak ditemukan' }}</p>
                <p class="text-muted mb-3">Alamat: {{ $laporan->alamat }}</p>
                <span class="badge 
                    @if($laporan->status=='baru') bg-secondary
                    @elseif($laporan->status=='diproses') bg-warning text-dark
                    @elseif($laporan->status=='selesai') bg-success
                    @else bg-danger @endif badge-status">
                    {{ ucfirst($laporan->status) }}
                </span>
                <div class="mt-auto">
                    <!-- Tombol Lihat Peta -->
                    <button type="button" class="btn btn-outline-success w-100 mt-3 d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#mapModal">
                        <span class="material-symbols-outlined">location_on</span>
                        Lihat Lokasi di Peta
                    </button>

                    <!-- Modal Map -->
                    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mapModalLabel">Lokasi Laporan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="reportMap" style="height: 400px; width: 100%; border-radius: 8px; border: 1px solid #ccc;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="mb-4">
            <h5 class="fw-bold mb-3">Informasi Tambahan</h5>
            <div class="row mb-2">
                <div class="col-4 fw-semibold text-muted">Jenis Sampah</div>
                <div class="col-8">Sampah Rumah Tangga</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold text-muted">Lokasi</div>
                <div class="col-8">{{ $laporan->alamat }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-semibold text-muted">Deskripsi</div>
                <div class="col-8">{{ $laporan->deskripsi }}</div>
            </div>
        </div>

        <!-- Bukti Foto -->
        <div class="mb-4">
            <h5 class="fw-bold mb-3">Bukti Foto</h5>
            <div class="row g-3">
                @foreach($laporan->photos as $photo)
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $photo->path) }}" class="img-fluid rounded" alt="Bukti Foto">
                </div>
                @endforeach
            </div>
        </div>

        <!-- Validasi Pembersihan -->
        <!-- Validasi Pembersihan -->
<div class="mb-4 bg-light p-3 rounded">
    <h5 class="fw-bold mb-3">Validasi Pembersihan</h5>

    <form action="{{ route('petugas.laporan.validate', $laporan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- Catatan opsional -->
        <textarea name="catatan" class="form-control mb-3" placeholder="Tambahkan catatan (opsional)"></textarea>

        <!-- Upload Bukti Foto -->
        <div class="mb-3">
            <label class="form-label">Unggah Bukti Foto</label>
            <input type="file" name="bukti_foto[]" class="form-control" multiple>
        </div>

        <!-- Tombol Validasi -->
        <button type="submit" class="btn btn-success text-black w-100 d-flex align-items-center justify-content-center gap-2">
            <span class="material-symbols-outlined">assignment_turned_in</span>
            Validasi Pembersihan
        </button>
    </form>
</div>


        <a href="{{ route('petugas.dashboard') }}" class="btn btn-outline-primary">Kembali ke Dashboard</a>

    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('mapModal');
    modal.addEventListener('shown.bs.modal', function() {
        // Lat & Lng dari laporan
        var lat = {{ $laporan->lat ?? -7.4246 }};
        var lng = {{ $laporan->lng ?? 109.2314 }};

        // Inisialisasi map
        var map = L.map('reportMap').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Marker posisi user
        L.marker([lat, lng]).addTo(map)
            .bindPopup("Lokasi User")
            .openPopup();
    });
});
</script>


@endsection