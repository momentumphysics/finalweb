<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Tambah Poli Baru</h3>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.poli.store') }}" method="POST">
            @csrf
            <div>
                <label for="nama_poli" class="block text-sm font-medium text-gray-700 mb-1">Nama Poli</label>
                <input type="text" name="nama_poli" id="nama_poli" value="{{ old('nama_poli') }}" required placeholder="Contoh: Poli Gigi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('nama_poli') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center justify-end mt-8 border-t pt-6">
                <a href="{{ route('admin.poli.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>