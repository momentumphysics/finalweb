<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Informasi Jadwal Dokter</h3>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="grid grid-cols-12 gap-4 font-bold text-gray-600 uppercase text-sm px-4 pb-4 border-b">
            <div class="col-span-1">No</div>
            <div class="col-span-4">Nama Dokter</div>
            <div class="col-span-2">Poli</div>
            <div class="col-span-3">Hari</div>
            <div class="col-span-2">Waktu</div>
        </div>
        
        <div class="divide-y">
            @forelse($jadwalTampil as $jadwal)
                <div class="grid grid-cols-12 gap-4 items-center p-4">
                    <div class="col-span-1 text-gray-700">{{ $loop->iteration }}</div>
                    <div class="col-span-4 font-semibold text-gray-800">{{ $jadwal['dokter_nama'] }}</div>
                    <div class="col-span-2 text-gray-700">{{ $jadwal['poli_nama'] }}</div>
                    <div class="col-span-3 text-gray-700">{{ $jadwal['hari'] }}</div>
                    <div class="col-span-2 text-gray-700">{{ $jadwal['waktu'] }}</div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-8">Jadwal dokter belum tersedia.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>