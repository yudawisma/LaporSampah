<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Lapor Sampah')</title>

  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Leaflet CSS --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  {{-- Livewire Styles --}}
  @livewireStyles

  <style>
    #map {
      min-height: 350px !important;
      height: 350px !important;
      width: 100%;
      z-index: 0 !important;
    }
  </style>

</head>

<body class="d-flex flex-column min-vh-100">

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
    <div class="container">
      <div class="d-flex align-items-center gap-2">
        <div class="text-primary-custom">
          <svg width="32" height="32" fill="currentColor" viewBox="0 0 48 48">
            <path d="M24 45.8096C19.6865 45.8096 15.4698 44.5305 11.8832 42.134C8.29667 39.7376 5.50128 36.3314 3.85056 32.3462C2.19985 28.361 1.76794 23.9758 2.60947 19.7452C3.451 15.5145 5.52816 11.6284 8.57829 8.5783C11.6284 5.52817 15.5145 3.45101 19.7452 2.60948C23.9758 1.76795 28.361 2.19986 32.3462 3.85057C36.3314 5.50129 39.7376 8.29668 42.134 11.8833C44.5305 15.4698 45.8096 19.6865 45.8096 24L24 24L24 45.8096Z"></path>
          </svg>
        </div>
        <h2 class="fw-bold mb-0">Lapor Sampah</h2>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('user/laporan*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan Saya</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('user/redeem') ? 'active' : '' }}" href="{{ route('user.redeem') }}">
              <i class="bi bi-coin text-warning me-1"></i>
              <span class="fw-semibold">Poin</span>
            </a>
          </li>
        </ul>

        @php
        $notifCount = \App\Models\Notification::where('user_id', Auth::id())
        ->where('is_read', false)
        ->count();
        @endphp

        <a href="{{ route('user.notifications') }}" class="btn btn-outline-success ms-3 position-relative">
          <i class="bi bi-bell"></i>
          @if($notifCount > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $notifCount }}
            <span class="visually-hidden">unread notifications</span>
          </span>
          @endif
        </a>

        <!-- Avatar user dengan dropdown -->
        <div class="dropdown ms-3">
          <a href="#"
            class="d-flex align-items-center text-decoration-none dropdown-toggle"
            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">

            @if(Auth::user()->foto)
            <img src="{{ asset('storage/' . Auth::user()->foto) }}"
              alt="Foto Profil" class="rounded-circle me-2" width="40" height="40">
            @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
              alt="Avatar" class="rounded-circle me-2" width="40" height="40">
            @endif

            <span class="d-none d-md-inline fw-semibold">{{ Auth::user()->name }}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('user.profile') }}">
                <i class="bi bi-person-circle me-2"></i> Profil Saya
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Keluar
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </nav>

  {{-- Konten Dinamis --}}
  <main class="container py-5 flex-fill">
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="bg-light border-top border-success-subtle py-5 mt-5">
    <div class="container">
      <div class="row gy-4 text-center text-md-start align-items-center">

        <!-- Logo & Deskripsi -->
        <div class="col-md-4">
          <h5 class="fw-bold text-success mb-3">Lapor Sampah</h5>
          <p class="text-muted small mb-3">
            Bersama kita wujudkan Purwokerto yang lebih bersih dan sehat.
            Laporkan sampah di sekitarmu, dapatkan poin, dan jadilah bagian dari perubahan!
          </p>
          <p class="text-muted small mb-0">
            <i class="bi bi-geo-alt-fill text-success me-1"></i> Purwokerto, Jawa Tengah, Indonesia
          </p>
        </div>

        <!-- Navigasi Cepat -->
        <div class="col-md-4">
          <h6 class="fw-semibold mb-3">Navigasi</h6>
          <ul class="list-unstyled small mb-0">
            <li><a href="{{ route('fitur') }}" class="text-muted text-decoration-none d-block mb-1">Fitur</a></li>
            <li><a href="{{ route('pelajari') }}" class="text-muted text-decoration-none d-block mb-1">Pelajari Lebih Lanjut</a></li>
            <li><a href="{{ route('tentang') }}" class="text-muted text-decoration-none d-block mb-1">Tentang Kami</a></li>
            <li><a href="#" class="text-muted text-decoration-none d-block">Kontak</a></li>
          </ul>
        </div>

        <!-- Sosial Media -->
        <div class="col-md-4">
          <h6 class="fw-semibold mb-3">Ikuti Kami</h6>
          <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-5">
            <a href="#" class="text-success"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-success"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-success"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-success"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
      </div>

      <hr class="my-4 border-success-subtle">

      <div class="text-center small text-muted">
        © 2025 <strong>Lapor Sampah</strong>. Semua hak dilindungi.
        | Purwokerto Banyumas Jawa Tengah.
      </div>
    </div>
  </footer>


  {{-- Bootstrap & Leaflet --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  {{-- Livewire Scripts --}}
  @livewireScripts

  {{-- Stack tambahan --}}
  @stack('scripts')
</body>

</html>