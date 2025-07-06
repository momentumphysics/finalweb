<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\KunjunganExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kunjungan = null;
        if ($request->has('tanggal_laporan') && $request->tanggal_laporan) {
            $tanggal = Carbon::parse($request->tanggal_laporan);
            $jenis = $request->jenis_laporan ?? 'harian';

            $query = RekamMedis::with(['pasien', 'dokter.user']);

            if ($jenis === 'harian') {
                $query->whereDate('tanggal_periksa', $tanggal);
            } elseif ($jenis === 'mingguan') {
                $query->whereBetween('tanggal_periksa', [$tanggal->startOfWeek(), $tanggal->endOfWeek()]);
            } elseif ($jenis === 'bulanan') {
                $query->whereMonth('tanggal_periksa', $tanggal->month)->whereYear('tanggal_periksa', $tanggal->year);
            }
            
            $kunjungan = $query->get();
        }

        return view('admin.laporan.index', compact('kunjungan'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'tanggal_laporan' => 'required|date',
            'jenis_laporan' => 'required|in:harian,mingguan,bulanan',
            'export_type' => 'required|in:pdf,excel',
        ]);

        $tanggal = Carbon::parse($request->tanggal_laporan);
        $jenis = $request->jenis_laporan;

        $query = RekamMedis::with(['pasien', 'dokter.user']);

        if ($jenis === 'harian') {
            $query->whereDate('tanggal_periksa', $tanggal);
        } elseif ($jenis === 'mingguan') {
            $query->whereBetween('tanggal_periksa', [$tanggal->startOfWeek(), $tanggal->endOfWeek()]);
        } elseif ($jenis === 'bulanan') {
            $query->whereMonth('tanggal_periksa', $tanggal->month)->whereYear('tanggal_periksa', $tanggal->year);
        }
            
        $kunjungan = $query->get();
        $fileName = 'laporan-kunjungan-' . $jenis . '-' . $tanggal->format('Y-m-d') . '.' . ($request->export_type === 'pdf' ? 'pdf' : 'xlsx');
        
        if ($request->export_type === 'pdf') {
            $pdf = Pdf::loadView('admin.laporan.pdf', ['kunjungan' => $kunjungan, 'tanggal' => $tanggal, 'jenis' => $jenis]);
            return $pdf->download($fileName);
        } 
        
        if ($request->export_type === 'excel') {
            return Excel::download(new KunjunganExport($kunjungan), $fileName);
        }
    }
}