<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-serif text-gray-900 antialiased bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200">

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            {{-- Remove duplicate logo here if it's already in your child view --}}
            {{-- <div>
                <a href="/">
                    <img src="{{ asset('images/ptmsilogo.jpg') }}" alt="Logo" class="w-20 h-20 rounded-full shadow-md">
                </a>
            </div> --}}

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 mb-4 bg-white/80 shadow-xl overflow-hidden rounded-3xl backdrop-blur-md">
                {{ $slot }}
            </div>
        </div>

    </body>
</html>
