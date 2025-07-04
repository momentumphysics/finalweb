<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rekam Medis Pasien: ') . $pasien->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('dokter.rekam-medis.store', $antrian->id) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="keluhan_utama" class="block text-sm font-medium text-gray-700">Keluhan Utama</label>
                            <textarea name="keluhan_utama" id="keluhan_utama" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('keluhan_utama') }}</textarea>
                            @error('keluhan_utama')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="diagnosa_tindakan" class="block text-sm font-medium text-gray-700">Diagnosa & Tindakan</label>
                            <textarea name="diagnosa_tindakan" id="diagnosa_tindakan" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('diagnosa_tindakan') }}</textarea>
                            @error('diagnosa_tindakan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="resep_obat" class="block text-sm font-medium text-gray-700">Resep Obat (Opsional)</label>
                            <textarea name="resep_obat" id="resep_obat" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('resep_obat') }}</textarea>
                            @error('resep_obat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Simpan Rekam Medis') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>