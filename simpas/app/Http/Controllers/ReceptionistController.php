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
        // Mengembalikan logika untuk menghitung TOTAL semua pasien
        $totalPasien = Pasien::count();

        // Logika yang sudah benar untuk menghitung antrian aktif
        $antrianAktif = Antrian::whereDate('created_at', Carbon::today())
                                     ->where('status', '!=', 'Selesai')
                                     ->count();

        // Mengambil data antrean yang sedang berlangsung (bukan 'Selesai')
        $antrianBerlangsung = Antrian::whereDate('created_at', Carbon::today())
                                     ->where('status', '!=', 'Selesai')
                                     ->with(['pasien', 'dokter.user', 'poli'])
                                     ->orderBy('id', 'asc')
                                     ->get();

        // Mengirim semua data dengan nama variabel yang benar ke view
        return view('resepsionis.dashboard', compact('totalPasien', 'antrianAktif', 'antrianBerlangsung'));
    }
}