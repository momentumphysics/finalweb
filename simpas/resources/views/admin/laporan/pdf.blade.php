<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kunjungan</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Laporan Kunjungan {{ ucfirst($jenis) }} - {{ $tanggal->format('d F Y') }}</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Pasien</th>
                <th>Dokter</th>
                <th>Diagnosa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kunjungan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_periksa)->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->pasien->nama ?? 'N/A' }}</td>
                    <td>{{ $item->dokter->user->name ?? 'N/A' }}</td>
                    <td>{{ $item->diagnosa }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>