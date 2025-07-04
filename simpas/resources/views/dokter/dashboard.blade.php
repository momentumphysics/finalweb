<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Antrean Pasien Anda</h3>
                    @if ($antrianPasien->isEmpty())
                        <p>Tidak ada pasien dalam antrean saat ini.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Antrean</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poli Tujuan</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($antrianPasien as $antrian)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $antrian->nomor_antrean }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $antrian->pasien->nama }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $antrian->poli->nama }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $antrian->status }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($antrian->status === 'Menunggu')
                                                    <a href="{{ route('dokter.mulai-periksa', $antrian->id) }}" class="text-indigo-600 hover:text-indigo-900">Mulai Periksa</a>
                                                @else
                                                    <span class="text-gray-500">Sudah Diperiksa</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Jadwal Praktik Saya</h3>
                    @if ($jadwalPraktik->isEmpty())
                        <p>Anda belum memiliki jadwal praktik.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Mulai</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Selesai</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poli</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($jadwalPraktik as $jadwal)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->hari }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->jam_mulai }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->jam_selesai }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->poli->nama }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>