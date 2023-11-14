<?php

use App\Http\Controllers\Admin\ClassroomController;
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
        Route::resource('vocationals', VocationalController::class);
        Route::resource('classrooms', ClassroomController::class);
    });
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:teacher'])->group(function () {
    Route::group(['prefix' => 'teacher', 'as'=> 'teacher.'], function () {
        Route::get('/dashboard', function () {
            return view('backend.teacher.dashboard');
        })->name('dashboard');
    });
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:student', 'status:false'])->group(function () {
    Route::get('/tabungan-sekolah', function () {
        return view('backend.student.dashboard');
    })->name('tabungan-sekolah');
    Route::get('/transaksi/setor',[TransaksiController::class,'setor'])->name('transaksiSetor');
    Route::get('/transaksi/tarik',[TransaksiController::class,'tarik'])->name('transaksiTarik');
    Route::get('/transaksi/transfer',[TransaksiController::class,'transfer'])->name('transaksiTransfer');
    Route::get('/transaksi/bukti',[TransaksiController::class,'bukti'])->name('transaksiBukti');
    Route::get('/transaksi/riwayat/{id}',[TransaksiController::class,'riwayat'])->name('transaksiRiwayat');
    Route::post('/transaksi/withdraw',[TransaksiController::class,'withdraw'])->name('transaksiWithdraw');
    Route::post('/transaksi/kirim',[TransaksiController::class,'storeTransfer'])->name('transaksiKirim');
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
