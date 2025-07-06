<x-app-layout>
    {{-- Header dengan Judul dan Form Pencarian --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h3 class="text-gray-700 text-3xl font-medium">Riwayat Rekam Medis</h3>
        
        <form action="{{ route('dokter.rekam-medis.index') }}" method="GET">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <input class="w-full md:w-64 block pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                       type="text" name="search" placeholder="Cari Nama Pasien..." value="{{ request('search') }}">
            </div>
        </form>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="pb-4 text-left font-semibold text-gray-800">Tanggal</th>
                        <th class="pb-4 text-left font-semibold text-gray-800">Nama Pasien</th>
                        <th class="pb-4 text-left font-semibold text-gray-800">Diagnosa</th>
                        <th class="pb-4 text-left font-semibold text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($rekamMedis as $rekam)
                        <tr class="text-gray-700">
                            <td class="py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($rekam->tanggal_periksa)->format('d/m/Y H:i') }}</td>
                            <td class="py-4 whitespace-nowrap">{{ $rekam->pasien->nama ?? 'N/A' }}</td>
                            <td class="py-4 whitespace-nowrap">{{ \Illuminate\Support\Str::limit($rekam->diagnosa, 50) }}</td>
                            <td class="py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('dokter.rekam-medis.show', $rekam) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                @if(request('search'))
                                    Pasien dengan nama "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Anda belum memiliki riwayat rekam medis.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Link Paginasi yang sudah disesuaikan --}}
            <div class="mt-6">
                {{ $rekamMedis->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
</x-app-layout>