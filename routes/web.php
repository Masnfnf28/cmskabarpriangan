<?php

use App\Http\Controllers\AdvertorialController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LayananKamiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RedaksiController;
use App\Http\Controllers\TentangKamiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Frontend - Tidak Perlu Login)
|--------------------------------------------------------------------------
| Route-route ini dapat diakses oleh siapa saja tanpa perlu login.
| Halaman-halaman ini menampilkan konten untuk pengunjung umum.
*/

// Halaman Beranda
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Halaman Advertorial
Route::get('/advertorial', [AdvertorialController::class, 'index'])->name('advertorial.page');

//Halaman Redaksi
Route::get('/redaksi', [RedaksiController::class, 'index'])->name('redaksi');
// Halaman Layanan Kami
Route::get('/layanan-kami', [LayananKamiController::class, 'index'])->name('layanan-kami');
//tentang kami
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang-kami');
/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Backend - Perlu Login)
|--------------------------------------------------------------------------
| Route-route ini hanya dapat diakses oleh user yang sudah login.
| Digunakan untuk mengelola konten, profile, dan dashboard admin.
*/

// Dashboard Admin
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Konten Management (CRUD)
Route::resource('konten', KontenController::class)->middleware('auth');

// Authentication Routes
require __DIR__ . '/auth.php';


