@extends('layouts.admin')

@section('title', 'Manajemen Penukaran Saldo')

@section('content')


<div class="container py-5">

    <!-- Header -->
    <div class="mb-4">
        <h1 class="h3 fw-bold">Manajemen Penukaran Saldo</h1>
        <p class="text-muted">Proses transfer dan lihat riwayat penukaran poin menjadi saldo.</p>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="mb-1 text-muted small">Total Penukaran Pending</p>
                    <h3 class="fw-bold">{{ $totalPending }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="mb-1 text-muted small">Total Saldo Ditransfer</p>
                    <h3 class="fw-bold">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="mb-1 text-muted small">Total Poin Ditukar</p>
                    <h3 class="fw-bold">{{ number_format($totalPoin) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="redeemTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="permintaan-tab" data-bs-toggle="tab" data-bs-target="#permintaan" type="button" role="tab" aria-controls="permintaan" aria-selected="true">Permintaan Penukaran</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="riwayat-tab" data-bs-toggle="tab" data-bs-target="#riwayat" type="button" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat Penukaran</button>
        </li>
    </ul>

    <div class="tab-content" id="redeemTabContent">
        <!-- Tab Permintaan -->
        <div class="tab-pane fade show active" id="permintaan" role="tabpanel" aria-labelledby="permintaan-tab">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Cari pengguna...">
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Pengguna</th>
                            <th>Tanggal</th>
                            <th>Poin</th>
                            <th>Jumlah Saldo</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Bank</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permintaan as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ number_format($item->jumlah_poin) }}</td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td>{{ $item->no_rekening }}</td>
                            <td>{{ $item->bank }}</td>
                            <td>
                                <span class="badge 
            {{ $item->status == 'menunggu' ? 'bg-warning text-dark' : 
               ($item->status == 'diproses' ? 'bg-info text-dark' : 
               ($item->status == 'selesai' ? 'bg-success' : 'bg-danger')) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                @if($item->status == 'menunggu')
                                <a href="{{ route('admin.point.proses', $item->id) }}" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-right-circle"></i> Proses
                                </a>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Tab Riwayat -->
        <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Pengguna</th>
                            <th>Tanggal</th>
                            <th>Poin</th>
                            <th>Jumlah Saldo</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Bank</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ number_format($item->jumlah_poin) }}</td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td>{{ $item->no_rekening }}</td>
                            <td>{{ $item->bank }}</td>
                            <td>
                                <span class="badge 
                        {{ $item->status == 'menunggu' ? 'bg-warning text-dark' : 
                           ($item->status == 'diproses' ? 'bg-info text-dark' : 
                           ($item->status == 'selesai' ? 'bg-success' : 'bg-danger')) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @endsection