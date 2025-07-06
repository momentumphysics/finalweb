<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController2 extends Controller
{
    /**
     * Menampilkan daftar rekam medis yang dibuat oleh dokter yang login.
     */
    public function index(Request $request)
    {
        $dokterId = Auth::user()->dokter->id;
        $query = RekamMedis::where('dokter_id', $dokterId)
                           ->with('pasien')
                           ->latest('tanggal_periksa');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pasien', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        $rekamMedis = $query->paginate(15);
        return view('dokter.rekam_medis.index', compact('rekamMedis'));
    }

    /**
     * Menampilkan detail satu rekam medis.
     */
    public function show(RekamMedis $rekamMedis)
    {
        // Pastikan dokter hanya bisa melihat rekam medis miliknya
        if ($rekamMedis->dokter_id !== Auth::user()->dokter->id) {
            abort(403, 'Akses Ditolak');
        }
        $rekamMedis->load(['pasien', 'dokter.user', 'poli']);
        return view('dokter.rekam_medis.show', compact('rekamMedis'));
    }

    // Menampilkan halaman form rekam medis
    public function create(Antrian $antrian)
    {
        // Ganti status antrean menjadi "Diperiksa"
        $antrian->update(['status' => 'Diperiksa']);
        return view('dokter.rekam_medis.create', compact('antrian'));
    }

    // Menyimpan data rekam medis
    public function store(Request $request)
    {
        $request->validate([
            'antrian_id' => 'required|exists:antrians,id',
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
            'keluhan_utama' => $request->keluhan_utama,
            'diagnosa' => $request->diagnosa_tindakan,
            'resep_obat' => $request->resep_obat,
            'tanggal_periksa' => now(),
        ]);

        $antrian->update(['status' => 'Selesai']);
        return redirect()->route('dokter.dashboard')->with('success', 'Rekam medis berhasil disimpan.');
    }
}