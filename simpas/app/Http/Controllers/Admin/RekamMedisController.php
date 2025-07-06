<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = RekamMedis::with(['pasien', 'dokter.user']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('pasien', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('no_mr', 'like', '%' . $search . '%');
            })->orWhereHas('dokter.user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $rekamMedis = $query->latest('tanggal_periksa')->paginate(10);
        return view('admin.rekam-medis.index', compact('rekamMedis'));
    }

    // Nanti bisa ditambahkan fungsi show(RekamMedis $rekamMedis) untuk melihat detail
}