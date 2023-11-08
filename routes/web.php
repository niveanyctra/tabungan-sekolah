<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/register');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', function () {
        return view('backend.superadmin.dashboard');
    })->name('superadmin-dashboard');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('backend.admin.dashboard');
    })->name('admin-dashboard');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        return view('backend.teacher.dashboard');
    })->name('teacher-dashboard');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:student'])->group(function () {
    Route::get('/tabungan-sekolah', function () {
        return view('backend.student.dashboard');
    })->name('tabungan-sekolah');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as'=> 'student.'], function () {
        Route::resource('lessons', LessonController::class);
    });
    Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as'=> 'teacher.'], function () {
        Route::resource('courses', CourseController::class);
    });
    Route::group(['middleware' => 'role:admin||superadmin', 'prefix' => 'admin', 'as'=> 'admin.'], function () {
        Route::resource('users', UserController::class);
    });
});
