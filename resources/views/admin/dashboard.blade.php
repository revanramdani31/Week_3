<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard Admin</a>

            <ul class="navbar-nav me-auto"> @auth @if(Auth::user()->role == 'Admin')
                 <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('admin.students.index') }}">Students</a> 
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.courses.index') }}">Courses</a>
                </li> @else <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a> 
                </li> 
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('mahasiswa.courses.index') }}">Ambil Mata Kuliah</a> 
                </li> @endif @endauth 
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->full_name }} (Administrator)
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profil</a>
                        </li>
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
    </nav>
    

    <main class="py-4">
            <div class="container">
        {{-- Menampilkan pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        {{-- Menampilkan pesan error --}}
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @yield('content')
    </div>
        <div class="container">
            <div class="alert alert-primary">
                <h4 class="mb-0">Selamat Datang, <strong>{{ Auth::user()->full_name }}</strong>!</h4>
                <p class="mb-0">Anda login sebagai <span class="fw-bold">Administrator</span>.</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-3 border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Mahasiswa</h5>
                            <p class="display-4 fw-bold text-primary">{{ $totalStudents }}</p>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-primary">Kelola Mahasiswa</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow mb-3 border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Course</h5>
                            <p class="display-4 fw-bold text-success">{{ $totalCourses }}</p>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-success">Kelola Course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
