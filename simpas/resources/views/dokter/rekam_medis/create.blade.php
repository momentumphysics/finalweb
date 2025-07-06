<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Rekam Medis Elektronik</h3>

    <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('dokter.rekam-medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="antrian_id" value="{{ $antrian->id }}">

            {{-- Tanggal dan Nama Pasien --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="tanggal_pemeriksaan" class="block text-sm font-medium text-gray-700">Tanggal & Waktu Pemeriksaan</label>
                    <input type="text" id="tanggal_pemeriksaan" readonly value="{{ now()->translatedFormat('d F Y') }}" class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm sm:text-sm">
                </div>
                <div>
                    <label for="nama_pasien" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" id="nama_pasien" readonly value="{{ $antrian->pasien->nama }}" class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm sm:text-sm">
                </div>
            </div>

            <div class="space-y-6">
                {{-- Keluhan Utama --}}
                <div>
                    <label for="keluhan_utama" class="block text-sm font-medium text-gray-700">Keluhan Utama</label>
                    <textarea id="keluhan_utama" name="keluhan_utama" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan keluhan utama pasien">{{ old('keluhan_utama') }}</textarea>
                </div>

                {{-- Diagnosa & Tindakan --}}
                <div>
                    <label for="diagnosa" class="block text-sm font-medium text-gray-700">Diagnosa & Tindakan</label>
                    <textarea id="diagnosa" name="diagnosa" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan Diagnosa">{{ old('diagnosa') }}</textarea>
                </div>

                {{-- Resep Obat Dinamis --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Resep Obat</label>
                    <div id="resep-obat-container" class="space-y-2 mt-1">
                        <div class="flex items-center space-x-2">
                            <input type="text" name="resep_obat[]" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Nama Obat, Dosis, Aturan Pakai">
                        </div>
                    </div>
                    <button type="button" id="tambah-obat-btn" class="mt-2 px-4 py-2 bg-gray-200 text-gray-800 text-sm font-semibold rounded-lg hover:bg-gray-300">Tambah Obat</button>
                </div>

                {{-- Rujukan --}}
                <div>
                    <label for="rujukan" class="block text-sm font-medium text-gray-700">Rujukan (Jika Perlu)</label>
                    <input type="text" id="rujukan" name="rujukan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Rujuk ke...">
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-wrap items-center justify-start gap-4 mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Simpan Rekam Medis
                </button>
                <a href="{{ route('dokter.dashboard') }}" class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>

    {{-- Script untuk Tambah Obat Dinamis --}}
    <script>
        document.getElementById('tambah-obat-btn').addEventListener('click', function() {
            const container = document.getElementById('resep-obat-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center space-x-2';
            newRow.innerHTML = `
                <input type="text" name="resep_obat[]" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Nama Obat, Dosis, Aturan Pakai">
                <button type="button" class="remove-obat-btn px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">&times;</button>
            `;
            container.appendChild(newRow);
        });

        document.getElementById('resep-obat-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-obat-btn')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-app-layout>