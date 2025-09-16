<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:100',
            'credits' => 'required|integer',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }
    public function show(Course $course)
    {
        // UBAH BARIS INI
        // $course->load('students');
        
        // DENGAN BARIS DI BAWAH INI
        // Ini akan memberitahu Laravel untuk memuat 'students' DAN 'user' yang ada di dalamnya
        $course->load('students.user');

        return view('admin.courses.show', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'course_name' => 'required|string|max:100',
            'credits' => 'required|integer',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}