<!DOCTYPE html>
<html>
<head>
    <title>Resep Obat</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .container { width: 80%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        .details p { margin: 5px 0; }
        .resep { border: 1px solid #ccc; padding: 15px; min-height: 150px; }
        .footer { text-align: right; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Resep Obat Klinik An-Nur</h1>
            <p>Tanggal: {{ \Carbon\Carbon::parse($rekamMedis->tanggal_pemeriksaan)->format('d F Y H:i') }}</p>
        </div>

        <div class="details">
            <p><strong>Nama Pasien:</strong> {{ $rekamMedis->pasien->nama }}</p>
            <p><strong>Umur:</strong> {{ \Carbon\Carbon::parse($rekamMedis->pasien->tanggal_lahir)->age }} tahun</p>
            <p><strong>Dokter:</strong> {{ $rekamMedis->dokter->user->name }}</p>
        </div>

        <div class="resep">
            <h3>R/</h3>
            <p style="white-space: pre-wrap;">{{ $rekamMedis->resep_obat }}</p>
        </div>

        <div class="footer">
            <p>Hormat Kami,</p>
            <p>{{ $rekamMedis->dokter->user->name }}</p>
        </div>
    </div>
</body>
</html>