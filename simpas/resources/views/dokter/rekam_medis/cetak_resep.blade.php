<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resep Obat - {{ $rekamMedis->pasien->nama }}</title>
    <style>
        body { font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; }
        .container { width: 100%; margin: 0 auto; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; }
        .patient-info { margin-bottom: 20px; }
        .patient-info table { width: 100%; }
        .patient-info td { padding: 5px; }
        .prescription-body { margin-top: 30px; }
        .prescription-body h2 { font-size: 20px; text-decoration: underline; margin-bottom: 15px; }
        .prescription-content { white-space: pre-wrap; font-family: monospace; font-size: 16px; border: 1px solid #eee; padding: 15px; border-radius: 5px; }
        .footer { text-align: right; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KLINIK AN-NUR</h1>
            <p>Jl. Kesehatan No. 123, Kota Sehat</p>
            <p>Dokter: {{ $rekamMedis->dokter->user->name }}</p>
        </div>

        <div class="patient-info">
            <table>
                <tr>
                    <td><strong>Nama Pasien:</strong> {{ $rekamMedis->pasien->nama }}</td>
                    <td><strong>Tanggal:</strong> {{ $rekamMedis->tanggal_periksa->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Usia:</strong> {{ $rekamMedis->pasien->age }} Tahun</td>
                    <td><strong>No. MR:</strong> {{ $rekamMedis->pasien->no_mr }}</td>
                </tr>
            </table>
        </div>

        <div class="prescription-body">
            <h2>R/</h2>
            <div class="prescription-content">
                {{ $rekamMedis->resep_obat }}
            </div>
        </div>

        <div class="footer">
            <p>Semoga lekas sembuh,</p>
            <br><br><br>
            <p>({{ $rekamMedis->dokter->user->name }})</p>
        </div>
    </div>
</body>
</html>