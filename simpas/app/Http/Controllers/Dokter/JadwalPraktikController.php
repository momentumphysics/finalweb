<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPraktikController extends Controller
{
    public function index()
    {
        $jadwalPribadi = Auth::user()->dokter->jadwal()->with('poli')->get();
        return view('dokter.jadwal.index', compact('jadwalPribadi'));
    }
}