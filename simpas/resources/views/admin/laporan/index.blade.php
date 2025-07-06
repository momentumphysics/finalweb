<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Laporan dan Statistik</h3>

    <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('admin.laporan.index') }}" method="GET">
            <div class="space-y-4">
                <div>
                    <label class="text-base font-medium text-gray-900">Pilihi Jenis Laporan yang ingin anda lihat atau ekspor</label>
                    <fieldset class="mt-4">
                        <div class="space-x-4">
                            <label class="inline-flex items-center"><input type="radio" name="jenis_laporan" value="harian" class="h-4 w-4 text-blue-600 border-gray-300" {{ request('jenis_laporan', 'harian') == 'harian' ? 'checked' : '' }}> <span class="ml-2">Harian</span></label>
                            <label class="inline-flex items-center"><input type="radio" name="jenis_laporan" value="mingguan" class="h-4 w-4 text-blue-600 border-gray-300" {{ request('jenis_laporan') == 'mingguan' ? 'checked' : '' }}> <span class="ml-2">Mingguan</span></label>
                            <label class="inline-flex items-center"><input type="radio" name="jenis_laporan" value="bulanan" class="h-4 w-4 text-blue-600 border-gray-300" {{ request('jenis_laporan') == 'bulanan' ? 'checked' : '' }}> <span class="ml-2">Bulanan</span></label>
                        </div>
                    </fieldset>
                </div>
                <div>
                    <label for="tanggal_laporan" class="block text-sm font-medium text-gray-700">Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" id="tanggal_laporan" value="{{ request('tanggal_laporan', now()->format('Y-m-d')) }}" required class="mt-1 block w-full md:w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <button type="submit" class="w-full md:w-1/3 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-lg">Tampilkan Laporan</button>
            </div>
        </form>
    </div>

    @if(isset($kunjungan))
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            @if($kunjungan->isEmpty())
                <p class="text-center text-gray-500">Tidak ada Kunjungan pada periode yang dipilih.</p>
            @else
                <div class="overflow-x-auto">
                    <h4 class="text-xl font-semibold mb-4">Hasil Laporan</h4>
                     <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="pb-4 text-left font-semibold text-gray-800">Tanggal</th>
                                <th class="pb-4 text-left font-semibold text-gray-800">Pasien</th>
                                <th class="pb-4 text-left font-semibold text-gray-800">Dokter</th>
                                <th class="pb-4 text-left font-semibold text-gray-800">Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($kunjungan as $item)
                            <tr class="text-gray-700">
                                <td class="py-2">{{ \Carbon\Carbon::parse($item->tanggal_periksa)->format('d/m/Y H:i') }}</td>
                                <td class="py-2">{{ $item->pasien->nama ?? 'N/A' }}</td>
                                <td class="py-2">{{ $item->dokter->user->name ?? 'N/A' }}</td>
                                <td class="py-2">{{ \Illuminate\Support\Str::limit($item->diagnosa, 40) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-center space-x-4 mt-8">
                    <a href="{{ route('admin.laporan.export', ['tanggal_laporan' => request('tanggal_laporan'), 'jenis_laporan' => request('jenis_laporan', 'harian'), 'export_type' => 'pdf']) }}"
                       class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-lg">
                        Ekspor PDF
                    </a>
                    <a href="{{ route('admin.laporan.export', ['tanggal_laporan' => request('tanggal_laporan'), 'jenis_laporan' => request('jenis_laporan', 'harian'), 'export_type' => 'excel']) }}"
                       class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-lg">
                        Ekspor Excel
                    </a>
                </div>
            @endif
        </div>
    @endif
</x-app-layout>