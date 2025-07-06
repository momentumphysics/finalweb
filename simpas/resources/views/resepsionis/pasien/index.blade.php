<x-app-layout>
    {{-- Header dengan Form Pencarian --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h3 class="text-gray-700 text-3xl font-medium">Manajemen Pasien</h3>
        <form action="{{ route('resepsionis.pasien.index') }}" method="GET">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <input class="w-full md:w-64 block pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                       type="text" name="search" placeholder="Cari Pasien..." value="{{ request('search') }}">
            </div>
        </form>
    </div>

    {{-- Layout Kartu Pasien --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($pasiens as $pasien)
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-6 relative">
                <div class="w-20 h-20 bg-blue-500 text-white flex items-center justify-center rounded-full font-bold text-3xl flex-shrink-0">
                    @php
                        $nameParts = explode(' ', $pasien->nama);
                        $initials = count($nameParts) > 1
                            ? strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1))
                            : strtoupper(substr($pasien->nama, 0, 2));
                    @endphp
                    {{ $initials }}
                </div>
                <div class="flex-grow">
                    <h4 class="text-lg font-semibold text-gray-800">{{ $pasien->nama }}</h4>
                    <p class="text-sm text-gray-600">Usia: {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} Tahun</p>
                    <p class="text-sm text-gray-600">Jenis Kelamin: {{ $pasien->jenis_kelamin }}</p>
                    <p class="text-sm text-gray-600">Alamat: {{ \Illuminate\Support\Str::limit($pasien->alamat, 25) }}</p>
                </div>
                <div class="absolute top-4 right-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('resepsionis.pasien.show', $pasien) }}">
                                {{ __('Lihat Detail') }}
                            </x-dropdown-link>
                             <x-dropdown-link href="{{ route('resepsionis.pasien.edit', $pasien) }}">
                                {{ __('Edit Pasien') }}
                            </x-dropdown-link>
                            {{-- Link ini akan mengarahkan ke halaman rekam medis dengan filter berdasarkan nomor MR pasien --}}
                            <x-dropdown-link href="{{ route('admin.rekam-medis.index', ['search' => $pasien->no_mr]) }}">
                                {{ __('Rekam Medis') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                <p>Data pasien tidak ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $pasiens->appends(['search' => request('search')])->links() }}
    </div>
</x-app-layout>