<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Workspace | {{ config('app.name', 'MindEase') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; }
            .workspace-gradient { background: radial-gradient(circle at top right, #f0f9ff 0%, #ffffff 40%); }
            /* Hide scrollbar for Chrome, Safari and Opera */
            .no-scrollbar::-webkit-scrollbar { display: none; }
            /* Hide scrollbar for IE, Edge and Firefox */
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
    </head>
    <body class="bg-white text-slate-800 antialiased workspace-gradient overflow-hidden">
        
        <div class="flex h-screen overflow-hidden relative" x-data="{ sidebarOpen: false }">
            
            <div 
                x-show="sidebarOpen" 
                class="fixed inset-0 z-40 bg-slate-900/20 backdrop-blur-sm lg:hidden transition-opacity"
                @click="sidebarOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
            </div>

            <aside 
                class="fixed inset-y-0 left-0 z-50 w-64 border-r border-slate-100 flex flex-col bg-white/80 backdrop-blur-xl transform transition-transform duration-300 lg:relative lg:translate-x-0"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
                
                <div class="p-6 mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-6 bg-sky-500 rounded-full"></div>
                        <span class="font-bold text-lg tracking-tight">Workspace</span>
                    </div>
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar">
                    <a href="#" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl bg-slate-900 text-white font-medium transition-all shadow-lg shadow-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Ringkasan
                    </a>
                    <a href="#" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Jadwal Sesi
                    </a>
                    <a href="#" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Daftar Klien
                    </a>
                    <div class="h-px bg-slate-100 my-4 mx-3"></div>
                    <a href="#" class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-400 hover:text-slate-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Pengaturan
                    </a>
                </nav>

                <div class="p-4">
                    <div class="bg-sky-50 rounded-2xl p-4 flex items-center gap-3 border border-sky-100">
                        <div class="w-8 h-8 rounded-full bg-sky-500 flex-shrink-0 border-2 border-white shadow-sm"></div>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-sky-900 truncate">Dr. Aris S.</p>
                            <p class="text-[10px] text-sky-600 uppercase tracking-tighter">Pro Plan</p>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="flex-1 flex flex-col overflow-y-auto no-scrollbar bg-white/40">
                
                <header class="h-14 lg:h-16 px-4 lg:px-8 flex items-center justify-between border-b border-slate-50 bg-white/50 backdrop-blur-md sticky top-0 z-30">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-slate-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div class="hidden sm:flex items-center gap-2 text-[10px] lg:text-xs text-slate-400 uppercase tracking-widest font-bold">
                            <span>Workspace</span>
                            <span class="text-slate-300">/</span>
                            <span class="text-slate-900">Ringkasan</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 lg:gap-4">
                        <button class="bg-sky-500 hover:bg-sky-600 text-white px-4 lg:px-6 py-2 rounded-full text-xs font-bold transition shadow-lg shadow-sky-100">
                            + Sesi Baru
                        </button>
                    </div>
                </header>

                <div class="p-6 lg:p-12 max-w-5xl w-full mx-auto">
                    <header class="mb-8 lg:mb-12">
                        <h1 class="text-2xl lg:text-4xl font-bold text-slate-900 tracking-tight mb-2">Fokus Hari Ini</h1>
                        <p class="text-slate-500 text-sm lg:text-base font-light italic">"Listen to understand, not to respond."</p>
                    </header>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                        
                        <div class="space-y-8 lg:space-y-12">
                            <section>
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Sesi Berjalan</h3>
                                    <span class="flex items-center gap-2 text-[10px] font-bold text-emerald-500 uppercase tracking-widest">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></span> Live
                                    </span>
                                </div>
                                
                                <div class="relative p-6 lg:p-8 rounded-[2rem] bg-white border border-slate-100 shadow-2xl shadow-slate-200/40 group overflow-hidden">
                                    <div class="flex items-start gap-5 mb-8">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-xl font-bold text-slate-300 border border-slate-100 shadow-inner">SJ</div>
                                        <div class="min-w-0">
                                            <h4 class="text-xl font-bold text-slate-900 truncate">Sarah Johnson</h4>
                                            <p class="text-slate-400 text-sm mt-0.5">Depresi & Kecemasan • Sesi 4</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <button class="flex-1 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-slate-200">
                                            Buka Ruang Virtual
                                        </button>
                                        <button class="h-12 w-full sm:w-12 flex items-center justify-center border border-slate-100 rounded-2xl hover:bg-slate-50 transition active:scale-95">
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-6">Antrian Berikutnya</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-5 rounded-2xl bg-white/50 border border-transparent hover:border-slate-100 hover:bg-white hover:shadow-sm transition-all cursor-pointer group">
                                        <div class="flex items-center gap-5">
                                            <span class="text-xs font-bold text-sky-500 bg-sky-50 w-12 py-1 text-center rounded-lg">14:00</span>
                                            <p class="font-bold text-slate-700 group-hover:text-slate-900 transition-colors text-sm lg:text-base">Dimas Anggara</p>
                                        </div>
                                        <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                    <div class="flex items-center justify-between p-5 rounded-2xl bg-white/50 border border-transparent hover:border-slate-100 hover:bg-white hover:shadow-sm transition-all cursor-pointer group text-sm lg:text-base">
                                        <div class="flex items-center gap-5">
                                            <span class="text-xs font-bold text-slate-400 bg-slate-50 w-12 py-1 text-center rounded-lg">15:30</span>
                                            <p class="font-bold text-slate-700 group-hover:text-slate-900 transition-colors">Rina Kartika</p>
                                        </div>
                                        <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="space-y-8">
                            <div class="bg-slate-900/5 rounded-[2.5rem] p-8 lg:p-10 border border-white/20 backdrop-blur-sm relative overflow-hidden">
                                <div class="absolute -top-10 -right-10 w-40 h-40 bg-sky-200/20 rounded-full blur-3xl"></div>
                                <h3 class="text-sm font-bold text-slate-900 mb-8 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sky-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11 5h2v14h-2zM4 11h2v2H4zM18 11h2v2h-2z"/></svg>
                                    Catatan Klinis
                                </h3>
                                <div class="space-y-6 text-sm lg:text-base text-slate-600 leading-relaxed font-light italic">
                                    <p class="pl-4 border-l-2 border-sky-200">Ingat untuk menanyakan progres latihan pernapasan Sarah di sesi ini.</p>
                                    <p class="pl-4 border-l-2 border-slate-200">Review hasil tes psikometri Dimas sebelum sesi dimulai pukul 14:00.</p>
                                </div>
                                
                                <div class="mt-12 lg:mt-20">
                                    <div class="flex justify-between items-end mb-4">
                                        <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kapasitas Kerja</h3>
                                        <span class="text-xs font-bold text-slate-900">70%</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden shadow-inner">
                                        <div class="w-[70%] h-full bg-slate-900 rounded-full transition-all duration-1000"></div>
                                    </div>
                                    <p class="text-[10px] mt-4 text-slate-400 font-medium tracking-tight uppercase">4 dari 6 slot terisi hari ini</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>
{{-- Dashboard
Jadwal Praktik
   ├── Layanan
   └── Jadwal Mingguan
Booking Masuk
Riwayat Sesi
Profil Saya
Pengaturan --}}