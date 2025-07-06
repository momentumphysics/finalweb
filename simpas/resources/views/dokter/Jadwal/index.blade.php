<x-dokter-layout>
    <x-slot name="header">
        Jadwal Praktik Saya
    </x-slot>

    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokter</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">POLI</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">01</td>
                        <td class="px-6 py-4 whitespace-nowrap">dr. Nur Faiqatunnisa</td>
                        <td class="px-6 py-4 whitespace-nowrap">GIGI</td>
                        <td class="px-6 py-4 whitespace-nowrap">Senin, Kamis, Jumat</td>
                        <td class="px-6 py-4 whitespace-nowrap">14.00-18.00</td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>
</x-dokter-layout>