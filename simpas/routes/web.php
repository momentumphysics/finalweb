<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;

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

Route::middleware(['auth', 'can:is-dokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
});

Route::middleware(['auth', 'can:is-dokter'])->group(function () {
    // ...
    Route::get('/dokter/mulai-periksa/{antrian}', [DokterController::class, 'mulaiPeriksa'])->name('dokter.mulai-periksa');
});

Route::middleware(['auth', 'can:is-dokter'])->group(function () {
    // ...
    Route::get('/dokter/rekam-medis/{antrian}/create', [RekamMedisController::class, 'create'])->name('dokter.rekam-medis.create');
    Route::post('/dokter/rekam-medis/{antrian}/store', [RekamMedisController::class, 'store'])->name('dokter.rekam-medis.store');
    Route::get('/dokter/rekam-medis/{rekamMedis}/print-resep', [RekamMedisController::class, 'printResep'])->name('dokter.rekam-medis.print-resep');
});

Route::middleware(['auth', 'can:is-dokter'])->group(function () {
    // ...
    Route::get('/dokter/jadwal-praktik', [DokterController::class, 'jadwalPraktik'])->name('dokter.jadwal-praktik');
});
require __DIR__.'/auth.php';
