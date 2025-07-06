<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Menampilkan halaman jadwal dokter untuk Resepsionis.
     * Mengambil semua jadwal dokter dari database.
     */
    public function index()
    {
        // Mengambil semua data jadwal beserta relasi ke dokter dan user (untuk nama)
        $schedules = JadwalDokter::with(['dokter.user'])->get();

        // Mengirim data ke view
        // Anda perlu membuat file view di: resources/views/resepsionis/jadwal/index.blade.php
        return view('resepsionis.jadwal.index', compact('schedules'));
    }

    /**
     * Menampilkan halaman jadwal praktik untuk Dokter yang sedang login.
     */
    public function mySchedule()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mengambil jadwal yang hanya dimiliki oleh dokter tersebut
        $mySchedules = JadwalDokter::where('dokter_id', $user->dokter->id)
                                    ->with('poli')
                                    ->get();

        // Mengirim data ke view
        // Anda perlu membuat file view di: resources/views/dokter/jadwal/index.blade.php
        return view('dokter.jadwal.index', compact('mySchedules'));
    }
}