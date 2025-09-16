<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalCourses  = Course::count();

        return view('admin.dashboard', compact('totalStudents', 'totalCourses'));
    }
}
