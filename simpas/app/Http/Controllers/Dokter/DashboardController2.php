<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Carbon\Carbon;

class DashboardController2 extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->dokter) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Profil dokter Anda tidak lengkap atau belum dibuat oleh Administrator.');
        }

        $dokterId = $user->dokter->id;

        // Get today's queue for the logged-in doctor that is not yet 'Selesai'
        $antreanHariIni = Antrian::where('dokter_id', $dokterId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', '!=', 'Selesai')
            ->with('pasien', 'poli')
            ->get();

        // Get the doctor's practice schedule
        $jadwalPraktik = $user->dokter->jadwal()->with('poli')->get();
        
        // Get the count of visits for today
        $kunjunganHariIni = RekamMedis::where('dokter_id', $dokterId)
            ->whereDate('tanggal_periksa', Carbon::today())
            ->count();

        return view('dokter.dashboard', compact('antreanHariIni', 'jadwalPraktik', 'kunjunganHariIni'));
    }
}