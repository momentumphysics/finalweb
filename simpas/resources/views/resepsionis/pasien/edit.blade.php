<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Edit Pasien: {{ $pasien->nama }}</h3>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('resepsionis.pasien.update', $pasien) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Form fields --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $pasien->nama) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="no_ktp" class="block text-sm font-medium text-gray-700">Nomor KTP</label>
                    <input type="text" name="no_ktp" id="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat', $pasien->alamat) }}</textarea>
                </div>
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="Laki-laki" {{ (old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ (old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mt-8 border-t pt-6 flex items-center justify-end space-x-4">
                <a href="{{ route('resepsionis.pasien.index') }}" class="text-sm text-gray-600">Batal</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout> 