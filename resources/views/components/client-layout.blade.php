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

    <style>
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

<body class="antialiased">
    @include('partials.guest.navbar')
    <div class="flex min-h-screen bg-[#F8FAFC]">
        <x-sidebar-client />
        <main class="flex-1 p-4 md:p-10">
            {{ $slot }}
        </main>
    </div>
    @include('sweetalert::alert')
    @livewireScripts
</body>

</html>
