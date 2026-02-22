<x-client-layout>
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-2xl font-black text-slate-900">Halo, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-slate-500 font-medium text-sm">Bagaimana perasaanmu hari ini?</p>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-slate-900 rounded-xl p-8 text-white relative overflow-hidden shadow-2xl shadow-slate-200">
                <div class="relative z-10">
                    <span class="text-[10px] uppercase tracking-[0.2em] font-black opacity-60">Sesi
                        Terdekat</span>
                    @if ($upcomingBooking)
                        <h2 class="text-2xl font-bold  mt-2">Konsultasi dengan
                            {{ $upcomingBooking->psycholog->fullname }}</h2>
                        <div class="flex flex-wrap gap-4 mt-6">
                            <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl flex items-center gap-2">
                                <i class="far fa-calendar"></i>
                                <span
                                    class="text-sm font-medium">{{ \Carbon\Carbon::parse($upcomingBooking->session_date)->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl flex items-center gap-2">
                                <i class="far fa-clock"></i>
                                <span class="text-sm font-medium">{{ $upcomingBooking->start_time }} WIB</span>
                            </div>
                        </div>
                        <a href="{{ route('client.sessions.show', $upcomingBooking->code) }}"
                            class="mt-8 bg-brand-600 mt-3 inline-block text-slate-100 font-black px-3 py-2 rounded-2xl hover:scale-105 transition-all text-sm">
                            Mulai Sesi Sekarang
                        </a>
                    @else
                        <p class="mt-4 text-white/60">Belum ada jadwal sesi yang terkonfirmasi.</p>
                        <a href="{{route('list.psychologs')}}"
                            class="mt-6 inline-block bg-white text-slate-900 font-black px-6 py-3 rounded-xl text-xs uppercase tracking-wider">Cari
                            Psikolog</a>
                    @endif
                </div>
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-brand/20 rounded-full blur-3xl"></div>
            </div>

            <div class="bg-white rounded-xl p-8 border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-black text-slate-900 text-lg">Aktivitas Terakhir</h3>
                    <a href="{{ route('client.history') }}" class="text-xs font-bold text-brand uppercase tracking-widest">Lihat
                        Semua</a>
                </div>
                <div class="space-y-4">
                    @forelse($recentBookings as $item)
                        <div
                            class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-2xl transition-all border border-transparent hover:border-slate-100">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                                    <i class="fas fa-notes-medical"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-sm italic">
                                        {{ $item->psycholog->name }}</h4>
                                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-tighter">
                                        {{ $item->code }} • {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $item->getStatusColor() }}">
                                    {{ $item->status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-400 text-sm py-10">Belum ada riwayat booking.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-emerald-500 rounded-xl p-6 text-white">
                <i class="fas fa-quote-left text-3xl opacity-20 mb-4 block"></i>
                <p class="font-medium italic leading-relaxed">"Kesehatan mental bukanlah tujuan, melainkan
                    sebuah proses. Yang penting adalah bagaimana kamu menjalaninya."</p>
            </div>

            <div class="bg-white rounded-xl p-6 border border-slate-100 shadow-sm">
                <h4 class="font-black text-slate-900 mb-4">Butuh Pembayaran</h4>
                <div class="space-y-3">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menunggu
                            Pembayaran</p>
                        @foreach ($unpaidBookings as $item)
                            <div class="flex justify-between items-center mt-2">
                                <span class="font-bold text-slate-800 text-sm italic">Sesi Konseling
                                    #{{ $item->code }}</span>
                                <a href="{{ route('bookings.checkout', $item->code) }}"
                                    class="text-brand font-black text-xs">Bayar <i
                                        class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
