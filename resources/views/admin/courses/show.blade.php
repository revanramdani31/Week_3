<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Sistem Akademik</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('admin.students.index') }}" class="nav-link">Students</a></li>
                    <li class="nav-item"><a href="{{ route('admin.courses.index') }}" class="nav-link active">Courses</a></li>
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

    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Mata Kuliah</h4>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-sm">
                    &larr; Kembali ke Daftar
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Informasi Mata Kuliah</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>ID:</strong> {{ $course->course_id }}</li>
                            <li class="list-group-item"><strong>Kode Mata Kuliah:</strong> {{ $course->course_code }}</li>
                            <li class="list-group-item"><strong>Nama Mata Kuliah:</strong> {{ $course->course_name }}</li>
                            <li class="list-group-item"><strong>Jumlah SKS:</strong> {{ $course->credits }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Mahasiswa yang Terdaftar ({{ $course->students->count() }})</h5>
                        @if($course->students->isNotEmpty())
                            <ul class="list-group">
                                @foreach($course->students as $student)
                                    <li class="list-group-item">{{ $student->user->full_name }} (Tahun Masuk: {{ $student->entry_year }})</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Belum ada mahasiswa yang mengambil mata kuliah ini.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>