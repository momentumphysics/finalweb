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
    /**
     * Menampilkan halaman manajemen antrian.
     */
    public function index(Request $request)
    {
        // Ambil data antrian hari ini yang statusnya BUKAN 'Selesai'
        $antrians = Antrian::with(['pasien', 'dokter.user', 'poli'])
                            ->whereDate('created_at', Carbon::today())
                            ->where('status', '!=', 'Selesai')
                            ->orderBy('no_antrian', 'asc')
                            ->get();

        // Data ini tetap ada untuk form (jika diperlukan di modal atau halaman lain)
        $pasiens = Pasien::all();
        $polis = Poli::all();
        $selectedPasienId = $request->query('pasien_id');

        return view('resepsionis.antrian.index', compact('antrians', 'pasiens', 'polis', 'selectedPasienId'));
    }

    /**
     * Menyelesaikan sebuah antrian.
     */
    public function finish(Antrian $antrian)
    {
        $antrian->update(['status' => 'Selesai']);
        return redirect()->route('resepsionis.antrian.index')->with('success', 'Antrian untuk pasien ' . $antrian->pasien->nama . ' telah diselesaikan.');
    }
    
    // Menyimpan pasien ke dalam antrian
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'poli_id' => 'required|exists:polis,id',
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        // 1. Logika untuk membuat nomor antrian
        // Menghitung jumlah antrian yang sudah ada di poli yang sama pada hari ini
        $nomorUrut = Antrian::where('poli_id', $request->poli_id)
                             ->whereDate('created_at', Carbon::today())
                             ->count() + 1;
        
        // Format nomor antrian, contoh: A001, A012, dst.
        $noAntrian = 'A' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        // 2. Simpan data antrian baru beserta nomornya
        Antrian::create([
            'pasien_id' => $request->pasien_id,
            'poli_id' => $request->poli_id,
            'dokter_id' => $request->dokter_id,
            'no_antrian' => $noAntrian, // <-- Tambahkan nomor antrian yang sudah dibuat
            'status' => 'Menunggu',
        ]);

        return redirect()->route('resepsionis.antrian.index')->with('success', 'Pasien berhasil ditambahkan ke antrian dengan nomor ' . $noAntrian);
    }
}