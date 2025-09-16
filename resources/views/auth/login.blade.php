<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- HEADER / NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">Sistem Akademik</a>
            <div>
                <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" 
                           name="username" 
                           value="{{ old('username') }}" 
                           required 
                           class="form-control @error('username') is-invalid @enderror"
                           placeholder="Masukkan username">
                    @error('username') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" 
                           name="password" 
                           required 
                           class="form-control" 
                           placeholder="Masukkan password">
                </div>

                <!-- Tombol -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
                    @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-top py-3 text-center mt-auto">
        <small class="text-muted">&copy; {{ date('Y') }} Sistem Akademik</small>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
