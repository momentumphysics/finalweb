<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Tambah Pasien ke Antrian</h3>
                    <form method="POST" action="{{ route('resepsionis.antrian.store') }}">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="pasien_id" :value="__('Pilih Pasien')" />
                            <select name="pasien_id" id="pasien_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300">
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}" {{ (isset($selectedPasienId) && $selectedPasienId == $pasien->id) ? 'selected' : '' }}>
                                        {{ $pasien->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <x-primary-button class="mt-4">
                            {{ __('Tambahkan ke Antrian') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Daftar Antrian Hari Ini</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Pasien</th>
                          <th>Poli Tujuan</th>
                          <th>Dokter</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($antrians as $antrian)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $antrian->pasien->nama }}</td>
                          <td>{{ $antrian->poli->nama_poli }}</td>
                          <td>{{ $antrian->dokter->user->name }}</td>
                          <td>
                              <span class="{{ $antrian->status == 'Menunggu' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }} px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                {{ $antrian->status }}
                              </span>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>