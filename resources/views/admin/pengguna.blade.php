@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 fw-bold mb-1">Manajemen Pengguna</h1>
      <p class="mb-0 text-muted">Kelola pengguna, petugas, dan admin sistem.</p>
    </div>
    <button class="btn btn-success">Tambah Pengguna</button>
  </div>

  {{-- Statistik --}}
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <p class="mb-1">Total Pengguna</p>
          <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <p class="mb-1">Total Petugas</p>
          <h2 class="fw-bold mb-0">{{ $totalPetugas }}</h2>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <p class="mb-1">Total Admin</p>
          <h2 class="fw-bold mb-0">{{ $totalAdmin }}</h2>
        </div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <p class="mb-1">Total Laporan</p>
          <h2 class="fw-bold mb-0">{{ $totalReports }}</h2>
        </div>
      </div>
    </div>
  </div>

  {{-- Tabs Role --}}
  <ul class="nav nav-tabs mb-4">
    <li class="nav-item">
      <a class="nav-link {{ request('tab') == 'pengguna' || request('tab') == null ? 'active text-success fw-semibold' : '' }}"
        href="{{ route('admin.pengguna', ['tab' => 'pengguna']) }}">Pengguna</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request('tab') == 'petugas' ? 'active text-success fw-semibold' : '' }}"
        href="{{ route('admin.pengguna', ['tab' => 'petugas']) }}">Petugas</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request('tab') == 'admin' ? 'active text-success fw-semibold' : '' }}"
        href="{{ route('admin.pengguna', ['tab' => 'admin']) }}">Admin</a>
    </li>
  </ul>






  {{-- Pendaftar Petugas Baru --}}
  <div class="alert alert-warning mb-4">
    <h5 class="mb-2 fw-semibold">Pendaftar Petugas Baru</h5>
    @forelse($pendaftarPetugas as $p)
    <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2 bg-white">
      <div>
        <div class="fw-semibold">{{ $p->name }}</div>
        <small class="text-muted">{{ $p->email }}</small>
      </div>
      <div>
        <a href="{{ route('admin.pengguna.show', $p->id) }}" class="btn btn-sm btn-info">Lihat Profil</a>

        <form action="{{ route('admin.user.approve', $p->id) }}" method="POST" class="d-inline ms-1">
          @csrf
          <button type="submit" class="btn btn-sm btn-success">Setujui</button>
        </form>

        <form action="{{ route('admin.user.reject', $p->id) }}" method="POST" class="d-inline ms-1">
          @csrf
          <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
        </form>
      </div>
    </div>
    @empty
    <p class="text-muted">Belum ada pendaftar baru.</p>
    @endforelse
  </div>

  {{-- Daftar Pengguna / Petugas / Admin --}}
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h5 mb-0">Daftar {{ ucfirst(request('tab') ?? 'pengguna') }}</h2>
    <div class="input-group" style="max-width: 300px;">
      <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
      <input type="text" class="form-control" placeholder="Cari {{ request('tab') ?? 'pengguna' }}...">
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-striped mb-0 align-middle">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td class="text-center">

              {{-- Tombol Edit --}}
              <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                class="btn btn-sm btn-outline-success me-1"
                title="Edit">
                <i class="bi bi-pencil-square"></i>
              </a>

              {{-- Tombol Hapus --}}
              <form action="{{ route('admin.user.delete', $user->id) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="btn btn-sm btn-outline-danger"
                  title="Hapus">
                  <i class="bi bi-trash"></i>
                </button>
              </form>

            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center text-muted py-3">
              Tidak ada data {{ request('tab') ?? 'pengguna' }}.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection