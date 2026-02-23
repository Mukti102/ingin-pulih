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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="icon" href="/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .flatpickr-day.selected {
            background: #7c3aed !important;
            border-color: #7c3aed !important;
        }

        .flatpickr-day.inRange {
            box-shadow: -5px 0 0 #f5f3ff, 5px 0 0 #f5f3ff !important;
            background: #f5f3ff !important;
        }
    </style>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased" x-data="{ mobileMenuOpen: false }">
    <div class="hidden lg:block sticky top-0">
        @include('partials.guest.navbar')
    </div>

    <div class="lg:hidden bg-white border-b border-slate-100 p-4 flex justify-between items-center">
        <a href="/" class="font-bold text-brand">
            <img src="{{ asset('storage/' . get_setting('app_logo')) }}" class="w-16 md:w-20 rounded-xl object-cover" alt="">
        </a>
        <button @click="mobileMenuOpen = true" class="p-2 text-slate-600 focus:outline-none">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </div>

    <div class="flex min-h-screen bg-[#F8FAFC]">
        <aside class="w-64 bg-white border-r border-slate-100 hidden lg:block min-h-screen p-6">
            <x-sidebar-client />
        </aside>

        <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-50 lg:hidden" aria-modal="true">

            <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
                class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"></div>

            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="relative flex w-full max-w-xs flex-1 flex-col bg-white pt-5 pb-4 shadow-xl min-h-screen">

                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button @click="mobileMenuOpen = false"
                        class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none ring-2 ring-white">
                        <i class="fas fa-times text-white text-xl"></i>
                    </button>
                </div>

                <div class="px-6 pb-4 border-b border-slate-50 mb-4">
                    <a href="/" class="text-xl font-bold text-brand">{{ get_setting('app_name') }}</a>
                </div>

                <div class="flex-1 px-4 overflow-y-auto">
                    <x-sidebar-client />
                </div>
            </div>
        </div>

        <main class="flex-1 p-4 md:p-10">
            {{ $slot }}
        </main>
    </div>

    @include('sweetalert::alert')
    @livewireScripts
</body>

</html>
