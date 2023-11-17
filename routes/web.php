<?php

use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\VocationalController;

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

Route::get('get-classroom-by-vocational/{vocational_id}', [UserController::class, 'getKelasByJurusan']);
Route::get('/get-vocationals', [UserController::class, 'getVocationals']);
Route::get('/get-classrooms/{vocationalId}', [UserController::class, 'getClassrooms']);
Route::get('/get-vocational-and-classrooms/{role}', [UserController::class, 'getVocationalAndClassrooms']);

Route::middleware(['auth:sanctum', 'verified', 'status:true'])->get('/waiting', function () {
    return view('waiting');
})->name('waiting');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:superadmin'])->group(function () {
    Route::group(['prefix' => 'superadmin', 'as'=> 'superadmin.'], function () {
        Route::get('/dashboard', function () {
            return view('backend.superadmin.dashboard');
        })->name('dashboard');
    });
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin||superadmin'])->group(function () {
    Route::group(['prefix' => 'admin', 'as'=> 'admin.'], function () {
        Route::get('/dashboard', function () {
            return view('backend.admin.dashboard');
        })->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('status', StatusController::class);
        Route::get('konfirmasi-siswa/{id}', [StatusController::class, 'konfirmasiSiswa'])->name('konfirmasi.siswa');
        Route::get('konfirmasi-transaksi/{id}', [TransaksiController::class, 'konfirmasiTransaksi'])->name('konfirmasi.transaksi');
        Route::resource('vocationals', VocationalController::class);
        Route::resource('classrooms', ClassroomController::class);
        Route::resource('students', StudentController::class);
        Route::get('/students/setor/{id}', [TransaksiController::class,'adminSetor'])->name('students.setor');
        Route::post('/students/store/{id}', [TransaksiController::class,'adminStore'])->name('students.store');
        Route::get('/students/tarik/{id}', [TransaksiController::class,'adminTarik'])->name('students.tarik');
        Route::post('/students/withdraw/{id}', [TransaksiController::class,'adminWithdraw'])->name('students.withdraw');
        Route::get('/transaksi', [TransaksiController::class,'adminConfirmation'])->name('adminTransaksiIndex');
    });
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:ht'])->group(function () {
    Route::group(['prefix' => 'homeroom-teacher', 'as'=> 'ht.'], function () {
        Route::get('/homeroom-teacher/dashboard', function () {
            return view('backend.homeroom-teacher.dashboard');
        })->name('dashboard');
        Route::get('/homeroom-teacher/transaksi/index',[TransaksiController::class,'teacherIndex'])->name('htIndex');
        Route::get('/homeroom-teacher/transaksi/setor/{name}',[TransaksiController::class,'setor'])->name('transaksiSetor');
        Route::get('/homeroom-teacher/transaksi/tarik/{name}',[TransaksiController::class,'tarik'])->name('transaksiTarik');
        Route::post('/homeroom-teacher/transaksi/withdraw',[TransaksiController::class,'withdraw'])->name('transaksiWithdraw');
        Route::post('/homeroom-teacher/transaksi/store',[TransaksiController::class,'store'])->name('transaksiStore');

    });
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:student', 'status:false'])->group(function () {
    Route::get('/tabungan-sekolah', function () {
        return view('backend.student.dashboard');
    })->name('tabungan-sekolah');
    Route::get('/transaksi/bukti/{no_transaksi}',[TransaksiController::class,'bukti'])->name('transaksiBukti');
    Route::get('/transaksi/riwayat/{id}',[TransaksiController::class,'riwayat'])->name('transaksiRiwayat');
    Route::resource('transaksi', TransaksiController::class);
});

// Route::group(['middleware' => 'auth'], function () {
//     Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as'=> 'student.'], function () {
//         Route::resource('lessons', LessonController::class);
//     });
//     Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as'=> 'teacher.'], function () {
//         Route::resource('courses', CourseController::class);
//     });
//     Route::group(['middleware' => 'role:admin||superadmin', 'prefix' => 'admin', 'as'=> 'admin.'], function () {
//         Route::resource('users', UserController::class);
//     });
// });
