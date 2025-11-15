@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <h1 class="fw-bold h3 mb-1">Dashboard Admin</h1>
  <p class="text-muted mb-4">Ringkasan data pengguna, laporan, dan penukaran poin.</p>

  {{-- Statistik Utama --}}
  <div class="row g-3 mb-4">
    @php
      $stats = [
        ['icon' => 'people', 'label' => 'Total Pengguna', 'value' => $totalUsers],
        ['icon' => 'journal-check', 'label' => 'Total Laporan', 'value' => $totalReports],
        ['icon' => 'gift', 'label' => 'Total Penukaran', 'value' => $totalRedeems],
        ['icon' => 'coin', 'label' => 'Total Poin Ditukar', 'value' => $totalPoinDitukar],
      ];
    @endphp

    @foreach ($stats as $item)
      <div class="col-6 col-md-3">
        <div class="card text-center border-0 shadow-sm">
          <div class="card-body">
            <i class="bi bi-{{ $item['icon'] }} fs-3 text-success mb-2"></i>
            <p class="text-muted small mb-1">{{ $item['label'] }}</p>
            <h4 class="fw-bold mb-0">{{ number_format($item['value']) }}</h4>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Grafik dan Ringkasan --}}
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white fw-semibold">
          Grafik Aktivitas Bulanan
        </div>
        <div class="card-body">
          <canvas id="activityChart" height="150"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white fw-semibold">
          Distribusi Penukaran
        </div>
        <div class="card-body">
          <canvas id="exchangeChart" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  {{-- Aktivitas Terbaru --}}
  <div class="row g-4 mt-3">
    {{-- Pengguna Terbaru --}}
    <div class="col-lg-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header bg-success text-white fw-semibold">Pengguna Terbaru</div>
        <div class="card-body">
          @foreach ($latestUsers as $user)
          <div class="d-flex justify-content-between mb-2">
            <div>
              <div class="fw-semibold">{{ $user->name }}</div>
              <small class="text-muted">{{ $user->email }}</small>
            </div>
            <span class="badge bg-light text-dark">{{ ucfirst($user->role) }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Laporan Terbaru --}}
    <div class="col-lg-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header bg-success text-white fw-semibold">Laporan Terbaru</div>
        <div class="card-body">
          @foreach ($latestReports as $report)
          <div class="mb-3">
            <div class="fw-semibold">{{ Str::limit($report->deskripsi, 40) }}</div>
            <small class="text-muted">{{ $report->user->name ?? 'Tidak diketahui' }}</small>
            <div><span class="badge bg-{{ $report->status === 'selesai' ? 'success' : ($report->status === 'diproses' ? 'info text-dark' : 'warning text-dark') }}">{{ ucfirst($report->status) }}</span></div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Penukaran Terbaru --}}
    <div class="col-lg-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header bg-success text-white fw-semibold">Penukaran Terbaru</div>
        <div class="card-body">
          @foreach ($latestRedeems as $redeem)
          <div class="d-flex justify-content-between mb-2">
            <div>
              <div class="fw-semibold">{{ $redeem->user->name ?? 'Tidak diketahui' }}</div>
              <small class="text-muted">{{ $redeem->jumlah_poin }} poin</small>
            </div>
            <span class="badge bg-light text-dark">{{ ucfirst($redeem->status) }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const reportData = @json($monthlyReports);
  const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  const activityChart = new Chart(document.getElementById('activityChart'), {
    type: 'line',
    data: {
      labels: months,
      datasets: [{
        label: 'Laporan Masuk',
        data: months.map((_, i) => reportData[i+1] || 0),
        borderColor: '#16a34a',
        backgroundColor: 'rgba(22,163,74,0.2)',
        fill: true,
        tension: 0.4
      }]
    },
    options: { plugins: { legend: { display: false } } }
  });
</script>
@endsection
