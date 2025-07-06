<?php

use App\Http\Controllers\ProfileController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Dokter\DashboardController2;
use App\Http\Controllers\Dokter\JadwalPraktikController;
use App\Http\Controllers\Dokter\RekamMedisController;

use App\Http\Controllers\QueueController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PatientController;



//Bagian Abdi
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

Route::middleware(['auth', 'can:is-admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';


//Bagian Faiqah
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


// Bagian Nurul Raehan
Route::middleware(['auth', 'verified', 'is-resepsionis'])->prefix('resepsionis')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ReceptionistController::class, 'index'])->name('resepsionis.dashboard');

    // Manajemen Pasien
    Route::get('/pasien', [PatientController::class, 'index'])->name('resepsionis.pasien.index');
    Route::get('/pasien/create', [PatientController::class, 'create'])->name('resepsionis.pasien.create');
    Route::post('/pasien', [PatientController::class, 'store'])->name('resepsionis.pasien.store');
    Route::get('/pasien/{pasien}', [PatientController::class, 'show'])->name('resepsionis.pasien.show');

    // Kelola Antrian
    Route::get('/antrian', [QueueController::class, 'index'])->name('resepsionis.antrian.index');
    Route::post('/antrian', [QueueController::class, 'store'])->name('resepsionis.antrian.store');

    // Informasi Jadwal Dokter
    Route::get('/jadwal-dokter', [ScheduleController::class, 'index'])->name('resepsionis.jadwal.index');
require __DIR__.'/auth.php';