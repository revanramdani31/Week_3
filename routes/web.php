<?php   

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        if (Auth::user()->role == 'Admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role == 'Mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // routes/web.php
    Route::put('/profile/password', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');

    Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);
        Route::resource('students', \App\Http\Controllers\Admin\StudentController::class);
    });


    Route::middleware('role:Mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/courses', [\App\Http\Controllers\Mahasiswa\CourseController::class, 'index'])->name('courses.index');
        Route::post('/courses/{courseId}/enroll', [\App\Http\Controllers\Mahasiswa\CourseController::class, 'enroll'])->name('courses.enroll');
        Route::delete('/courses/{courseId}/unenroll', [\App\Http\Controllers\Mahasiswa\CourseController::class, 'unenroll'])->name('courses.unenroll');
    });
});