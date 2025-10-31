<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Petugas\LaporanPetugasController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
use App\Http\Controllers\User\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes utama aplikasi
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/pelajari', 'pelajari')->name('pelajari');
Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/fitur', 'fitur')->name('fitur');


// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard per role
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [LaporanController::class, 'dashboard'])->name('user.dashboard');
    // CRUD Laporan
    Route::get('/user/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/user/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/user/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/user/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/user/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/user/laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/user/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
});

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardPetugasController::class, 'index'])->name('petugas.dashboard');
    Route::get('/petugas/laporan-saya', [LaporanPetugasController::class, 'index'])->name('petugas.laporan.index');
    Route::get('/laporan/{laporan}', [LaporanPetugasController::class, 'show'])->name('petugas.laporan.show');
    Route::post('/laporan/{laporan}/assign', [LaporanPetugasController::class, 'assign'])->name('petugas.laporan.assign');
    Route::post('/laporan/{laporan}/validate', [LaporanPetugasController::class, 'validateReport'])->name('petugas.laporan.validate');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
});
