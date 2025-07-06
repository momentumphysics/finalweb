<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Tambah Dokter Baru</h3>

    <div class="bg-white p-8 rounded-lg shadow-md">
        {{-- Menampilkan error validasi jika ada --}}
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

        <form action="{{ route('admin.dokter.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                {{-- Dropdown untuk memilih User --}}
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User Akun Dokter</label>
                    <select name="user_id" id="user_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-gray-500">Hanya menampilkan user dengan role 'dokter' yang belum memiliki profil.</p>
                </div>

                {{-- Input Spesialisasi --}}
                <div>
                    <label for="spesialisasi" class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                    <input type="text" name="spesialisasi" id="spesialisasi" value="{{ old('spesialisasi') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                           placeholder="Contoh: Umum, Gigi, Anak">
                </div>

                {{-- Input No. HP --}}
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required
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
                    Simpan Data Dokter
                </button>
            </div>
        </form>
    </div>
</x-app-layout>