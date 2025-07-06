<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Dashboard Dokter</h3>

    <div class="container mx-auto mt-6">
        {{-- Statistic Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <div class="mx-5">
                    <h4 class="text-gray-500 text-sm font-semibold">Total Pasien Dalam Antrian</h4>
                    <p class="text-3xl font-bold">{{ $antreanHariIni->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="mx-5">
                    <h4 class="text-gray-500 text-sm font-semibold">Kunjungan Hari Ini</h4>
                    <p class="text-3xl font-bold">{{ $kunjunganHariIni }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Practice Schedule --}}
            <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-4">Jadwal Praktik Hari Ini</h3>
                @if($jadwalPraktik->isNotEmpty())
                    @foreach($jadwalPraktik as $jadwal)
                        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 rounded-r-lg mb-2">
                            <p class="font-bold">{{ $jadwal->hari }}: {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') }} ({{ $jadwal->poli->nama_poli }})</p>
                        </div>
                    @endforeach
                @else
                    <div class="bg-gray-50 border-l-4 border-gray-500 text-gray-800 p-4 rounded-r-lg">
                        <p class="font-bold">Tidak ada jadwal praktik hari ini.</p>
                    </div>
                @endif
            </div>

            {{-- Patient Queue --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-4">Antrian Pasien</h3>
                <div class="space-y-4">
                    @forelse($antreanHariIni as $antrian)
                        <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 transition">
                            <div>
                                <p class="font-bold text-gray-800">{{ $antrian->no_antrian }} {{ $antrian->pasien->nama }}</p>
                                <p class="text-sm text-gray-600">Poli {{ $antrian->poli->nama_poli }}</p>
                            </div>
                            <a href="{{ route('dokter.periksa.create', $antrian) }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                                Mulai Periksa
                            </a>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-4">
                            Tidak ada antrean pasien untuk saat ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>