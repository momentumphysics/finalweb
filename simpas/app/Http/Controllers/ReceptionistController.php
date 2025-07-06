<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReceptionistController extends Controller
{
    /**
     * Menampilkan dashboard untuk resepsionis.
     */
    public function index()
    {
        // Menghitung total semua pasien
        $totalPasien = Pasien::count();

        // Menghitung antrian aktif untuk hari ini
        $antrianAktif = Antrian::whereDate('created_at', Carbon::today())->count();

        // Mengirim data statistik ke view 
        return view('resepsionis.dashboard', compact('totalPasien', 'antrianAktif'));
    }
}