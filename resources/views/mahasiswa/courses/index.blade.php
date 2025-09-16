<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Sistem Akademik</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a href="{{ route('mahasiswa.dashboard') }}" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('mahasiswa.courses.index') }}" class="nav-link active">Ambil Mata Kuliah</a></li>
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
                <h4 class="mb-0">Daftar Mata Kuliah Tersedia, <strong>{{ Auth::user()->full_name }}</strong>!</h4>
                <p class="mb-0">Pilih mata kuliah yang ingin Anda ambil. <span class="fw-bold">semester ini</span>.</p>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        {{-- Menampilkan pesan notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->credits }}</td>
                                <td class="text-center">
                                    @if(in_array($course->course_id, $enrolledCourses))
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <span class="badge bg-success">Sudah Diambil</span>
                                            <form action="{{ route('mahasiswa.courses.unenroll', $course->course_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin membatalkan mata kuliah ini?')">Batal</button>
                                            </form>
                                        </div>
                                    @else
                                        <form action="{{ route('mahasiswa.courses.enroll', $course->course_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Ambil</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>