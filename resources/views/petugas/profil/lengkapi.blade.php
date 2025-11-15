@extends('layouts.app')

@section('title', 'Lengkapi Profil Petugas')

@section('content')
<div class="container mt-4">
  <h3 class="mb-3">Lengkapi Profil Petugas</h3>
  <form action="{{ route('petugas.profil.simpan') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label>Alamat</label>
      <input type="text" name="alamat" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>No. HP</label>
      <input type="text" name="no_hp" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Foto Profil (opsional)</label>
      <input type="file" name="foto" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Kirim</button>
  </form>
</div>
@endsection
