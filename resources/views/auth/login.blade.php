<x-guest-layout>
    <!-- PTMSI Logo -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/ptmsilogo.jpg') }}" alt="PTMSI Logo" class="w-20 h-20 rounded-full shadow-lg">
    </div>

    <!-- Welcome Message -->
    <div class="text-center mb-8">
        <h2 class="text-4xl font-extrabold text-yellow-600">Welcome Back</h2>
        <p class="text-gray-700 text-base font-semibold mt-2">Log in to continue your journey with PTMSI</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-black font-semibold" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-white border border-gray-300 text-gray-800 rounded-md focus:border-yellow-400 focus:ring-yellow-300 shadow-sm"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-black font-semibold" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-white border border-gray-300 text-gray-800 rounded-md focus:border-yellow-400 focus:ring-yellow-300 shadow-sm"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-yellow-500 shadow-sm focus:ring-yellow-300"
                    name="remember">
                <span class="ml-2 text-sm text-gray-700">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-700 hover:underline" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <x-primary-button class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-6 py-2 rounded-xl shadow-md transition">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
