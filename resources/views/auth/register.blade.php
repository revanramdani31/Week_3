<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Formulir Registrasi Mahasiswa</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label>Nama Lengkap</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" required>
            @error('full_name') <div>{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
            @error('username') <div>{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') <div>{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
         <div>
            <label>Tahun Masuk</label>
            <input type="number" name="entry_year" value="{{ old('entry_year') }}" required>
            @error('entry_year') <div>{{ $message }}</div> @enderror
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>