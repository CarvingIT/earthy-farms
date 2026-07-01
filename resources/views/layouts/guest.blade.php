<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ECSPL Farms') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-neutral-900 antialiased bg-[#fafaf9] min-h-screen flex items-center justify-center p-4">
        <div class="w-full sm:max-w-md bg-white border border-neutral-200/50 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.015)] p-8">
            <div class="flex flex-col items-center justify-center mb-8 text-center">
                <a href="/" class="flex flex-col items-center">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm shadow-emerald-600/25 mb-3 hover:scale-105 transition-transform duration-250">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l-.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <span class="text-xl font-bold tracking-tight text-neutral-900">ECSPL <span class="text-emerald-600 font-semibold">Farms</span></span>
                </a>
                <p class="text-xs text-neutral-400 mt-1.5">Management portal for your agricultural network</p>
            </div>

            {{ $slot }}
        </div>
    </body>
</html>
