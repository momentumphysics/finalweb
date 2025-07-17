<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PatientController2 extends Controller
{
    /**
     * Menampilkan daftar pasien untuk admin.
     */
    public function index(Request $request)
    {
        $query = Pasien::query();

        // Logika pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('no_mr', 'like', '%' . $request->search . '%');
        }

        $pasiens = $query->latest()->paginate(10);

        return view('admin.pasien.index', compact('pasiens'));
    }

}