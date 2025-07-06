<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div x-data="{ open: false }" class="flex h-screen bg-gray-100">
        <aside class="w-64 bg-white flex-shrink-0 shadow-lg hidden md:block">
            <div class="p-4 text-center border-b">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800 flex items-center justify-center">
                    <img src="/img/logo-klinik.png" alt="Logo Klinik An-Nur" class="h-10 mr-2">
                    <span class="text-lg">KLINIK AN-NUR</span>
                </a>
            </div>
            <nav class="mt-4">
                {{-- =================== MENU ADMIN =================== --}}
                @can('is-admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.users.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Manajemen User</span>
                    </a>
                    <a href="{{ route('admin.pasien.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.pasien.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Manajemen Pasien</span>
                    </a>
                    <a href="{{ route('admin.dokter.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.dokter.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Manajemen Dokter</span>
                    </a>
                    <a href="{{ route('admin.poli.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.poli.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Manajemen Poli</span>
                    </a>
                    <a href="{{ route('admin.rekam-medis.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.rekam-medis.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Rekam Medis</span>
                    </a>
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.laporan.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Laporan</span>
                    </a>
                @endcan

                {{-- =================== MENU RESEPSIONIS =================== --}}
                @can('is-resepsionis')
                    <a href="{{ route('resepsionis.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('resepsionis.dashboard') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Dashboard</span>
                    </a>
                    <a href="{{ route('resepsionis.pasien.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('resepsionis.pasien.index') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Manajemen Pasien</span>
                    </a>
                    <a href="{{ route('resepsionis.pasien.create') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('resepsionis.pasien.create') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Pendaftaran Pasien</span>
                    </a>
                    <a href="{{ route('resepsionis.antrian.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('resepsionis.antrian.index') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Kelola Antrian</span>
                    </a>
                    <a href="{{ route('resepsionis.jadwal.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('resepsionis.jadwal.index') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Informasi Jadwal Dokter</span>
                    </a>
                @endcan

                {{-- =================== MENU DOKTER =================== --}}
                @can('is-dokter')
                    <a href="{{ route('dokter.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('dokter.dashboard') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold' : '' }}">
                        <span class="mx-4">Dashboard</span>
                    </a>
                    <a href="{{ route('dokter.jadwal-praktik.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('dokter.jadwal-praktik.index') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold text-blue-700' : '' }}">
                        <span class="mx-4">Jadwal Praktik Saya</span>
                    </a>
                @endcan
            </nav>
            <div class="absolute bottom-0 w-64">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center px-6 py-4 text-red-600 hover:bg-red-50">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="mx-4 font-semibold">Logout</span>
                    </a>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
             <header class="flex justify-between items-center p-4 bg-white border-b">
                <div class="flex items-center">
                    <button @click="open = !open" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <h2 class="text-2xl font-semibold text-gray-800 ml-4">Dashboard</h2>
                </div>

                <div class="flex items-center">
                    <span class="font-semibold mr-2">{{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 bg-blue-500 text-white flex items-center justify-center rounded-full font-bold">
                        {{-- Inisial Nama --}}
                        @php
                            $nameParts = explode(' ', Auth::user()->name);
                            $initials = count($nameParts) > 1
                                ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                                : strtoupper(substr($nameParts[0], 0, 2));
                        @endphp
                        {{ $initials }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>