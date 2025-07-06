<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    // Menampilkan halaman form rekam medis [cite: 49]
    public function create(Antrian $antrian)
    {
        // Ganti status antrean menjadi "Diperiksa"
        $antrian->update(['status' => 'Diperiksa']);

        return view('dokter.rekam_medis.create', compact('antrian'));
    }

    // Menyimpan data rekam medis [cite: 53]
    public function store(Request $request)
    {
        $request->validate([
            'antrian_id' => 'required|exists:antrian,id',
            'keluhan_utama' => 'required|string',
            'diagnosa_tindakan' => 'required|string',
            'resep_obat' => 'required|string',
        ]);

        $antrian = Antrian::find($request->antrian_id);

        RekamMedis::create([
            'pasien_id' => $antrian->pasien_id,
            'dokter_id' => Auth::user()->dokter->id,
            'poli_id' => $antrian->poli_id,
            'antrian_id' => $antrian->id,
            'keluhan_utama' => $request->keluhan_utama, // [cite: 52]
            'diagnosa' => $request->diagnosa_tindakan, // [cite: 52]
            'resep_obat' => $request->resep_obat, // [cite: 52]
            'tanggal_periksa' => now(),
        ]);

        // Setelah selesai, ubah status antrean
        $antrian->update(['status' => 'Selesai']);

        return redirect()->route('dokter.dashboard')->with('success', 'Rekam medis berhasil disimpan.');
    }
}