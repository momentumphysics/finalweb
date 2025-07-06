<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

// Ganti nama kelas controller dokter agar sesuai dengan nama file
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

// Ini adalah route fallback jika tidak ada role yang cocok
Route::get('/dashboard', function () {
    // Arahkan ke dashboard yang sesuai berdasarkan peran pengguna
    // Ganti auth()->user() menjadi Auth::user()
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role === 'dokter') {
        return redirect()->route('dokter.dashboard');
    } elseif (Auth::user()->role === 'resepsionis') {
        return redirect()->route('resepsionis.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk Admin
Route::middleware(['auth', 'can:is-admin'])->prefix('admin')->name('admin.')->group(function () {
    // Ubah nama route dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
});

//Bagian Faiqah
Route::middleware(['auth', 'can:is-dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // Ubah nama route dashboard dokter
    Route::get('dashboard', [DashboardController2::class, 'index'])->name('dashboard');
    Route::get('periksa/{antrian}', [RekamMedisController::class, 'create'])->name('periksa.create');
    Route::post('rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    Route::get('jadwal-praktik', [JadwalPraktikController::class, 'index'])->name('jadwal-praktik.index');
});


// Bagian Nurul Raehan
Route::middleware(['auth', 'can:is-resepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', [ReceptionistController::class, 'index'])->name('dashboard');
    Route::get('/pasien', [PatientController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PatientController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PatientController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/{pasien}', [PatientController::class, 'show'])->name('pasien.show');
    Route::get('/antrian', [QueueController::class, 'index'])->name('antrian.index');
    Route::post('/antrian', [QueueController::class, 'store'])->name('antrian.store');
    Route::get('/jadwal-dokter', [ScheduleController::class, 'index'])->name('jadwal.index');
});

require __DIR__.'/auth.php';