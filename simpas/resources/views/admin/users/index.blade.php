<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl font-medium">Manajemen User</h3>
        {{-- Tombol Tambah User --}}
        <a href="{{ route('admin.users.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            + Tambah User
        </a>
    </div>

    {{-- Notifikasi Sukses atau Error --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Card utama untuk tabel --}}
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Username</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Nama</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Role</th>
                        <th class="pb-4 text-left text-lg font-semibold text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="text-gray-700">
                            <td class="py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                    @if($user->role == 'admin') bg-red-100 text-red-800 @elseif($user->role == 'dokter') bg-blue-100 text-blue-800 @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="py-4 whitespace-nowrap text-sm font-medium">
                                {{-- Aksi: Lihat, Edit, Hapus --}}
                                <div class="flex items-center space-x-4">
                                     <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Lihat</a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 whitespace-nowrap text-center text-gray-500">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Link Paginasi --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>