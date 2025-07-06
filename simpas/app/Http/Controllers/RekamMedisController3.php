<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController3 extends Controller
{
    /**
     * Menampilkan halaman daftar rekam medis.
     */
    public function index(Request $request)
    {
        $query = RekamMedis::with(['pasien', 'dokter.user'])->latest('tanggal_periksa');

        // Fungsi pencarian (opsional, bisa ditambahkan nanti)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('pasien', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        $rekamMedis = $query->paginate(15);
        return view('resepsionis.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Menampilkan detail satu rekam medis.
     */
    public function show(RekamMedis $rekamMedis)
    {
        // Eager load relasi untuk ditampilkan di detail
        $rekamMedis->load(['pasien', 'dokter.user', 'poli']);
        return view('resepsionis.rekam-medis.show', compact('rekamMedis'));
    }
}