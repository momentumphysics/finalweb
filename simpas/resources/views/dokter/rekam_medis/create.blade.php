<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Rekam Medis Elektronik</h3>

    <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('dokter.rekam-medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="antrian_id" value="{{ $antrian->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
                    <input type="text" readonly value="{{ now()->format('d F Y, H:i') }}" class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" readonly value="{{ $antrian->pasien->nama }}" class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm sm:text-sm">
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="keluhan_utama" class="block text-sm font-medium text-gray-700">Keluhan Utama</label>
                    <textarea id="keluhan_utama" name="keluhan_utama" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan keluhan utama pasien">{{ old('keluhan_utama') }}</textarea>
                </div>
                <div>
                    <label for="diagnosa_tindakan" class="block text-sm font-medium text-gray-700">Diagnosa & Tindakan</label>
                    <textarea id="diagnosa_tindakan" name="diagnosa_tindakan" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan diagnosa dan tindakan yang diberikan">{{ old('diagnosa_tindakan') }}</textarea>
                </div>
                <div>
                    <label for="resep_obat" class="block text-sm font-medium text-gray-700">Resep Obat</label>
                    <textarea id="resep_obat" name="resep_obat" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Paracetamol 500mg (3x1 sesudah makan)">{{ old('resep_obat') }}</textarea>
                </div>
            </div>

            <div class="flex items-center space-x-4 mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Simpan Rekam Medis
                </button>
                <a href="{{ route('dokter.dashboard') }}" class="px-6 py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>