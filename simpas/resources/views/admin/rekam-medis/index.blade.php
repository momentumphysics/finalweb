<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Data Rekam Medis</h3>
        <form action="{{ route('admin.rekam-medis.index') }}" method="GET">
             <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none"><path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </span>
                <input class="w-full md:w-64 block pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                       type="text" name="search" placeholder="Cari Pasien/Dokter..." value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Tanggal Periksa</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Nama Pasien</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Dokter Pemeriksa</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Diagnosa</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($rekamMedis as $rekam)
                        <tr class="text-gray-700">
                            <td class="py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($rekam->tanggal_periksa)->format('d/m/Y H:i') }}</td>
                            <td class="py-4 whitespace-nowrap">{{ $rekam->pasien->nama ?? 'N/A' }}</td>
                            <td class="py-4 whitespace-nowrap">{{ $rekam->dokter->user->name ?? 'N/A' }}</td>
                            <td class="py-4 whitespace-nowrap">{{ Str::limit($rekam->diagnosa, 50) }}</td>
                            <td class="py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 font-semibold">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">
                                Data rekam medis tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6">
                {{ $rekamMedis->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
</x-app-layout>