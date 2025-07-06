<x-dokter-layout>
    <x-slot name="header">
        Dashboard Dokter
    </x-slot>

    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm font-semibold">Total Pasien Dalam Antrian</h3>
                <p class="text-3xl font-bold">1</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm font-semibold">Kunjungan Hari Ini</h3>
                <p class="text-3xl font-bold">1</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-4">Jadwal Praktik Hari Ini</h3>
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 rounded-r-lg">
                    <p class="font-bold">Senin, Kamis, Jumat: 14.00 - 18.00 (Poli GIGI)</p>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-4">Antrian Pasien</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 transition">
                        <div>
                            <p class="font-bold text-gray-800">A001 Shalsa Bila</p>
                            <p class="text-sm text-gray-600">Poli Gigi</p>
                        </div>
                        <a href="#" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                            Mulai Periksa
                        </a>
                    </div>
                     </div>
            </div>
        </div>
    </div>
</x-dokter-layout>