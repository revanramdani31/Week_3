<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                Sistem Akademik
            </a>
            <div>
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role === 'Admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-lg px-4">Go to Dashboard</a>
                        @elseif(Auth::user()->role === 'Mahasiswa')
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-success btn-lg px-4">Go to Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex-grow-1 d-flex align-items-center">
        <div class="container text-center">
            <h1 class="fw-bold mb-3">Selamat Datang di <span class="text-warning">Sistem Akademik</span></h1>
            <p class="lead text-muted mb-4">
                Sistem Manajemen Mata Kuliah
            </p>

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-2">Login</a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 text-center mt-auto">
        <small class="text-muted">&copy; {{ date('Y') }} Sistem Akademik</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
