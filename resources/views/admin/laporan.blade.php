@extends('layouts.admin')
@section('title', 'Laporan Selesai')

@section('content')
<div class="container py-5">

  <h1 class="fw-bold">Laporan Selesai</h1>
  <p class="text-muted">Daftar laporan sampah yang telah diselesaikan oleh petugas.</p>

  <div class="table-responsive mt-4">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>Pelapor</th>
          <th>Petugas</th>
          <th>Lokasi</th>
          <th>Tanggal Selesai</th>
          <th>Deskripsi Awal</th>
          <th>Deskripsi Selesai</th>
          <th>Bukti</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($laporanSelesai as $laporan)
        <tr>
          <td>{{ $laporan->user->name }}</td>
          <td>{{ $laporan->petugas?->name ?? '-' }}</td>
          <td>
            <a href="https://www.google.com/maps/search/{{ urlencode($laporan->alamat) }}"
              target="_blank" class="text-primary-custom text-decoration-none">
              {{ $laporan->alamat }}
            </a>
          </td>
          <td>{{ $laporan->updated_at->format('d M Y') }}</td>
          <td>{{ $laporan->deskripsi }}</td>
          <td>
            @foreach($laporan->photos->where('type','after') as $photo)
            <img src="{{ asset('storage/'.$photo->path) }}"
              alt="Bukti Selesai" class="rounded img-preview"
              style="height:40px;width:40px;object-fit:cover;cursor:pointer;"
              data-bs-toggle="modal" data-bs-target="#photoModal"
              data-photo="{{ asset('storage/'.$photo->path) }}">
            @endforeach
          </td>
          <td>
            @foreach($laporan->photos->where('type','before') as $photo)
            <img src="{{ asset('storage/'.$photo->path) }}"
              alt="Bukti Awal" class="rounded img-preview"
              style="height:40px;width:40px;object-fit:cover;cursor:pointer;"
              data-bs-toggle="modal" data-bs-target="#photoModal"
              data-photo="{{ asset('storage/'.$photo->path) }}">
            @endforeach
          </td>

          <!-- Modal Preview -->
          <div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <img src="" id="modalImage" class="img-fluid w-100" alt="Preview Foto">
                </div>
                <div class="modal-footer p-2">
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>



          <td><span class="status-badge">{{ ucfirst($laporan->status) }}</span></td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center">Tidak ada laporan selesai.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var photoModal = document.getElementById('photoModal');
    var modalImage = document.getElementById('modalImage');

    photoModal.addEventListener('show.bs.modal', function(event) {
      var trigger = event.relatedTarget;
      var photoSrc = trigger.getAttribute('data-photo');
      modalImage.src = photoSrc;
    });
  });
</script>
@endsection