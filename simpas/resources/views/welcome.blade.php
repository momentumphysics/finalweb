<x-guest-layout>
    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex flex-col items-center mb-6">
        {{-- Logo --}}
        <img src="https://i.imgur.com/83o6I5i.png" alt="Logo Klinik An-Nur" class="h-16 mb-4">

        {{-- Titles --}}
        <h2 class="text-2xl font-bold text-gray-800">
            Login Klinik An-Nur
        </h2>
        <p class="text-gray-600">
            Masuk Untuk Melanjutkan
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Username/Email Input --}}
        <div>
            <x-input-label for="email" :value="__('Username/Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password Input --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Login Button --}}
        <div class="flex items-center justify-center mt-6">
            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Login') }}
            </button>
        </div>
    </form>
</x-guest-layout>