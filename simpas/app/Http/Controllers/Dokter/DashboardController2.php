<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian; // Pastikan model sudah dibuat oleh Dev 1
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $dokterId = Auth::user()->dokter->id;

        // Ambil antrean hari ini untuk dokter yang login 
        $antreanHariIni = Antrian::where('dokter_id', $dokterId)
            ->whereDate('created_at', Carbon::today())
            ->where('status', '!=', 'Selesai')
            ->with('pasien')
            ->get();

        // Ambil jadwal praktik dokter 
        $jadwalPraktik = Auth::user()->dokter->jadwal;

        return view('dokter.dashboard', compact('antreanHariIni', 'jadwalPraktik'));
    }
}