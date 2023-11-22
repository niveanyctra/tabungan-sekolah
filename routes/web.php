<?php

use App\Models\transaction;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\VocationalController;
use App\Http\Controllers\DashboardController;

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

Route::redirect('/', '/login');

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
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin'])->group(function () {
    Route::group(['prefix' => 'admin', 'as'=> 'admin.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
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
        Route::get('/transaction/confirm', [TransaksiController::class,'adminConfirmation'])->name('transaction.confirm');
        Route::get('/transaction', [TransaksiController::class,'adminIndex'])->name('transaction.index');
    });
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:ht'])->group(function () {
    Route::group(['prefix' => 'homeroom-teacher', 'as'=> 'ht.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'teacherDashboard'])->name('dashboard');
        Route::get('/transaksi/index',[TransaksiController::class,'teacherIndex'])->name('htIndex');
        Route::get('/transaksi/riwayat',[TransaksiController::class,'teacherRiwayat'])->name('riwayat');
        Route::get('/transaksi/setor/{name}',[TransaksiController::class,'setor'])->name('transaksiSetor');
        Route::get('/transaksi/tarik/{name}',[TransaksiController::class,'tarik'])->name('transaksiTarik');
        Route::post('/transaksi/withdraw',[TransaksiController::class,'withdraw'])->name('transaksiWithdraw');
        Route::post('/transaksi/store',[TransaksiController::class,'store'])->name('transaksiStore');
    });
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:student', 'status:false'])->group(function () {
    Route::get('/tabungan-sekolah', function () {
                $auth = Auth::user(); // Get the authenticated user
        $profile = StudentProfile::where('id', $auth->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile
$trans = transaction::with('user')->where('user_id', $auth->id)->latest()->first();


        return view('backend.student.dashboard', compact('auth', 'profile','trans'));
    })->name('tabungan-sekolah');
    Route::get('/transaksi/riwayat/{id}',[TransaksiController::class,'riwayat'])->name('transaksiRiwayat');
    Route::get('/transaksi/bukti/{no_transaksi}',[TransaksiController::class,'bukti'])->name('transaksiBukti');
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
