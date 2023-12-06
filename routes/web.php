<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\BidangController;
use App\Http\Controllers\Master\LayananController;
use App\Http\Controllers\Master\OpdController;
use App\Http\Controllers\Master\PeriodikController;
use App\Http\Controllers\Master\PertanyaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\TipeJawabanController;
use App\Http\Controllers\Master\UserController;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login_process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'access_check'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard.index');

    Route::prefix('/master')->group(function () {
        Route::get('/opd/data', [OpdController::class, 'data'])->name('opd.data');
        Route::get('/opd/data_peruntukan', [OpdController::class, 'dataPeruntukan'])->name('opd.data_peruntukan');
        Route::resource('/opd', OpdController::class);

        Route::get('/bidang/data', [BidangController::class, 'data'])->name('bidang.data');
        Route::resource('/bidang', BidangController::class);

        Route::get('/layanan/data', [LayananController::class, 'data'])->name('layanan.data');
        Route::get('/layanan/data_bidang', [LayananController::class, 'dataBidang'])->name('layanan.data_bidang');
        Route::resource('/layanan', LayananController::class);

        Route::get('/roles/data', [RoleController::class, 'data'])->name('roles.data');
        Route::resource('/roles', RoleController::class)->except('create, edit');

        Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
        Route::get('/user/data_role', [UserController::class, 'data_role'])->name('user.data_role');
        Route::resource('/user', UserController::class)->except('create, edit');

        Route::get('/tipe_jawaban/data', [TipeJawabanController::class, 'data'])->name('tipe_jawaban.data');
        Route::resource('/tipe_jawaban', TipeJawabanController::class);

        Route::get('/periodik/data', [PeriodikController::class, 'data'])->name('periodik.data');
        Route::resource('/periodik', PeriodikController::class);

        Route::get('/pertanyaan/data', [PertanyaanController::class, 'data'])->name('pertanyaan.data');
        Route::resource('/pertanyaan', PertanyaanController::class);
    });
});
