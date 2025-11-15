@extends('layouts.user')
@section('title', 'Profil Saya')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4">Profil Saya</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
    @csrf
    <div class="text-center mb-4">
      @if($user->foto)
        <img src="{{ asset('storage/' . $user->foto) }}" class="rounded-circle mb-2" width="100" height="100">
      @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" class="rounded-circle mb-2" width="100" height="100">
      @endif
      <div>
        <input type="file" name="foto" class="form-control mt-2">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $user->alamat) }}">
    </div>

    <div class="mb-3">
      <label class="form-label">No. HP</label>
      <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}">
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-success">
        <i class="bi bi-save me-1"></i> Simpan Perubahan
      </button>
    </div>
  </form>
</div>
@endsection
