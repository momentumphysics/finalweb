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

        // BARU: Mengambil data antrean yang sedang berlangsung (statusnya bukan 'Selesai')
        $antrianBerlangsung = Antrian::whereDate('created_at', Carbon::today())
                                     ->where('status', '!=', 'Selesai')
                                     ->with(['pasien', 'dokter.user', 'poli'])
                                     ->orderBy('id', 'asc')
                                     ->get();

        // Mengirim semua data ke view
        return view('resepsionis.dashboard', compact('totalPasien', 'antrianAktif', 'antrianBerlangsung'));
    }
}