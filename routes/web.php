<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\Admin\LaporanUserController;
use App\Http\Controllers\Admin\PointAdminController;
use App\Http\Controllers\Petugas\LaporanPetugasController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
use App\Http\Controllers\Petugas\ProfilPetugasController;
use App\Http\Controllers\User\LaporanController;
use App\Http\Controllers\User\RedeemController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\Petugas\NotificationPetugasController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.update');



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


    Route::get('/user/redeem', [RedeemController::class, 'index'])->name('user.redeem');
    Route::post('/user/redeem', [RedeemController::class, 'store'])->name('user.redeem.store');

    Route::get('/user/profile', [UserUserController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile/update', [UserUserController::class, 'updateProfile'])->name('user.profile.update');

    Route::get('/user/notifications', [NotificationController::class, 'index'])->name('user.notifications');
    Route::post('/user/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('user.notifications.read');
});

Route::get('/petugas/lengkapi-profil', [ProfilPetugasController::class, 'create'])
    ->name('petugas.profil.lengkapi');

Route::post('/petugas/lengkapi-profil', [ProfilPetugasController::class, 'store'])
    ->name('petugas.profil.simpan');

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [DashboardPetugasController::class, 'index'])->name('petugas.dashboard');
    Route::get('/petugas/laporan-saya', [LaporanPetugasController::class, 'index'])->name('petugas.laporan.index');
    Route::get('/laporan/{laporan}', [LaporanPetugasController::class, 'show'])->name('petugas.laporan.show');
    Route::post('/laporan/{laporan}/assign', [LaporanPetugasController::class, 'assign'])->name('petugas.laporan.assign');
    Route::post('/laporan/{laporan}/validate', [LaporanPetugasController::class, 'validateReport'])->name('petugas.laporan.validate');
    Route::get('/petugas/profil', [ProfilPetugasController::class, 'show'])
        ->name('petugas.profil.show');

    Route::post('/petugas/profil/update', [ProfilPetugasController::class, 'update'])
        ->name('petugas.profil.update');
    Route::delete(
        '/petugas/laporan/{laporan}',
        [LaporanPetugasController::class, 'destroy']
    )->name('petugas.laporan.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.pengguna');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('admin.pengguna.show');
    Route::post('/users/{id}/approve', [AdminUserController::class, 'approve'])->name('admin.user.approve');
    Route::post('/users/{id}/reject', [AdminUserController::class, 'reject'])->name('admin.user.reject');
    Route::get('/pengguna/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.pengguna.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.delete');

    Route::get('/point', [PointAdminController::class, 'index'])->name('admin.point');
    Route::get('/point/proses/{id}', [PointAdminController::class, 'proses'])->name('admin.point.proses');
    Route::post('/point/selesai/{id}', [PointAdminController::class, 'selesai'])->name('admin.point.selesai');
    Route::post('/point/tolak/{id}', [PointAdminController::class, 'tolak'])->name('admin.point.tolak');

    Route::get('/laporan', [LaporanUserController::class, 'index'])->name('admin.laporan');
    Route::delete(
        '/laporan/delete-all',
        [LaporanUserController::class, 'deleteAll']
    )->name('admin.laporan.deleteAll');
});
