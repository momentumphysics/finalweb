<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik An-Nur</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <aside class="w-64 bg-white flex-shrink-0 shadow-lg">
            <div class="p-6 text-center border-b">
                <a href="#" class="text-xl font-bold text-blue-600">
                    <img src="https://i.imgur.com/83o6I5i.png" alt="Logo Klinik An-Nur" class="h-8 mx-auto mb-2">
                    KLINIK AN-NUR
                </a>
            </div>
            <nav class="mt-6">
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('dokter.dashboard') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold' : '' }}">
                    <span class="mx-4">Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('dokter.rekam-medis.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold' : '' }}">
                    <span class="mx-4">Rekam Medis</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('dokter.jadwal.*') ? 'bg-blue-100 border-l-4 border-blue-500 font-semibold' : '' }}">
                    <span class="mx-4">Jadwal Praktik Saya</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700">
                    <span class="mx-4">Logout</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-4 bg-white border-b">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $header }}</h2>
                </div>
                <div class="text-right">
                    <p class="font-semibold">{{ Auth::user()->name ?? 'Dokter, Nur Faiqatunnisa AL' }}</p>
                    <p class="text-sm text-gray-500">Poli Gigi</p>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>