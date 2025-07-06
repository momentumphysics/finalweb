<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Rekam Medis Pasien</h3>
        {{-- Bisa ditambahkan form pencarian di sini jika perlu --}}
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="hidden md:grid md:grid-cols-12 gap-4 font-bold text-gray-500 uppercase text-sm px-4 pb-4 border-b">
            <div class="col-span-2">Tanggal</div>
            <div class="col-span-3">Pasien</div>
            <div class="col-span-3">Dokter</div>
            <div class="col-span-3">Diagnosa</div>
            <div class="col-span-1 text-center">Aksi</div>
        </div>
        
        <div class="space-y-1">
            @forelse($rekamMedis as $rekam)
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center p-4 hover:bg-gray-50 rounded-lg border-b md:border-none">
                    <div class="md:col-span-2"><span class="md:hidden font-bold text-gray-500">Tanggal: </span>{{ \Carbon\Carbon::parse($rekam->tanggal_periksa)->format('d-m-Y') }}</div>
                    <div class="md:col-span-3"><span class="md:hidden font-bold text-gray-500">Pasien: </span>{{ $rekam->pasien->nama ?? 'N/A' }}</div>
                    <div class="md:col-span-3"><span class="md:hidden font-bold text-gray-500">Dokter: </span>{{ $rekam->dokter->user->name ?? 'N/A' }}</div>
                    <div class="md:col-span-3"><span class="md:hidden font-bold text-gray-500">Diagnosa: </span>{{ \Illuminate\Support\Str::limit($rekam->diagnosa, 40) }}</div>
                    <div class="md:col-span-1 text-left md:text-center">
                        <a href="{{ route('resepsionis.rekam-medis.show', $rekam) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Detail</a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-8">Data rekam medis tidak ditemukan.</p>
            @endforelse
        </div>
        
        <div class="mt-6">
            {{ $rekamMedis->links() }}
        </div>
    </div>
</x-app-layout>