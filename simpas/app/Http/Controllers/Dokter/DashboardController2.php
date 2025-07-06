<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use Carbon\Carbon;

class DashboardController2 extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // -- AWAL PERBAIKAN --
        // Periksa apakah pengguna yang login memiliki profil dokter terkait.
        if (!$user->dokter) {
            // Jika tidak, logout pengguna dan arahkan kembali ke halaman login
            // dengan pesan kesalahan.
            Auth::logout();
            return redirect()->route('login')->with('error', 'Profil dokter Anda tidak lengkap atau belum dibuat oleh Administrator.');
        }
        // -- AKHIR PERBAIKAN --

        $dokterId = $user->dokter->id;

        // Ambil antrean hari ini untuk dokter yang login 
        $antreanHariIni = Antrian::where('dokter_id', $dokterId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', '!=', 'Selesai')
            ->with('pasien')
            ->get();

        // Ambil jadwal praktik dokter 
        $jadwalPraktik = $user->dokter->jadwal;

        return view('dokter.dashboard', compact('antreanHariIni', 'jadwalPraktik'));
    }
}