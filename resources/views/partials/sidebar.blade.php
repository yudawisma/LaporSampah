<aside class="admin-sidebar" id="sidebar">
  {{-- Brand --}}
  <div class="brand d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
      <img
        src="{{ asset('images/logo.png') }}"
        alt="LaporSampah"
        class="admin-logo"
      >
      <h1 class="fs-6 fw-bold mb-0">Lapor Sampah</h1>
    </div>

    <button class="btn btn-sm btn-light border d-lg-none" id="toggleSidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  {{-- Navigation --}}
  <nav class="d-flex flex-column gap-2 mt-3">
    <a class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active-link' : '' }}"
       href="{{ route('admin.dashboard') }}">
      Dasbor
    </a>

    <a class="nav-link-custom {{ request()->routeIs('admin.pengguna') ? 'active-link' : '' }}"
       href="{{ route('admin.pengguna') }}">
      Pengguna
    </a>

    <a class="nav-link-custom {{ request()->routeIs('admin.laporan') ? 'active-link' : '' }}"
       href="{{ route('admin.laporan') }}">
      Laporan
    </a>

    <a class="nav-link-custom {{ request()->routeIs('admin.point') ? 'active-link' : '' }}"
       href="{{ route('admin.point') }}">
      Poin
    </a>

    {{-- Logout --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>

    <a href="#"
       class="nav-link-custom text-danger mt-auto"
       onclick="event.preventDefault(); confirmLogout();">
      Keluar
    </a>
  </nav>
</aside>

{{-- JS --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');

    toggle?.addEventListener('click', () => {
      sidebar.classList.toggle('show');
    });
  });

  function confirmLogout() {
    if (confirm('Apakah Anda yakin ingin logout?')) {
      document.getElementById('logout-form').submit();
    }
  }
</script>

{{-- CSS --}}
<style>
  .admin-sidebar {
    width: 16rem;
    min-width: 16rem;
    background-color: var(--background-light);
    padding: 1rem;
    box-shadow: 0 .25rem 1rem rgba(0, 0, 0, .08);
    transition: transform .3s ease;
  }

  .brand {
    padding-bottom: .75rem;
    border-bottom: 1px solid rgba(0, 0, 0, .05);
  }

  .admin-logo {
    height: 28px;
    width: auto;
  }

  @media (max-width: 992px) {
    .admin-sidebar {
      position: fixed;
      height: 100vh;
      top: 0;
      left: 0;
      transform: translateX(-100%);
      z-index: 1045;
    }

    .admin-sidebar.show {
      transform: translateX(0);
    }
  }

  .nav-link-custom {
    display: block;
    padding: .5rem .75rem;
    border-radius: .5rem;
    color: rgba(0, 0, 0, .75);
    text-decoration: none;
    transition: all .2s ease;
  }

  .nav-link-custom:hover {
    background: rgba(23, 207, 23, .06);
    color: var(--primary);
  }

  .active-link {
    background: rgba(23, 207, 23, .12);
    color: var(--primary);
    font-weight: 600;
  }
</style>
