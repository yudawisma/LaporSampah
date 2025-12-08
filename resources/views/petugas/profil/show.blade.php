@extends('layouts.petugas')
@section('title', 'Profil Petugas')

@section('content')

<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Profil Petugas</h5>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="text-center mb-4">
                        <img src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://ui-avatars.com/api/?name='.$user->name }}"
                            class="rounded-circle"
                            width="120" height="120">
                    </div>

                    <form action="{{ route('petugas.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <button class="btn btn-success w-100">
                            Simpan Perubahan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
