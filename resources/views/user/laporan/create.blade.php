@extends('layouts.user')

@section('title', 'Buat Laporan Baru')

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="container py-5">
    <div class="max-w-4xl mx-auto">
        <h2 class="fw-bold text-center mb-5">Buat Laporan Baru</h2>

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" id="laporanForm">
            @csrf
            <div class="row g-4">
                <!-- Kolom Kiri: Deskripsi & Lokasi -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Sampah</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" placeholder="Jelaskan jenis sampah..." required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Lokasi</label>
                        {{-- Ini otomatis render peta lewat komponen Livewire --}}
                        <livewire:laporan-map />

                        <label for="alamat" class="form-label mt-3 fw-semibold">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat otomatis dari peta" readonly>
                    </div>
                </div>

                <!-- Kolom Kanan: Foto -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Foto Sampah (maks 5)</label>
                        <div class="border border-2 border-dashed rounded p-3 text-center bg-light">
                            <div id="preview-container" class="d-flex flex-wrap gap-2 mb-2 justify-content-center"></div>
                            <input type="file" name="foto[]" id="foto" class="form-control" accept="image/jpeg,image/png,image/jpg" multiple onchange="previewImages(event)">
                            <small class="text-muted">Bisa pilih maksimal 5 foto sekaligus.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary px-4 me-2">Kembali</a>
                <button type="submit" class="btn btn-success px-4">Kirim Laporan</button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk preview foto saja --}}
@push('scripts')
<script>
    let selectedFiles = [];

    function previewImages(event) {
        const newFiles = Array.from(event.target.files);
        selectedFiles = selectedFiles.concat(newFiles).slice(0, 5);
        renderPreview();
    }

    function renderPreview() {
        const container = document.getElementById('preview-container');
        container.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('position-relative', 'd-inline-block');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'm-1');
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                wrapper.appendChild(img);

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.innerHTML = '&times;';
                btn.classList.add('btn', 'btn-sm', 'btn-danger', 'position-absolute');
                btn.style.top = '0';
                btn.style.right = '0';

                btn.addEventListener('click', () => {
                    selectedFiles.splice(index, 1);
                    renderPreview();
                });

                wrapper.appendChild(btn);
                container.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endpush
@endsection