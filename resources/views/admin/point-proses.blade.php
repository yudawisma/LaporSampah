@extends('layouts.admin')

@section('title', 'Proses Penukaran Poin')

@section('content')
<div class="container-fluid px-4 py-4">
  <h1 class="fw-bold h3 mb-3">Proses Penukaran Poin</h1>
  <p class="text-muted mb-4">
    Pastikan Anda telah mentransfer uang ke pengguna sebelum menandai transaksi sebagai selesai.
  </p>

  {{-- Alert --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-semibold">
      <i class="bi bi-credit-card me-2"></i> Detail Permintaan Penukaran
    </div>
    <div class="card-body">
      <div class="row g-4">
        <div class="col-md-6">
          <table class="table table-borderless mb-0">
            <tr>
              <th width="40%">Nama Pengguna</th>
              <td>{{ $redeem->user->name ?? '-' }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $redeem->user->email ?? '-' }}</td>
            </tr>
            <tr>
              <th>Jumlah Poin</th>
              <td class="fw-bold text-success">{{ $redeem->jumlah_poin }} Poin</td>
            </tr>
            <tr>
              <th>Nominal Uang</th>
              <td class="fw-bold text-primary">Rp {{ number_format($redeem->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <th>Tanggal Permintaan</th>
              <td>{{ $redeem->created_at->format('d M Y H:i') }}</td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table table-borderless mb-0">
            <tr>
              <th>Nama Bank</th>
              <td>{{ $redeem->bank ?? '-' }}</td>
            </tr>
            <tr>
              <th>Nomor Rekening</th>
              <td>{{ $redeem->no_rekening ?? '-' }}</td>
            </tr>
            <tr>
              <th>Atas Nama</th>
              <td>{{ $redeem->atas_nama ?? '-' }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                <span class="badge 
                  @if($redeem->status == 'menunggu') bg-warning text-dark
                  @elseif($redeem->status == 'selesai') bg-success
                  @elseif($redeem->status == 'ditolak') bg-danger
                  @endif">
                  {{ ucfirst($redeem->status) }}
                </span>
              </td>
            </tr>
          </table>
        </div>
      </div>

      @if($redeem->status == 'menunggu')
      <div class="border-top pt-4 mt-4">
        <h5 class="fw-semibold mb-3">Konfirmasi Proses Penukaran</h5>
        <p class="text-muted small">Masukkan catatan opsional (misal: "sudah ditransfer via BCA").</p>

        <form action="{{ route('admin.point.selesai', $redeem->id) }}" method="POST" enctype="multipart/form-data" class="mb-3">
          @csrf
          <div class="mb-3">
    <label for="bukti_transfer" class="form-label">Upload Bukti Transfer (gambar/PDF)</label>
    <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" accept="image/*,.pdf" required>
  </div>
          <div class="mb-3">
            <label for="catatan" class="form-label">Catatan Transaksi (opsional)</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tulis catatan..."></textarea>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Tandai Selesai (Sudah Ditransfer)
            </button>

            <a href="{{ route('admin.point') }}" class="btn btn-secondary">
              <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <form action="{{ route('admin.point.tolak', $redeem->id) }}" method="POST" class="ms-auto">
              @csrf
              <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-x-circle"></i> Tolak Permintaan
              </button>
            </form>
          </div>
        </form>
      </div>
      @else
        <div class="alert alert-info mt-4">
          <i class="bi bi-info-circle"></i> Permintaan ini sudah diproses (status: {{ $redeem->status }}).
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
