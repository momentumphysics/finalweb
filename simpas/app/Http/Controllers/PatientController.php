<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Method untuk menampilkan form pendaftaran
    public function create()
    {
        return view('resepsionis.pasien.create');
    }

    // Method untuk menyimpan data pasien baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:pasiens',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
        ]);

        // Simpan ke database
        Pasien::create($request->all());

        // Redirect ke halaman daftar pasien dengan pesan sukses
        return redirect()->route('resepsionis.pasien.index')->with('success', 'Pasien baru berhasil didaftarkan.');
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
}