<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Memproses registrasi
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'entry_year' => 'required|digits:4|integer|min:2000',
        ]);

        // 2. Menggunakan DB Transaction
        DB::transaction(function () use ($request) {
            // Buat user baru
            $user = User::create([
                'full_name' => $request->full_name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'Mahasiswa', // Role default saat registrasi
            ]);

            // Buat student baru yang terhubung dengan user
            $user->student()->create([
                'student_id' => $user->id,
                'entry_year' => $request->entry_year,
            ]);

            // 3. Login user secara otomatis
            Auth::login($user);
        });

        // 4. Redirect ke dashboard
        return redirect()->route('dashboard');
    }
}
