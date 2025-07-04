<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Barryvdh\DomPDF\Facade\Pdf; // Untuk mencetak PDF (instalasi nanti)

class RekamMedisController extends Controller
{
    public function create(Antrian $antrian)
    {
        // Pastikan antrean ini ditujukan untuk dokter yang sedang login dan statusnya 'Diperiksa'
        if ($antrian->dokter_id !== Auth::user()->dokter->id || $antrian->status !== 'Diperiksa') {
            abort(403, 'Akses tidak valid untuk rekam medis ini.');
        }

        $pasien = $antrian->pasien; // Ambil data pasien dari antrean

        return view('dokter.rekam_medis.create', compact('antrian', 'pasien'));
    }

    public function store(Request $request, Antrian $antrian)
    {
        $request->validate([
            'keluhan_utama' => 'required|string|max:255',
            'diagnosa_tindakan' => 'required|string',
            'resep_obat' => 'nullable|string',
        ]);

        // Simpan rekam medis
        $rekamMedis = RekamMedis::create([
            'pasien_id' => $antrian->pasien_id,
            'dokter_id' => Auth::user()->dokter->id,
            'antrian_id' => $antrian->id,
            'keluhan_utama' => $request->keluhan_utama,
            'diagnosa_tindakan' => $request->diagnosa_tindakan,
            'resep_obat' => $request->resep_obat,
            'tanggal_pemeriksaan' => now(),
        ]);

        // Ubah status antrean menjadi 'Selesai'
        $antrian->status = 'Selesai';
        $antrian->save();

        return redirect()->route('dokter.dashboard')->with('success', 'Rekam medis berhasil disimpan.');
    }

    public function printResep(RekamMedis $rekamMedis)
    {
        // Pastikan rekam medis ini milik dokter yang sedang login
        if ($rekamMedis->dokter_id !== Auth::user()->dokter->id) {
            abort(403, 'Anda tidak memiliki akses untuk resep ini.');
        }

        $pdf = Pdf::loadView('dokter.rekam_medis.resep_pdf', compact('rekamMedis'));
        return $pdf->download('resep_' . $rekamMedis->id . '.pdf');
    }
}