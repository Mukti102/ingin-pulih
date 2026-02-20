<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ get_setting('app_name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ Storage::url(get_setting('app_logo')) }}" type="image/x-icon" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        [v-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFCFE] antialiased overflow-x-hidden">
    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-brand-100/50 blur-[100px]"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[30%] h-[30%] rounded-full bg-amber-50/50 blur-[100px]"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center p-4">

        <div class="mb-5 text-center">
            <a href="/" class="inline-flex flex-col items-center">

                @if (get_setting('app_logo'))
                    <img src="{{ Storage::url(get_setting('app_logo')) }}" alt="Logo"
                        class="w-28 rounded-xl object-cover mb-3">
                @else
                    <div
                        class="w-14 h-14 bg-brand-600 rounded-2xl flex items-center justify-center shadow-lg shadow-brand-200 mb-3 rotate-3 hover:rotate-0 transition-transform duration-300">
                        <i class="fas fa-brain text-white text-2xl"></i>
                    </div>
                @endif
            </a>
        </div>

        <div
            class="w-full min-w-xl max-w-xl bg-white rounded-[2rem] shadow-xl shadow-brand-100/50 border border-gray-100 overflow-hidden relative">
            <div class="h-1.5 w-full bg-gradient-to-r from-brand-500 to-brand-400"></div>

            <div class="p-8 md:p-10">
                {{ $slot }}
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-400 text-xs">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Dirancang untuk kesehatan mental Anda.
            </p>
        </div>
    </div>

    @livewireScripts
</body>

</html>
