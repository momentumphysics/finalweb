<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Detail Rekam Medis</h3>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-700">
            <div>
                <label class="block text-sm font-medium text-gray-500">Tanggal Periksa</label>
                <p class="font-semibold">{{ \Carbon\Carbon::parse($rekamMedis->tanggal_periksa)->format('d F Y, H:i') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Poli</label>
                <p class="font-semibold">{{ $rekamMedis->poli->nama_poli ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Nama Pasien</label>
                <p class="font-semibold">{{ $rekamMedis->pasien->nama ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Dokter Pemeriksa</label>
                <p class="font-semibold">{{ $rekamMedis->dokter->user->name ?? 'N/A' }}</p>
            </div>
            <div class="md:col-span-2 mt-4">
                <label class="block text-sm font-medium text-gray-500">Keluhan Utama</label>
                <p class="p-3 bg-gray-50 rounded-md border">{{ $rekamMedis->keluhan_utama }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Diagnosa</label>
                <p class="p-3 bg-gray-50 rounded-md border">{{ $rekamMedis->diagnosa }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Resep Obat</label>
                <p class="p-3 bg-gray-50 rounded-md border whitespace-pre-line">{{ $rekamMedis->resep_obat }}</p>
            </div>
        </div>

        <div class="mt-8 border-t pt-6 flex justify-end">
            <a href="{{ route('resepsionis.rekam-medis.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Kembali</a>
        </div>
    </div>
</x-app-layout>