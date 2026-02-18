<x-guest-layout>
    <div class="py-8 md:py-16 bg-[#F8FAFC] min-h-screen flex items-center justify-center">
        <div class="w-full max-w-2xl mx-auto px-4 sm:px-6">

            <div class="bg-white rounded-[24px] md:rounded-[32px] shadow-sm overflow-hidden border border-slate-100">

                <div class="relative p-6 md:p-8 pt-10 md:pt-12 text-center">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-brand to-emerald-500"></div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Checkout</h1>
                    <p class="mt-1 text-sm md:text-base text-slate-500 font-medium">Selesaikan pembayaran Anda</p>
                </div>

                <div class="px-6 md:px-8 pb-8 md:pb-10">
                    <div class="space-y-6 md:space-y-8">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                            <div class="p-4 md:p-5 bg-slate-50 rounded-2xl border border-slate-100 flex flex-col justify-center">
                                <span class="text-[9px] md:text-[10px] uppercase tracking-widest font-bold text-slate-400 block mb-1">Psikolog</span>
                                <h3 class="font-bold text-slate-800 text-sm md:text-base leading-tight">{{ $booking->psycholog->name }}</h3>
                                <p class="text-[10px] md:text-xs text-brand font-bold mt-1 uppercase">{{ $booking->meeting_type }} Session</p>
                            </div>

                            <div class="p-4 md:p-5 bg-slate-50 rounded-2xl border border-slate-100 flex flex-col justify-center">
                                <span class="text-[9px] md:text-[10px] uppercase tracking-widest font-bold text-slate-400 block mb-1">Waktu Sesi</span>
                                <h3 class="font-bold text-slate-800 text-sm md:text-base italic">
                                    {{ \Carbon\Carbon::parse($booking->session_date)->translatedFormat('d M Y') }}
                                </h3>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-1 tracking-tight">
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>

                        <div class="space-y-3 px-1">
                            <div class="flex justify-between items-center text-sm md:text-base">
                                <span class="text-slate-500">Biaya Konsultasi</span>
                                <span class="text-slate-800 font-semibold text-right">Rp {{ number_format($booking->earning, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xs md:text-sm">
                                <span class="text-slate-400">Biaya Layanan</span>
                                <span class="text-slate-800 font-medium text-right">Rp {{ number_format($booking->platform_fee, 0, ',', '.') }}</span>
                            </div>

                            <div class="pt-4 mt-2 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-3">
                                <div>
                                    <span class="block text-[10px] uppercase tracking-widest font-black text-slate-400">Total Tagihan</span>
                                    <span class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter leading-none">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="w-full sm:w-auto text-left sm:text-right">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-cyan-50 text-cyan-600 border border-cyan-100 whitespace-nowrap capitalize">
                                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 mr-2 animate-pulse"></span>
                                        {{ $booking->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button id="pay-button"
                                class="w-full bg-slate-900 hover:bg-black text-white font-bold py-4 md:py-5 rounded-2xl transition-all shadow-lg active:scale-[0.97] flex items-center justify-center gap-3 text-base md:text-lg">
                                <span>Bayar Sekarang</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                            <p class="text-center text-[10px] text-slate-400 mt-4 flex items-center justify-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                                Secure payment by Midtrans
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('detail.psikolog', encrypt($booking->psycholog->id)) }}"
                    class="text-xs font-semibold text-slate-400 hover:text-brand transition-colors uppercase tracking-wider">
                    Kembali & Ubah Jadwal
                </a>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // snapToken dikirim dari Controller/Livewire ke view ini
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* Redirect ke route success */
                    window.location.href = "{{ route('booking.success', $booking->code) }}";
                },
                onPending: function(result) {
                    window.location.reload();
                },
                onError: function(result) {
                    alert("Pembayaran gagal, silakan coba lagi.");
                },
                onClose: function() {
                    console.log('User closed the popup without finishing the payment');
                }
            });
        });
    </script>
</x-guest-layout>