<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Pendaftaran Pasien</h3>

    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('resepsionis.pasien.store') }}" method="POST">
            @csrf
            
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

            {{-- Poli dan Dokter --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
                <div>
                    <label for="poli_id" class="block text-sm font-medium text-gray-700">Poli yang Dituju</label>
                    <select name="poli_id" id="poli_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Poli</option>
                        @foreach($polis as $poli)
                            {{-- Diasumsikan model Poli memiliki kolom 'nama_poli' --}}
                            <option value="{{ $poli->id }}" {{ old('poli_id') == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli ?? "Poli ID {$poli->id}" }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="dokter_id" class="block text-sm font-medium text-gray-700">Dokter yang Dituju</label>
                    <select name="dokter_id" id="dokter_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Dokter</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>{{ $dokter->user->name ?? "Dokter ID {$dokter->id}" }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Data Pasien --}}
            <h4 class="text-lg font-semibold text-gray-800 mb-4 border-t pt-6">Data Pasien</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                {{-- Kolom Kiri --}}
                <div class="space-y-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required placeholder="Masukkan Nama Lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                {{-- Kolom Kanan --}}
                <div class="space-y-6">
                    <div>
                        <label for="no_ktp" class="block text-sm font-medium text-gray-700">Nomor Induk Kependudukan</label>
                        <input type="text" name="no_ktp" id="no_ktp" value="{{ old('no_ktp') }}" required placeholder="Nomor Induk Penduduk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                {{-- Kolom Penuh --}}
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" required placeholder="Alamat Lengkap Pasien" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required placeholder="Nomor Telepon Aktif" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end mt-8 border-t pt-6">
                <button type="submit" class="px-8 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                    Daftarkan Pasien
                </button>
            </div>
        </form>
    </div>
</x-app-layout>