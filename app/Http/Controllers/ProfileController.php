<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Memperbarui informasi profil (nama, username).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'full_name' => 'required|string|max:100',
            // Pastikan username unik, kecuali untuk user saat ini
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'full_name' => $request->full_name,
            'username' => $request->username,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('password_error', 'Password lama tidak sesuai.');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        
        return back()->with('password_success', 'Password berhasil diubah!');
    }
}