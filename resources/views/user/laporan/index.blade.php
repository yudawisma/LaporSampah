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

  /* Desktop normal */
  .table-responsive { border-radius: 12px; overflow: hidden; }
  table.table { margin-bottom: 0; border-collapse: collapse !important; width: 100%; }
  table.table td, table.table th { white-space: nowrap; }

  /* --- MOBILE: ubah ke card-like list --- */
  @media (max-width: 576px) {
    /* sembunyikan header */
    table.table thead { display: none; }

    /* baris jadi block (card) */
    table.table tbody tr {
      display: block;
      margin-bottom: 12px;
      background: #fff;
      border-radius: 12px;
      padding: 12px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.06);
      border: 1px solid #f1f1f1;
    }

    /* tiap cell jadi baris flex di dalam card */
    table.table tbody td {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 6px 0;
      border: none !important;
      white-space: normal;           /* allow wrapping */
      word-break: break-word;
      font-size: 14px;
    }

    /* tampilkan label (kiri) dari data-label */
    table.table tbody td::before {
      content: attr(data-label);
      font-weight: 600;
      color: #444;
      flex-basis: 38%;
      max-width: 38%;
      padding-right: 8px;
      text-align: left;
    }

    /* Sembunyikan kolom nomor & deskripsi sesuai request */
    td[data-label="#"],
    td[data-label="Deskripsi"] {
      display: none !important;
    }

    /* Status taruh di atas (urutkan) dan full width */
    td[data-label="Status"] {
      order: -1;
      width: 100%;
      margin-bottom: 8px;
      justify-content: flex-start;
      gap: 8px;
    }

    /* Aksi (ikon) di kanan, compact */
    td[data-label="Aksi"] {
      display: flex !important;
      justify-content: flex-end;
      align-items: center;
      gap: 8px;
      margin-top: 6px;
    }

    /* tombol aksi: kotak kecil hanya ikon */
    td[data-label="Aksi"] .btn {
      min-width: 38px;
      height: 38px;
      padding: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
    }

    /* buat teks alamat supaya tidak terlalu panjang */
    
  /* FIX: Kolom Alamat jadi vertical */
  td[data-label="Alamat"] {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 4px;
  }

  td[data-label="Alamat"]::before {
    flex-basis: auto !important;
    max-width: 100% !important;
    width: 100%;
    margin-bottom: 2px;
  }

  td[data-label="Alamat"] {
    max-width: 100% !important;
    white-space: normal !important;
    word-break: break-word;
  }

    /* pastikan card tidak merusak layout container */
    .table-responsive { padding: 6px; }
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
          <td data-label="#"> {{ $loop->iteration }} </td>

          <td data-label="Tanggal">
            {{ $laporan->created_at->format('d M Y, H:i') }}
          </td>

          <td data-label="Deskripsi">
            {{ Str::limit($laporan->deskripsi, 50) }}
          </td>

          <td data-label="Alamat">
            {{ Str::limit($laporan->alamat, 40) }}
          </td>

          <td data-label="Status">
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

          <td data-label="Aksi" class="text-end">
            <a href="{{ route('laporan.show', $laporan->id) }}"
              class="btn btn-sm btn-outline-success me-1"
              title="Detail">
              <i class="bi bi-eye"></i>
            </a>

            <form action="{{ route('laporan.destroy', $laporan->id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" title="Hapus">
                <i class="bi bi-trash"></i>
              </button>
            </form>
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