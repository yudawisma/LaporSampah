@extends('layouts.user')

@section('title', 'Notifikasi Saya')

@section('content')
<div class="container py-4">
  <h3 class="mb-3">Notifikasi Saya</h3>

  @foreach($notifications as $notif)
  <div class="card mb-2 {{ $notif->is_read ? '' : 'border-warning' }}">
    <div class="card-body">
      <h5 class="card-title">{{ $notif->title }}</h5>
      <p class="card-text">{{ $notif->message }}</p>
      @if(!$notif->is_read)
      <form action="{{ route('user.notifications.read', $notif->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-primary">Tandai sudah dibaca</button>
      </form>
      @endif
    </div>
  </div>
  @endforeach
</div>
@endsection
