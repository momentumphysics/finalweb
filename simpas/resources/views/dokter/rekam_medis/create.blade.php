<x-dokter-layout>
    <x-slot name="header">
        Rekam Medis Elektronik
    </x-slot>

    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg mb-4 border-b pb-2">Pemeriksaan Baru</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Nama Pasien</label>
                    <p class="font-semibold text-lg">Shalsa Bila</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Tanggal & Waktu Pemeriksaan</label>
                    <p class="font-semibold text-lg">23 Juni 2025</p>
                </div>
            </div>

            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan Utama</label>
                    <textarea id="keluhan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
                <div>
                    <label for="diagnosa" class="block text-sm font-medium text-gray-700">Diagnosa & Tindakan</label>
                    <textarea id="diagnosa" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan Diagnosa"></textarea>
                </div>
                <div>
                    <label for="resep" class="block text-sm font-medium text-gray-700">Resep Obat</label>
                    <textarea id="resep" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Nama Obat, Dosis"></textarea>
                    <button type="button" class="mt-2 text-sm text-blue-600 hover:text-blue-800 font-semibold">Tambah Obat</button>
                </div>
                 <div>
                    <label for="rujukan" class="block text-sm font-medium text-gray-700">Rujukan (Jika Perlu)</label>
                    <input type="text" id="rujukan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4 border-t">
                    <button type="button" class="px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">Cetak Resep</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">Simpan Rekam Medis</button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg mb-4">Riwayat Medis Sebelumnya</h3>
            <div class="space-y-4">
                <div class="p-3 border rounded-lg bg-gray-50">
                    <p class="text-sm font-semibold">15 Mei 2025 - Tambal Gigi</p>
                    <p class="text-xs text-gray-600">Dokter: dr. Nur Faiqatunnisa</p>
                </div>
                <div class="p-3 border rounded-lg">
                    <p class="text-sm font-semibold">10 Januari 2025 - Sakit Gigi</p>
                    <p class="text-xs text-gray-600">Dokter: dr. Nur Faiqatunnisa</p>
                </div>
            </div>
        </div>
    </div>
</x-dokter-layout>