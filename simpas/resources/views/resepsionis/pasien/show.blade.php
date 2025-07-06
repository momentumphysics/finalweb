<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Detail Pasien: {{ $pasien->nama }}</h3>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><strong>No. Rekam Medis:</strong> {{ $pasien->no_mr }}</div>
            <div><strong>No. KTP:</strong> {{ $pasien->no_ktp }}</div>
            <div><strong>Nama Lengkap:</strong> {{ $pasien->nama }}</div>
            <div><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d F Y') }}</div>
            <div><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}</div>
            <div><strong>No. HP:</strong> {{ $pasien->no_hp }}</div>
            <div class="md:col-span-2"><strong>Alamat:</strong> {{ $pasien->alamat }}</div>
        </div>
        <div class="mt-8 border-t pt-6 flex justify-end">
            <a href="{{ route('resepsionis.pasien.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Kembali</a>
        </div>
    </div>
</x-app-layout>