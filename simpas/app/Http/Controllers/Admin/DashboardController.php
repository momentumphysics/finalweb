<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\User; // <-- Pastikan User model diimpor
use App\Models\Antrian;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        
        // Mengubah cara menghitung total dokter berdasarkan role di tabel users
        $totalDokter = User::where('role', 'dokter')->count();

        $kunjunganHariIni = Antrian::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact('totalPasien', 'totalDokter', 'kunjunganHariIni'));
    }
}