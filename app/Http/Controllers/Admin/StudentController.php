<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Menampilkan daftar semua mahasiswa.
     */
    public function index()
    {
        $students = User::where('role', 'Mahasiswa')->get();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Menampilkan form untuk membuat mahasiswa baru.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Menyimpan mahasiswa baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'entry_year' => 'required|digits:4|integer|min:2000',
            'nim' => 'required|string|max:20|unique:students,nim',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'full_name' => $request->full_name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'Mahasiswa',
            ]);

            $user->student()->create([
                'student_id' => $user->id,
                'entry_year' => $request->entry_year,
                'nim' => $request->nim,
            ]);
        });

        return redirect()->route('admin.students.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman detail untuk mahasiswa tertentu.
     */
    public function show(User $student)
    {
        $student->load('student.courses');
        return view('admin.students.show', compact('student'));
    }

    /**
     * Menampilkan form untuk mengedit mahasiswa.
     */
    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Memperbarui data mahasiswa di database.
     */
    public function update(Request $request, User $student)
    {
        $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($student->id)],
            'nim' => ['required', 'string', 'max:20', Rule::unique('students')->ignore($student->student->student_id, 'student_id')],
            'password' => 'required|string|min:8|confirmed',
            'entry_year' => 'required|digits:4|integer|min:2000',
        ]);

        $student->update($request->only('full_name', 'username'));

        if ($student->student) {
            $student->student->update([
                'entry_year' => $request->entry_year,
                'nim' => $request->nim,
            ]);
        }

        return redirect()->route('admin.students.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    /**
     * Menghapus mahasiswa dari database.
     */
    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}