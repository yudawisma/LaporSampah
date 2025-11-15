@extends('layouts.admin')

@section('title', 'Detail Profil Petugas')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Detail Profil Petugas</h4>
    </div>
    <div class="card-body">
      <div class="row">
        {{-- Foto Profil --}}
        <div class="col-md-3 text-center">
          @if($user->foto)
            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="img-fluid rounded mb-3">
          @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profil" class="img-fluid rounded mb-3">
          @endif
        </div>

        {{-- Detail Info --}}
        <div class="col-md-9">
          <table class="table table-borderless">
            <tr>
              <th>Nama</th>
              <td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>{{ $user->alamat ?? '-' }}</td>
            </tr>
            <tr>
              <th>No. HP</th>
              <td>{{ $user->no_hp ?? '-' }}</td>
            </tr>
            <tr>
              <th>Status Pendaftaran</th>
              <td>
                @if($user->status_request === 'pending')
                  <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                @elseif($user->status_request === 'approved')
                  <span class="badge bg-success">Disetujui</span>
                @elseif($user->status_request === 'rejected')
                  <span class="badge bg-danger">Ditolak</span>
                @else
                  <span class="badge bg-secondary">Tidak Diketahui</span>
                @endif
              </td>
            </tr>
          </table>

          {{-- Tombol aksi admin --}}
          @if($user->status_request === 'pending')
            <div class="mt-3">
              <form action="{{ route('admin.user.approve', $user->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Setujui</button>
              </form>
              <form action="{{ route('admin.user.reject', $user->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Tolak</button>
              </form>
            </div>
          @endif
        </div>
      </div>
    </div>

    <div class="card-footer text-end">
      <a href="{{ route('admin.pengguna') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
