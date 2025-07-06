<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Carbon;

class KunjunganExport implements FromCollection, WithHeadings, WithMapping
{
    protected $kunjungan;

    public function __construct($kunjungan)
    {
        $this->kunjungan = $kunjungan;
    }

    public function collection()
    {
        return $this->kunjungan;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Pasien',
            'Dokter Pemeriksa',
            'Diagnosa',
            'Keluhan',
            'Resep Obat',
        ];
    }

    public function map($item): array
    {
        return [
            Carbon::parse($item->tanggal_periksa)->format('d-m-Y H:i'),
            $item->pasien->nama ?? 'N/A',
            $item->dokter->user->name ?? 'N/A',
            $item->diagnosa,
            $item->keluhan_utama,
            $item->resep_obat,
        ];
    }
}