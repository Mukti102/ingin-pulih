<x-guest-layout>
    <div class="py-12 md:py-24 bg-[#F8FAFC] min-h-screen flex items-center justify-center px-4">
        <div class="max-w-lg w-full text-center">
            
            <div class="mb-8 relative inline-block">
                <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center mx-auto animate-bounce duration-1000">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-6 h-6 bg-brand rounded-full animate-ping opacity-75"></div>
            </div>

            <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-3">Pembayaran Berhasil!</h1>
            <p class="text-slate-500 font-medium mb-10">Jadwal konsultasi Anda telah berhasil diamankan. Kami telah mengirimkan detail konfirmasi ke email Anda.</p>

            <div class="bg-white rounded-[32px] p-8 shadow-sm border border-slate-100 mb-8 text-left">
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-50">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kode Booking</span>
                        <span class="font-mono font-bold text-slate-800">{{ $booking->code }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-slate-50">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Psikolog</span>
                        <span class="font-bold text-slate-800">{{ $booking->psycholog->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Jadwal Sesi</span>
                        <div class="text-right">
                            <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($booking->session_date)->translatedFormat('d M Y') }}</p>
                            <p class="text-xs text-brand font-bold">{{ $booking->start_time }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('client.dashboard') }}" class="flex items-center justify-center gap-2 bg-slate-900 text-white font-bold py-4 rounded-2xl hover:bg-black transition-all shadow-lg active:scale-[0.98]">
                    <i class="fas fa-th-large text-sm"></i>
                    Buka Dashboard
                </a>
                <a href="#" class="flex items-center justify-center gap-2 bg-white text-slate-700 font-bold py-4 rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all active:scale-[0.98]">
                    <i class="fas fa-print text-sm"></i>
                    Download Invoice
                </a>
            </div>

            <p class="mt-10 text-xs text-slate-400">
                Laman ini akan dialihkan otomatis ke dashboard dalam <span id="countdown">15</span> detik.
            </p>
        </div>
    </div>

    @push('scripts')
    <script>
        let seconds = 15;
        const countdownEl = document.getElementById('countdown');
        
        setInterval(() => {
            seconds--;
            countdownEl.innerText = seconds;
            if (seconds <= 0) {
                window.location.href = "{{ route('dashboard') }}";
            }
        }, 1000);
    </script>
    @endpush
</x-guest-layout>