<x-guest-layout>
    <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('img/logo-klinik.png') }}" alt="Logo Klinik An-Nur" class="h-20 mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Login Klinik An-Nur</h2>
        <p class="text-gray-600">Masuk Untuk Melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Username/Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>
        <div class="flex items-center justify-center mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>