<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Antrian;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Menampilkan form pendaftaran dengan data poli dan dokter.
     */
    public function create()
    {
        $polis = Poli::all();
        $dokters = Dokter::with('user')->get();
        return view('resepsionis.pasien.create', compact('polis', 'dokters'));
    }

    /**
     * Menyimpan pasien baru dan langsung mendaftarkannya ke antrian.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Validasi untuk Poli & Dokter
            'poli_id' => 'required|exists:polis,id',
            'dokter_id' => 'required|exists:dokters,id',
            // Validasi untuk Data Pasien
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:pasiens',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // 1. Buat Pasien Baru
        $pasien = new Pasien();
        $pasien->no_mr = 'MR' . date('Ymd') . rand(100, 999);
        $pasien->nama = $request->nama;
        $pasien->no_ktp = $request->no_ktp;
        $pasien->alamat = $request->alamat;
        $pasien->no_hp = $request->no_hp;
        $pasien->tanggal_lahir = $request->tanggal_lahir;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->save();

        // 2. Buat Antrian untuk Pasien tersebut
        $nomorAntrian = Antrian::where('poli_id', $request->poli_id)->whereDate('created_at', today())->count() + 1;
        Antrian::create([
            'pasien_id' => $pasien->id,
            'poli_id' => $request->poli_id,
            'dokter_id' => $request->dokter_id,
            'no_antrian' => 'A' . str_pad($nomorAntrian, 3, '0', STR_PAD_LEFT), // Contoh: A001
            'status' => 'Menunggu',
        ]);

        // 3. Redirect ke halaman antrian
        return redirect()->route('resepsionis.antrian.index')->with('success', 'Pasien baru berhasil didaftarkan dan ditambahkan ke antrian.');
    }

    // Method untuk menampilkan daftar pasien (akan digunakan nanti)
    public function index(Request $request)
    {
        $query = Pasien::query();

        // Logika pencarian pasien
        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('no_ktp', 'like', '%' . $request->search . '%');
        }

        $pasiens = $query->paginate(10);
        return view('resepsionis.pasien.index', compact('pasiens'));
    }

    public function show(Pasien $pasien)
    {
        // Anda perlu membuat view untuk ini di resources/views/resepsionis/pasien/show.blade.php
        return view('resepsionis.pasien.show', compact('pasien'));
    }

    /**
     * Menampilkan form untuk mengedit data pasien.
     */
    public function edit(Pasien $pasien)
    {
        // Anda perlu membuat view untuk ini di resources/views/resepsionis/pasien/edit.blade.php
        return view('resepsionis.pasien.edit', compact('pasien'));
    }

    /**
     * Memperbarui data pasien di database.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:pasiens,no_ktp,' . $pasien->id,
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $pasien->update($request->all());

        return redirect()->route('resepsionis.pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Menghapus data pasien.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('resepsionis.pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }

    /**
     * Mencari pasien berdasarkan nama atau nomor rekam medis.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        if ($query) {
            $pasiens = Pasien::where('nama', 'LIKE', "%{$query}%")
                             ->orWhere('no_mr', 'LIKE', "%{$query}%")
                             ->take(5) // Batasi hasil pencarian menjadi 5
                             ->get();
            return response()->json($pasiens);
        }
        return response()->json([]);
    }
}