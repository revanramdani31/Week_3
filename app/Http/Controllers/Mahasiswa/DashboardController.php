<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Take;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $studentId = Auth::user()->id;

        // Hitung jumlah mata kuliah yang diambil
        $enrolledCount = Take::where('student_id', $studentId)->count();

        // Ambil ID mata kuliah yang diambil
        $enrolledCourseIds = Take::where('student_id', $studentId)->pluck('course_id');

        // Hitung total SKS dari mata kuliah tersebut
        $totalCredits = Course::whereIn('course_id', $enrolledCourseIds)->sum('credits');

        // Ambil 5 mata kuliah terbaru
        $recentCourses = Course::whereIn('course_id', $enrolledCourseIds)
            ->orderByDesc(
                Take::select('created_at')
                    ->whereColumn('courses.course_id', 'takes.course_id')
                    ->where('student_id', $studentId)
                    ->latest()
            )
            ->limit(5)
            ->get();

        // Kirim semua data ke view
        return view('mahasiswa.dashboard', [
            'enrolledCount' => $enrolledCount,
            'totalCredits' => $totalCredits,
            'recentCourses' => $recentCourses
        ]);
    }
}