<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian; // Pastikan model Antrian sudah ada
use App\Models\JadwalDokter; // Pastikan model JadwalDokter sudah ada
use App\Models\Pasien; // Pastikan model Pasien sudah ada
use App\Models\RekamMedis; // Pastikan model RekamMedis sudah ada

class DokterController extends Controller
{
    public function dashboard()
    {
        // Pastikan hanya dokter yang bisa mengakses dashboard ini
        if (!Auth::user()->isDokter()) { // Asumsi ada method isDokter() di model User
            abort(403, 'Unauthorized access.');
        }

        $dokterId = Auth::user()->dokter->id; // Asumsi ada relasi one-to-one User dengan Dokter

        // Mengambil antrean pasien yang ditujukan untuk dokter yang sedang login
        $antrianPasien = Antrian::where('dokter_id', $dokterId)
                                ->whereIn('status', ['Menunggu', 'Diperiksa']) // Sesuaikan status antrean
                                ->orderBy('created_at', 'asc')
                                ->get();

        // Mengambil jadwal praktik dokter
        $jadwalPraktik = JadwalDokter::where('dokter_id', $dokterId)
                                    ->orderBy('hari', 'asc')
                                    ->get();

        return view('dokter.dashboard', compact('antrianPasien', 'jadwalPraktik'));
    }
}

class DokterController extends Controller
{
    // ...

    public function mulaiPeriksa(Antrian $antrian)
    {
        // Pastikan antrean ini ditujukan untuk dokter yang sedang login
        if ($antrian->dokter_id !== Auth::user()->dokter->id) {
            abort(403, 'Anda tidak memiliki akses untuk memeriksa pasien ini.');
        }

        // Ubah status antrean menjadi 'Diperiksa'
        $antrian->status = 'Diperiksa';
        $antrian->save();

        // Redirect ke halaman rekam medis
        return redirect()->route('dokter.rekam-medis.create', ['antrian' => $antrian->id]);
    }
}

// ...

class DokterController extends Controller
{
    // ...

    public function jadwalPraktik()
    {
        $dokterId = Auth::user()->dokter->id;
        $jadwalPraktik = JadwalDokter::where('dokter_id', $dokterId)
                                    ->orderBy('hari', 'asc')
                                    ->get();

        return view('dokter.jadwal_praktik', compact('jadwalPraktik'));
    }
}