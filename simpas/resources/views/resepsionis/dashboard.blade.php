<x-app-layout>
    <h3 class="text-gray-700 text-3xl font-medium mb-4">Dashboard Resepsionis</h3>

    <div class="mt-4">
        {{-- Kartu Statistik --}}
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-blue-100 rounded-full">
                        {{-- Icon Pasien (SVG) --}}
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalPasien }}</h4>
                        <div class="text-gray-500">Total Pasien</div>
                    </div>
                </div>
            </div>

            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-6">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-blue-100 rounded-full">
                        {{-- Icon Antrian (SVG) --}}
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $antrianAktif }}</h4>
                        <div class="text-gray-500">Antrian Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Antrian Berlangsung --}}
    <div class="mt-8">
        <div class="bg-white p-6 rounded-md shadow-sm">
            <h3 class="text-gray-700 text-xl font-semibold mb-4">Antrian Yang Berlangsung</h3>
            <div class="space-y-4">
                @forelse ($antrianBerlangsung as $antrian)
                    <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 transition">
                        <div>
                            <p class="font-bold text-gray-800">{{ $antrian->pasien->no_mr ?? 'N/A' }} - {{ $antrian->pasien->nama ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">
                                {{ $antrian->poli->nama_poli ?? 'N/A' }} - {{ $antrian->dokter->user->name ?? 'N/A' }}
                            </p>
                        </div>
                        <div>
                            @if ($antrian->status == 'Menunggu')
                                <span class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded-full">
                                    {{ $antrian->status }}...
                                </span>
                            @elseif ($antrian->status == 'Diperiksa')
                                <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">
                                    {{ $antrian->status }}...
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-4">
                        Tidak ada antrean yang sedang berlangsung saat ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>