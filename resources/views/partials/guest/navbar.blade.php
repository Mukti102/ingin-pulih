{{-- Tambahkan CSS ini di header atau file CSS kamu --}}
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<nav x-data="{ open: false }" class="bg-white border-b border-brand-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-2">
                    @if (get_setting('app_logo'))
                        <img src="{{ Storage::url(get_setting('app_logo')) }}" alt="Logo"
                            class=" w-20 rounded-xl object-cover">
                    @else
                        <div
                            class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center shadow-lg shadow-brand-200">
                            <i class="fas fa-brain text-white"></i>
                        </div>
                    @endif
                    {{-- <span
                        class="text-2xl font-bold bg-gradient-to-r from-brand-700 to-indigo-600 bg-clip-text text-transparent">
                        {{ get_setting('app_name', 'InginPulih') }}
                    </span> --}}
                </a>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="/"
                    class="text-gray-600 hover:text-brand-600 font-medium transition-all hover:scale-110">Beranda</a>
                <a href="#tentang"
                    class="text-gray-600 hover:text-brand-600 font-medium transition-all hover:scale-110">Tentang</a>
                <a href="#"
                    class="text-gray-600 hover:text-brand-600 font-medium transition-all hover:scale-110">Article</a>
                <a href="{{ route('list.psychologs') }}"
                    class="text-gray-600 hover:text-brand-600 font-medium transition-all hover:scale-110">Psikolog</a>

                <div class="h-6 w-px bg-gray-200 mx-2"></div>

                @auth
                    <div x-data="{ profileOpen: false }" class="relative ml-3">
                        <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" type="button"
                            class="flex items-center gap-3 focus:outline-none group">
                            <div class="text-right hidden lg:block">
                                <p class="text-xs font-bold text-gray-800 leading-none uppercase">{{ auth()->user()->name }}
                                </p>
                                <p class="text-[10px] text-brand-500 font-semibold">User Client</p>
                            </div>
                            <div
                                class="h-10 w-10 rounded-full border-2 border-brand-500 p-0.5 group-hover:border-orange-500 transition-all">
                                <img class="h-full w-full rounded-full object-cover"
                                    src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF' }}">
                            </div>
                        </button>

                        {{-- Menu Dropdown Desktop --}}
                        <div x-show="profileOpen" x-cloak x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 z-50 mt-2 w-48 rounded-2xl bg-white border border-brand-100 py-2 shadow-xl">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-50 hover:text-brand-600">Profil
                                Saya</a>
                            <a href="{{ route('client.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-50 hover:text-brand-600">Dashboard</a>
                            <hr class="my-2 border-brand-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 rounded-full text-white bg-brand-600 hover:bg-brand-700 font-semibold shadow-md">Masuk</a>
                @endauth
            </div>

            {{-- Hamburger Button --}}
            <div class="md:hidden flex items-center">
                <button @click="open = !open" type="button" class="text-brand-600 p-2 focus:outline-none">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        class="md:hidden bg-white border-t border-brand-50 shadow-inner">

        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="/"
                class="block px-3 py-3 text-base font-semibold text-gray-700 hover:bg-brand-50 rounded-xl">Beranda</a>
            <a href="#tentang"
                class="block px-3 py-3 text-base font-semibold text-gray-700 hover:bg-brand-50 rounded-xl">Tentang
                Kami</a>
            <a href="/psikolog"
                class="block px-3 py-3 text-base font-semibold text-gray-700 hover:bg-brand-50 rounded-xl">List
                Psikolog</a>

            <div class="pt-4 border-t border-gray-100 mt-4">
                @auth
                    <div class="flex items-center px-3 mb-4">
                        <img class="h-10 w-10 rounded-full border-2 border-brand-500"
                            src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}">
                        <div class="ml-3">
                            <div class="text-base font-bold text-gray-800">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-gray-600 font-medium">Profil
                            Saya</a>
                        <a href="{{ route('client.dashboard') }}"
                            class="block px-3 py-2 text-gray-600 font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-3 py-2 text-red-600 font-medium">Keluar</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full text-center py-3 text-white bg-brand-600 rounded-2xl font-bold shadow-lg shadow-brand-100">
                        Masuk Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
