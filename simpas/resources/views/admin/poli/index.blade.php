<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Manajemen Poli</h3>
        <a href="{{ route('admin.poli.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">+ Tambah Poli</a>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Nama Poli</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($polis as $poli)
                        <tr class="text-gray-700">
                            <td class="py-4 whitespace-nowrap">{{ $poli->nama_poli }}</td>
                            <td class="py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admin.poli.edit', $poli) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Edit</a>
                                    <form action="{{ route('admin.poli.destroy', $poli) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus poli ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="py-4 text-center text-gray-500">Data poli tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6">{{ $polis->links() }}</div>
        </div>
    </div>
</x-app-layout>