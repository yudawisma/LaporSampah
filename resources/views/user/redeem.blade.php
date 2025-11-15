@extends('layouts.user')

@section('title', 'Tukar Poin')

@section('content')
<div class="container py-5">

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

    <!-- Poin Saya -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Poin Saya</h2>
        <p>Anda memiliki <span class="fw-bold text-success">{{ $user->poin }} poin</span>. Tukarkan poin Anda dengan saldo.</p>
    </div>

    <!-- Tukarkan Poin -->
    <div class="card card-rounded p-4 shadow mb-5">
        <h3 class="text-center mb-4 fw-bold">Tukarkan Poin dengan Saldo</h3>
        <form action="{{ route('user.redeem.store') }}" method="POST" id="redeemForm">
            @csrf
            <div class="row g-3 mb-3 text-center">
                @foreach([1000, 2000, 5000, 7500, 10000] as $poin)
                <div class="col-6 col-md-2">
                    <button type="button"
                        class="btn btn-custom w-100 redeem-btn"
                        data-poin="{{ $poin }}">
                        {{ $poin }} Poin
                    </button>
                </div>
                @endforeach
            </div>

            <p class="text-center fw-medium mb-4">1000 Poin = Rp 100.000</p>

            <input type="hidden" name="jumlah_poin" id="jumlah_poin">

            <div class="mb-3">
                <label for="no_rekening" class="form-label">Nomor Rekening</label>
                <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="Masukkan nomor rekening Anda" required>
            </div>
            <div class="mb-3">
                <label for="bank" class="form-label">Nama Bank</label>
                <input type="text" class="form-control" id="bank" name="bank" placeholder="Masukkan nama bank" required>
            </div>
            <div class="mb-3">
                <label for="atas_nama" class="form-label">Atas Nama Rekening</label>
                <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Masukkan nama pemilik rekening" required>
            </div>
            <button type="submit" class="btn btn-custom w-100 mt-3">Konfirmasi Penukaran</button>
        </form>
    </div>

    <style>
        .btn-custom {
            background-color: #17cf17;
            color: #fff;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #13b213;
            color: #fff;
        }

        .redeem-btn.selected {
            box-shadow: 0 0 0 3px rgba(23, 207, 23, 0.5);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userPoin = Number("{{ $user->poin ?? 0 }}");

            const redeemButtons = document.querySelectorAll('.redeem-btn');
            const jumlahInput = document.getElementById('jumlah_poin');
            const form = document.getElementById('redeemForm');

            redeemButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const poin = parseInt(this.dataset.poin);

                    if (poin > userPoin) {
                        alert('Poin tidak cukup untuk menukar ' + poin + ' poin.');
                        return;
                    }

                    // Tandai tombol yang dipilih
                    redeemButtons.forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');

                    // Set value ke input hidden
                    jumlahInput.value = poin;
                });
            });

            form.addEventListener('submit', function(e) {
                if (!jumlahInput.value) {
                    e.preventDefault();
                    alert('Silakan pilih jumlah poin yang ingin ditukar.');
                }
            });
        });
    </script>


    <div class="card card-rounded p-3 shadow mb-4" style="max-width: 500px; margin: 0 auto;">
        <h5 class="fw-bold mb-3 text-center">Status Penukaran</h5>

        {{-- Area scroll khusus daftar --}}
        <div class="redeem-scroll px-1">
            @forelse($redeems as $r)
            <div class="mb-3 p-3 border rounded small-card
        @if($r->status == 'menunggu' || $r->status == 'diproses') bg-warning-subtle text-warning
        @elseif($r->status == 'selesai') bg-success-subtle text-success
        @else bg-danger-subtle text-danger
        @endif">
                <div class="d-flex justify-content-between align-items-start flex-wrap">
                    <div class="flex-grow-1 me-2">
                        <p class="fw-semibold mb-1">Penukaran {{ $r->jumlah_poin }} Poin</p>
                        <p class="small mb-1 text-muted">{{ $r->created_at->format('d M Y') }}</p>
                        <p class="small mb-1">{{ $r->bank }} - {{ $r->no_rekening }}</p>

                        @if($r->bukti_tf)
                        <a href="{{ asset('storage/' . $r->bukti_tf) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                            <i class="bi bi-eye"></i> Lihat Bukti
                        </a>
                        @endif
                    </div>
                    <span class="fw-bold mt-1">{{ ucfirst($r->status) }}</span>
                </div>
            </div>
            @empty
            <p class="text-center text-muted small">Belum ada permintaan penukaran</p>
            @endforelse
        </div>
    </div>

    
    <style>
        /* Scroll area hanya di bagian isi daftar */
        .redeem-scroll {
            max-height: 350px;
            overflow-y: auto;
        }

        /* Agar scroll smooth dan tidak lebar */
        .redeem-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .redeem-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        /* Card lebih kecil di mobile */
        @media (max-width: 576px) {
            .card.card-rounded {
                padding: 1rem !important;
            }

            .small-card {
                font-size: 0.85rem;
                padding: 0.75rem !important;
            }
        }
    </style>



</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection