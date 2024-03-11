<?php

use App\Http\Controllers\SessionController;
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

// Route::get('/', function () {
//     return view('sesi.register');
// });
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function (){
        Route::get('/data_laporan', [\App\Http\Controllers\LaporanController::class, 'index_laporan_user'])->name('admin.laporan');
        Route::get('/data_laporan_arsip', [\App\Http\Controllers\LaporanController::class, 'index_laporan_arsip'])->name('admin.laporan.arsip');
        Route::get('/data_laporan/{id}', [\App\Http\Controllers\LaporanController::class,'show'])->name('laporan.detail');
        Route::get('/update_status_laporan/{id}', [\App\Http\Controllers\LaporanController::class,'update_status'])->name('update.status');
        Route::get('/index', [\App\Http\Controllers\LaporanController::class,'index']);
        Route::get('/data_user', [\App\Http\Controllers\UserRoleController::class,'index']);
        Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('logout.user');
    });
    Route::prefix('user')->group(function (){
        Route::get('/data_kendaraan',[\App\Http\Controllers\KendaraanController::class, 'index']);
        Route::get('/create_data_kendaraan',[\App\Http\Controllers\KendaraanController::class, 'create']);
        Route::post('/store',[\App\Http\Controllers\KendaraanController::class, 'store'])->name('kendaraan.store');
        Route::get('/data_kendaraan/{id}', [\App\Http\Controllers\KendaraanController::class,'show'])->name('detail.kendaraan');
        Route::get('/edit_kendaraan/{id}', [\App\Http\Controllers\KendaraanController::class,'edit'])->name('edit.kendaraan');
        Route::put('/edit_kendaraan/{id}', [\App\Http\Controllers\KendaraanController::class,'update'])->name('update.kendaraan');
        Route::get('/delete_kendaraan/{id}', [\App\Http\Controllers\KendaraanController::class,'destroy'])->name('delete.kendaraan');

//        LAPORAN
        Route::get('/data_laporan', [\App\Http\Controllers\LaporanController::class, 'index_laporan_user']);
        Route::get('/create_laporan',[\App\Http\Controllers\LaporanController::class,'create'])->name('laporan.create_data');
        Route::post('/laporan_store',[\App\Http\Controllers\LaporanController::class,'store'])->name('laporan.store');
        Route::get('/data_laporan/{id}', [\App\Http\Controllers\LaporanController::class,'show'])->name('laporan.detail');
        Route::get('/delete_laporan/{id}', [\App\Http\Controllers\LaporanController::class,'destroy'])->name('laporan.delete');
        Route::get('/edit_laporan/{id}', [\App\Http\Controllers\LaporanController::class,'edit'])->name('laporan.edit');
        Route::put('/edit_laporan/{id}', [\App\Http\Controllers\LaporanController::class,'update'])->name('laporan.update');
    });
});
//public router
Route::get('/', [SessionController::class, 'dashboard']);


Route::middleware('guest')->group(function (){
    Route::get('/sesi', [SessionController::class, 'index'])->name("login");
    Route::post('/sesi/login', [SessionController::class, 'login']);
    Route::get('/sesi/register', [SessionController::class, 'register'])->name("register");
    Route::post('/sesi/create', [SessionController::class, 'create']);
});
