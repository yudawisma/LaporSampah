<style>
  .bg-primary-custom {
    background-color: #17cf17 !important;
  }
  .text-primary-custom {
    color: #17cf17 !important;
  }
  .btn-outline-primary-custom {
    color: #17cf17 !important;
    border-color: #17cf17 !important;
  }
  .btn-outline-primary-custom:hover {
    background-color: #17cf17 !important;
    color: #fff !important;
  }
</style>

<header class="border-bottom border-success-subtle py-3 px-4">
  <div class="container d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <div class="text-primary-custom">
        <svg width="32" height="32" fill="currentColor" viewBox="0 0 48 48">
          <path d="M24 45.8096C19.6865 45.8096 15.4698 44.5305 11.8832 42.134C8.29667 39.7376 5.50128 36.3314 3.85056 32.3462C2.19985 28.361 1.76794 23.9758 2.60947 19.7452C3.451 15.5145 5.52816 11.6284 8.57829 8.5783C11.6284 5.52817 15.5145 3.45101 19.7452 2.60948C23.9758 1.76795 28.361 2.19986 32.3462 3.85057C36.3314 5.50129 39.7376 8.29668 42.134 11.8833C44.5305 15.4698 45.8096 19.6865 45.8096 24L24 24L24 45.8096Z"></path>
        </svg>
      </div>
      <h2 class="fw-bold mb-0">Lapor Sampah</h2>
    </div>

    <!-- Tombol hamburger (mobile) -->
    <button class="btn d-md-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 010-1h11a.5.5 0 010 1h-11zm0-4a.5.5 0 010-1h11a.5.5 0 010 1h-11zm0-4a.5.5 0 010-1h11a.5.5 0 010 1h-11z"/>
      </svg>
    </button>

    <!-- Navbar versi desktop -->
    <div class="d-none d-md-flex align-items-center gap-4">
      <nav class="d-flex gap-3">
        <a href="/" class="text-decoration-none text-dark fw-medium">Beranda</a>
        <a href="{{ route('fitur') }}" class="text-decoration-none text-dark fw-medium">Fitur</a>
        <a href="{{ route('tentang') }}" class="text-decoration-none text-dark fw-medium">Tentang Kami</a>
      </nav>
      <div class="d-flex gap-2">
        <a href="{{ route('login') }}" class="btn btn-outline-primary-custom fw-semibold">Masuk</a>
        <a href="{{ route('register') }}" class="btn bg-primary-custom text-white fw-semibold">Daftar</a>
      </div>
    </div>

    <!-- Navbar versi mobile -->
    <div class="collapse d-md-none" id="mobileNav">
      <nav class="d-flex flex-column gap-3 mt-3">
        <a href="/" class="text-decoration-none text-dark fw-medium">Beranda</a>
        <a href="{{ route('fitur') }}" class="text-decoration-none text-dark fw-medium">Fitur</a>
        <a href="{{ route('tentang') }}" class="text-decoration-none text-dark fw-medium">Tentang Kami</a>
      </nav>
      <div class="d-flex flex-column gap-2 mt-3">
        <a href="{{ route('login') }}" class="btn btn-outline-primary-custom fw-semibold">Masuk</a>
        <a href="{{ route('register') }}" class="btn bg-primary-custom text-white fw-semibold">Daftar</a>
      </div>
    </div>
  </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

