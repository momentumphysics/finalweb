<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class QueueController extends Controller
{
    // Menampilkan halaman manajemen antrian
    public function index()
    {
        // Ambil data antrian hari ini
        $antrians = Antrian::with(['pasien', 'dokter', 'poli'])
                            ->whereDate('created_at', Carbon::today())
                            ->get();

        $pasiens = Pasien::all(); // Untuk dropdown pilih pasien
        $polis = Poli::all();     // Untuk dropdown pilih poli

        return view('resepsionis.antrian.index', compact('antrians', 'pasiens', 'polis'));
    }

    // Menyimpan pasien ke dalam antrian
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'poli_id' => 'required|exists:polis,id',
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        Antrian::create([
            'pasien_id' => $request->pasien_id,
            'poli_id' => $request->poli_id,
            'dokter_id' => $request->dokter_id,
            'status' => 'Menunggu', // Status awal antrian
        ]);

        return redirect()->route('resepsionis.antrian.index')->with('success', 'Pasien berhasil ditambahkan ke antrian.');
    }
}