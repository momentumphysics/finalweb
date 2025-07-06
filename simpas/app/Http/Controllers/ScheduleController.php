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
        // 1. Ambil semua data jadwal dari database
        $allSchedules = JadwalDokter::with(['dokter.user', 'poli'])->orderBy('dokter_id')->get();

        // 2. Siapkan array kosong untuk menampung jadwal yang sudah dikelompokkan
        $groupedSchedules = [];

        // 3. Lakukan perulangan untuk mengelompokkan jadwal
        foreach ($allSchedules as $schedule) {
            // Kunci unik untuk pengelompokan: kombinasi dokter, poli, dan jam
            $key = $schedule->dokter_id . '-' . $schedule->poli_id . '-' . $schedule->jam_mulai . '-' . $schedule->jam_selesai;

            // Jika kunci ini belum ada di array, buat entri baru
            if (!isset($groupedSchedules[$key])) {
                $groupedSchedules[$key] = [
                    'dokter_nama' => $schedule->dokter->user->name ?? 'N/A',
                    'poli_nama' => $schedule->poli->nama_poli ?? 'N/A',
                    'waktu' => Carbon::parse($schedule->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($schedule->jam_selesai)->format('H:i'),
                    'hari' => [], // Siapkan array untuk menampung hari
                ];
            }

            // Tambahkan hari ke dalam grup yang sesuai
            $groupedSchedules[$key]['hari'][] = $schedule->hari;
        }

        // 4. Gabungkan array hari menjadi satu string (contoh: "Senin, Selasa, Rabu")
        foreach ($groupedSchedules as &$group) { // Gunakan reference (&) untuk mengubah langsung
            $group['hari'] = implode(', ', $group['hari']);
        }

        // 5. Kirim data yang sudah rapi ke view
        return view('resepsionis.jadwal.index', ['jadwalTampil' => $groupedSchedules]);
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