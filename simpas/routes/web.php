<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dokter\DashboardController;
use App\Http\Controllers\Dokter\JadwalPraktikController;
use App\Http\Controllers\Dokter\RekamMedisController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is-dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard Dokter 
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Halaman untuk "Mulai Periksa" [cite: 49]
    Route::get('periksa/{antrian}', [RekamMedisController::class, 'create'])->name('periksa.create');

    // Proses simpan rekam medis [cite: 53]
    Route::post('rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');

    // Halaman Jadwal Praktik Saya 
    Route::get('jadwal-praktik', [JadwalPraktikController::class, 'index'])->name('jadwal-praktik.index');
});
require __DIR__.'/auth.php';
