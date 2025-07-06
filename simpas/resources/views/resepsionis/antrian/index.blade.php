<x-app-layout>
<div x-data="{ modalOpen: false }">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Kelola Antrian Pasien</h3>
        <button @click="modalOpen = true" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Tambah Antrian
        </button>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Kartu Daftar Antrian --}}
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h4 class="text-xl font-semibold text-gray-800 mb-6">Antrian Aktif</h4>
        <div class="space-y-4">
            @forelse($antrians as $antrian)
                <div class="flex items-center justify-between p-4 border-b last:border-b-0">
                    <div>
                        <p class="font-bold text-lg text-gray-800">{{ $antrian->no_antrian }} - {{ $antrian->pasien->nama ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600">{{ $antrian->poli->nama_poli ?? 'N/A' }} - {{ $antrian->dokter->user->name ?? 'N/A' }}</p>
                    </div>
                    <div class="flex items-center space-x-8">
                        @if($antrian->status == 'Menunggu')<span class="font-semibold text-yellow-500">{{ $antrian->status }}...</span>@endif
                        @if($antrian->status == 'Diperiksa')<span class="font-semibold text-green-500">{{ $antrian->status }}...</span>@endif
                        <form action="{{ route('resepsionis.antrian.finish', $antrian) }}" method="POST" onsubmit="return confirm('Selesaikan antrian ini?');">
                            @csrf
                            <button type="submit" class="font-semibold text-red-500 hover:text-red-700">Selesai</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-6"><p>Tidak ada antrian aktif saat ini.</p></div>
            @endforelse
        </div>
    </div>

    {{-- Modal Tambah Antrian --}}
    <div x-show="modalOpen" @keydown.escape.window="modalOpen = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div @click.away="modalOpen = false" class="bg-white rounded-lg shadow-xl p-8 w-full max-w-2xl">
            <h3 class="text-2xl font-semibold mb-4">Tambah Antrian</h3>
            
            {{-- Search Pasien --}}
            <div>
                <label for="search-pasien" class="sr-only">Cari Pasien</label>
                <input type="text" id="search-pasien" placeholder="Cari Pasien berdasarkan Nama atau No. RM..." class="w-full border-gray-300 rounded-md shadow-sm">
                <div id="search-results" class="mt-2 border rounded-md max-h-48 overflow-y-auto"></div>
            </div>

            {{-- Form Tambahkan ke Antrian --}}
            <form id="add-to-queue-form" action="{{ route('resepsionis.antrian.store') }}" method="POST" class="mt-6 hidden">
                @csrf
                <input type="hidden" name="pasien_id" id="selected_pasien_id">
                <h4 class="text-lg font-semibold">Tambahkan Ke Antrian</h4>
                <p id="selected_pasien_info" class="mb-4 text-gray-600"></p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="poli_id" class="block text-sm font-medium text-gray-700">Poli Tujuan</label>
                        <select name="poli_id" id="poli_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Pilih Poli</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="dokter_id" class="block text-sm font-medium text-gray-700">Dokter Tujuan</label>
                        <select name="dokter_id" id="dokter_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" disabled>
                            <option value="">Pilih Poli Dulu</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6 pt-4 border-t">
                    <button type="button" @click="modalOpen = false" class="text-gray-600 mr-4">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">Tambahkan Ke Antrian</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-pasien');
    const searchResults = document.getElementById('search-results');
    const addToQueueForm = document.getElementById('add-to-queue-form');
    const poliSelect = document.getElementById('poli_id');
    const dokterSelect = document.getElementById('dokter_id');

    // --- FUNGSI PENCARIAN PASIEN ---
    searchInput.addEventListener('input', function () {
        const query = this.value;
        if (query.length < 2) {
            searchResults.innerHTML = '';
            return;
        }
        fetch(`{{ route('resepsionis.pasien.search') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(pasien => {
                        const div = document.createElement('div');
                        div.className = 'flex justify-between items-center p-3 hover:bg-gray-100 cursor-pointer';
                        div.innerHTML = `
                            <div>
                                <p class="font-semibold">${pasien.nama}</p>
                                <p class="text-sm text-gray-500">${pasien.no_mr}</p>
                            </div>
                            <button type="button" class="pilih-btn px-4 py-1 bg-blue-500 text-white text-sm rounded-md" data-id="${pasien.id}" data-name="${pasien.nama}" data-mr="${pasien.no_mr}">Pilih</button>
                        `;
                        searchResults.appendChild(div);
                    });
                } else {
                    searchResults.innerHTML = '<p class="p-3 text-gray-500">Pasien tidak ditemukan.</p>';
                }
            });
    });

    // --- FUNGSI SAAT TOMBOL 'PILIH' DITEKAN ---
    searchResults.addEventListener('click', function(e) {
        if (e.target.classList.contains('pilih-btn')) {
            document.getElementById('selected_pasien_id').value = e.target.dataset.id;
            document.getElementById('selected_pasien_info').textContent = `Pasien di pilih : ${e.target.dataset.name} (${e.target.dataset.mr})`;
            addToQueueForm.classList.remove('hidden');
            searchResults.innerHTML = '';
            searchInput.value = '';
        }
    });

    // --- FUNGSI DROPDOWN DOKTER DINAMIS ---
    poliSelect.addEventListener('change', function() {
        const poliId = this.value;
        dokterSelect.innerHTML = '<option value="">Memuat dokter...</option>';
        dokterSelect.disabled = true;

        if (poliId) {
            fetch(`/resepsionis/get-doctors-by-poli/${poliId}`)
                .then(response => response.json())
                .then(data => {
                    dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>';
                    if (data.length > 0) {
                        data.forEach(dokter => {
                            const option = document.createElement('option');
                            option.value = dokter.id;
                            option.textContent = dokter.user ? dokter.user.name : 'N/A';
                            dokterSelect.appendChild(option);
                        });
                        dokterSelect.disabled = false;
                    } else {
                        dokterSelect.innerHTML = '<option value="">Tidak ada dokter tersedia</option>';
                    }
                });
        } else {
            dokterSelect.innerHTML = '<option value="">Pilih Poli Dulu</option>';
        }
    });
});
</script>
</x-app-layout>