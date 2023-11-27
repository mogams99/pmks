<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\OpdController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login_process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'access_check'])->group(function () {
    // Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/dashboard', DashboardController::class)->name('dashboard.index');
    
    Route::get('/1', function () { echo 'Not Found'; })->name('1');
    Route::get('/2', function () { echo 'Not Found'; })->name('2');
    Route::get('/3', function () { echo 'Not Found'; })->name('3');
    Route::get('/4', function () { echo 'Not Found'; })->name('4');
    Route::get('/5', function () { echo 'Not Found'; })->name('5');
    Route::get('/6', function () { echo 'Not Found'; })->name('6');
    Route::get('/7', function () { echo 'Not Found'; })->name('7');

    Route::prefix('/master')->group(function () { 
        Route::get('/opd/data', [OpdController::class, 'data'])->name('opd.data');
        Route::get('/opd/data_peruntukan', [OpdController::class, 'dataPeruntukan'])->name('opd.data_peruntukan');
        Route::resource('/opd', OpdController::class);
    });
});