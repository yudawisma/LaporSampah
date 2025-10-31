<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lapor Sampah')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #f6f8f6;
            color: #333;
        }

        .bg-primary-custom {
            background-color: #17cf17 !important;
        }

        .text-primary-custom {
            color: #17cf17 !important;
        }

        .btn-primary-custom {
            background-color: #17cf17 !important;
            border-color: #17cf17 !important;
            color: #fff !important;
        }

        .btn-primary-custom:hover {
            background-color: #13b813 !important;
            border-color: #13b813 !important;
            color: #fff !important;
        }

        .btn-outline-primary-custom {
            border-color: #17cf17 !important;
            color: #17cf17 !important;
        }

        .btn-outline-primary-custom:hover {
            background-color: #17cf17 !important;
            color: #fff !important;
        }

        .bg-dark-overlay {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif


    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Konten Halaman -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>