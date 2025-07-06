<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Data Dokter</h3>
        {{-- Tombol Tambah Dokter --}}
        <a href="{{ route('admin.dokter.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-semibold">
            Tambah Dokter
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Card utama untuk tabel --}}
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Nama Dokter</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Spesialisasi</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($dokters as $dokter)
                        <tr class="text-gray-700">
                            <td class="py-4 whitespace-nowrap">{{ $dokter->nama_dokter }}</td>
                            <td class="py-4 whitespace-nowrap">{{ $dokter->spesialisasi }}</td>
                            <td class="py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admin.dokter.edit', $dokter) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Edit</a>
                                    <form action="{{ route('admin.dokter.destroy', $dokter) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data dokter ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">
                                Data dokter tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Link Paginasi --}}
            <div class="mt-6">
                {{ $dokters->links() }}
            </div>
        </div>
    </div>
</x-app-layout>