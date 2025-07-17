<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\User;
use App\Models\Antrian;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        
        $totalDokter = User::where('role', 'dokter')->count();

        $kunjunganHariIni = Antrian::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact('totalPasien', 'totalDokter', 'kunjunganHariIni'));
    }
}