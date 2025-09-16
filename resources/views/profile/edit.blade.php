<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Sistem Akademik</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    @if(Auth::user()->role == 'Admin')
                        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('admin.students.index') }}" class="nav-link">Students</a></li>
                        <li class="nav-item"><a href="{{ route('admin.courses.index') }}" class="nav-link">Courses</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('mahasiswa.dashboard') }}" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('mahasiswa.courses.index') }}" class="nav-link">Ambil Mata Kuliah</a></li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->full_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item active" href="{{ route('profile.edit') }}">Profil Saya</a></li>
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
                <h4 class="mb-0">Pengaturan Profil, <strong>{{ Auth::user()->full_name }}</strong>!</h4>
                <p class="mb-0">Kelola informasi akun dan . <span class="fw-bold">keamanan Anda</span>.</p>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Informasi Profil</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Nama Lengkap</label>
                                <input type="text" id="full_name" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profil</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Ubah Password</h5>
                    </div>
                    <div class="card-body">
                        @if(session('password_success'))
                            <div class="alert alert-success">{{ session('password_success') }}</div>
                        @endif
                        @if(session('password_error'))
                            <div class="alert alert-danger">{{ session('password_error') }}</div>
                        @endif
                        <form method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Lama</label>
                                <input type="password" id="current_password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>