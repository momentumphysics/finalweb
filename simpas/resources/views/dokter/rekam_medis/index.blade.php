<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-6">Riwayat Rekam Medis</h3>

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
                                Anda belum memiliki riwayat rekam medis.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6">
                {{ $rekamMedis->links() }}
            </div>
        </div>
    </div>
</x-app-layout>