<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-custom {
            transition: transform 0.2s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                Sistem Akademik
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a href="{{ route('mahasiswa.dashboard') }}" class="nav-link active">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('mahasiswa.courses.index') }}" class="nav-link">Ambil Mata Kuliah</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->full_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="py-4">
        <div class="container">
            <div class="alert alert-primary">
                <h4 class="mb-0">Selamat Datang, <strong>{{ Auth::user()->full_name }}</strong>!</h4>
                <p class="mb-0">Semoga harimu <span class="fw-bold">Menyenangkan</span>.</p>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card card-custom shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-semibold">Mata Kuliah Diambil</h5>
                        <p class="display-5 fw-bold text-primary">{{ $enrolledCount }}</p>
                        <a href="{{ route('mahasiswa.courses.index') }}" class="btn btn-outline-primary mt-2">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card card-custom shadow-sm border-0 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="fw-semibold">Total SKS</h5>
                        <p class="display-5 fw-bold text-success">{{ $totalCredits }}</p>
                         <a href="{{ route('mahasiswa.courses.index') }}" class="btn btn-outline-success mt-2">Tambah Mata Kuliah</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
             <div class="card-header bg-white">
                <h4 class="fw-semibold mb-0">5 Mata Kuliah Terbaru</h4>
             </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentCourses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->credits }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">
                                    Anda belum mengambil mata kuliah apapun.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>