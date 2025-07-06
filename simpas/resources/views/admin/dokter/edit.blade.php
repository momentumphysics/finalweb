<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Edit Data Dokter</h3>

    <div class="bg-white p-8 rounded-lg shadow-md">
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dokter.update', $dokter) }}" method="POST">
            @csrf
            @method('PUT') {{-- Method untuk update --}}

            <div class="space-y-6">
                {{-- Menampilkan nama user yang terhubung (tidak bisa diubah) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">User Akun Dokter</label>
                    <p class="mt-1 block w-full px-3 py-2 bg-gray-100 rounded-md border-gray-300 shadow-sm sm:text-sm">
                        {{ $dokter->user->name }} ({{ $dokter->user->email }})
                    </p>
                </div>

                {{-- Input Spesialisasi --}}
                <div>
                    <label for="spesialisasi" class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                    <input type="text" name="spesialisasi" id="spesialisasi" value="{{ old('spesialisasi', $dokter->spesialisasi) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                           placeholder="Contoh: Umum, Gigi, Anak">
                </div>

                {{-- Input No. HP --}}
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                           placeholder="Contoh: 081234567890">
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end mt-8 border-t pt-6">
                <a href="{{ route('admin.dokter.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>