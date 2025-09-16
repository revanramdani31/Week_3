<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Take;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $studentId = Auth::user()->id;
        
        // Pastikan baris ini menggunakan ->pluck('course_id')->toArray()
        $enrolledCourses = Take::where('student_id', $studentId)->pluck('course_id')->toArray();
        
        return view('mahasiswa.courses.index', compact('courses', 'enrolledCourses'));
    }

    public function enroll(Request $request, string $courseId)
    {
        $studentId = Auth::user()->id;
        
        // Cek apakah mahasiswa sudah mengambil mata kuliah ini
        $isEnrolled = Take::where('student_id', $studentId)->where('course_id', $courseId)->exists();
        
        if ($isEnrolled) {
            return back()->with('error', 'Anda sudah mengambil mata kuliah ini.');
        }

        Take::create([
            'student_id' => $studentId,
            'course_id' => $courseId,
            'enroll_date' => now(),
        ]);

        return back()->with('success', 'Mata kuliah berhasil diambil!');
    }
    public function unenroll(Request $request, string $courseId)
    {
        $studentId = Auth::user()->id;

        // Cari data pendaftaran berdasarkan student_id dan course_id
        $enrollment = Take::where('student_id', $studentId)
                          ->where('course_id', $courseId)
                          ->first();

        // Jika data ditemukan, hapus
        if ($enrollment) {
            $enrollment->delete();
            return back()->with('success', 'Berhasil membatalkan mata kuliah!');
        }

        // Jika data tidak ditemukan, kembali dengan pesan error
        return back()->with('error', 'Gagal membatalkan mata kuliah atau Anda belum terdaftar.');
    }
}