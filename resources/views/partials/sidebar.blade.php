<aside class="admin-sidebar" id="sidebar">
  <div class="brand d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linejoin="round" stroke-linecap="round" style="color:var(--primary)">
        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
        <path d="M2 17l10 5 10-5"></path>
        <path d="M2 12l10 5 10-5"></path>
      </svg>
      <h1 class="fs-6 fw-bold mb-0">Admin Panel</h1>
    </div>
    <button class="btn btn-sm btn-light border d-lg-none" id="toggleSidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <nav class="d-flex flex-column gap-2 mt-3">
    <a class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active-link' : '' }}"
      href="{{ route('admin.dashboard') }}">Dasbor</a>
    <a class="nav-link-custom {{ request()->routeIs('admin.penguna') ? 'active-link' : '' }}"
      href="{{ route('admin.pengguna') }}">Pengguna</a>
    <a class="nav-link-custom {{ request()->routeIs('admin.laporan') ? 'active-link' : '' }}"
      href="{{ route('admin.laporan') }}">Laporan</a>
    <a class="nav-link-custom {{ request()->routeIs('admin.point') ? 'active-link' : '' }}"
      href="{{ route('admin.point') }}">Poin</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>

    <a href="#"
      class="nav-link-custom text-danger mt-auto"
      onclick="event.preventDefault(); confirmLogout();">
      Keluar
    </a>

    <script>
      function confirmLogout() {
        if (confirm('Apakah Anda yakin ingin logout?')) {
          document.getElementById('logout-form').submit();
        }
      }
    </script>

  </nav>
</aside>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');

    toggle?.addEventListener('click', () => {
      sidebar.classList.toggle('show');
    });
  });
</script>

<style>
  .admin-sidebar {
    width: 16rem;
    min-width: 16rem;
    background-color: var(--background-light);
    padding: 1rem;
    box-shadow: 0 .25rem 1rem rgba(0, 0, 0, .08);
    transition: transform .3s ease;
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