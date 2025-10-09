<?php

use App\Http\Controllers\KontenController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\InterventionImage;
use App\Models\Konten;
use Carbon\Carbon;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

// 🧭 DASHBOARD DENGAN GRAFIK
Route::get('/dashboard', function () {
    $year = now()->year;

    // Total konten
    $totalKonten = Konten::count();

    // Ambil jumlah konten per bulan
    $dataPerBulanRaw = Konten::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
        ->whereYear('tanggal', $year)
        ->groupBy('bulan')
        ->pluck('jumlah', 'bulan');

    // Pastikan semua bulan 1-12 tersedia
    $dataPerBulan = [];
    $bulanLabels = [];
    for ($i = 1; $i <= 12; $i++) {
        $dataPerBulan[] = $dataPerBulanRaw->get($i, 0); // default 0
        $bulanLabels[] = Carbon::create()->month($i)->format('F'); // Jan, Feb, ...
    }

    return view('page.dashboard.index', compact('totalKonten', 'dataPerBulan', 'bulanLabels'));
})->name('dashboard')->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);
Route::get('/', [WelcomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('konten', KontenController::class)->middleware('auth');
require __DIR__.'/auth.php';
