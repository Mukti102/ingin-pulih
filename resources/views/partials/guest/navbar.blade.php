{{-- navbar --}}
<nav class="bg-white border-b border-brand-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <div
                        class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center shadow-lg shadow-brand-200">
                        <i class="fas fa-brain text-white"></i>
                    </div>
                    <span
                        class="text-2xl font-bold bg-gradient-to-r from-brand-700 to-indigo-600 bg-clip-text text-transparent">
                        InginPulih
                    </span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/"
                    class="inline-block text-gray-600 hover:text-brand-600 font-medium transform transition-all duration-300 ease-in-out hover:scale-110">
                    Beranda
                </a>
                <a href="#tentang"
                    class="inline-block text-gray-600 hover:text-brand-600 font-medium transform transition-all duration-300 ease-in-out hover:scale-110">Tentang
                    Kami</a>
                <a href="#tentang"
                    class="inline-block text-gray-600 hover:text-brand-600 font-medium transform transition-all duration-300 ease-in-out hover:scale-110">Article</a>
                <a href="{{route('list.psychologs')}}"
                    class="inline-block text-gray-600 hover:text-brand-600 font-medium transform transition-all duration-300 ease-in-out hover:scale-110">List
                    Psikolog</a>

                <div class="h-6 w-px bg-gray-200 mx-2"></div>

                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all shadow-md shadow-brand-100">
                    Masuk
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button type="button" class="text-brand-600 hover:text-brand-700 p-2" id="mobile-menu-button">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="md:hidden hidden bg-white border-t border-brand-50" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/"
                class="block px-3 py-2 text-base font-semibold  text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-md">Beranda111</a>
            <a href="#tentang"
                class="block px-3 py-2 text-base font-semibold  text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-md">Tentang
                Kami</a>
            <a href="/psikolog"
                class="block px-3 py-2 text-base font-semibold  text-gray-700 hover:bg-brand-50 hover:text-brand-600 rounded-md">List
                Psikolog</a>
            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-semibold text-brand-600">Masuk</a>
        </div>
    </div>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

<script>
    // Script sederhana untuk toggle mobile menu
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
