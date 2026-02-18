<x-client-layout>
    <div class="max-w-4xl mx-auto space-y-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('client.sessions') }}" class="text-slate-400 hover:text-brand transition-colors">Jadwal
                Sesi</a>
            <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
            <span class="text-slate-900 font-bold">Detail Sesi #{{ $booking->code }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                    <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <img src="https://ui-avatars.com/api/?name={{ $booking->psycholog->fullname }}&background=random"
                                class="w-16 h-16 rounded-2xl shadow-sm" alt="">
                            <div>
                                <h2 class="text-xl font-black text-slate-900 italic">{{ $booking->psycholog->fullname }}
                                </h2>
                                <p class="text-xs font-bold text-brand uppercase tracking-widest">
                                    {{ $booking->meeting_type }} Session</p>
                            </div>
                        </div>
                        <span
                            class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest 
                            {{ $booking->status == 'paid' || $booking->status == 'complete' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                            {{ $booking->status }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-6 p-6 bg-slate-50 rounded-[2rem] border border-slate-100 mb-8">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal</p>
                            <p class="text-sm font-bold text-slate-800">
                                {{ \Carbon\Carbon::parse($booking->session_date)->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Waktu</p>
                            <p class="text-sm font-bold text-slate-800">{{ $booking->start_time }} -
                                {{ $booking->end_time }} WIB</p>
                        </div>
                    </div>

                    @if ($booking->meeting_type)
                        <div class="space-y-4">
                            <h4 class="font-bold text-slate-900 flex items-center gap-2">
                                <i class="fas fa-video text-brand"></i> Link Pertemuan
                            </h4>
                            @if ($booking->payment_status == 'paid' || $booking->status == 'confirmed')
                                @if ($booking->sessionMeet && $booking->sessionMeet->room)
                                    <div
                                        class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                                        <div class="flex-1 truncate">
                                            <p
                                                class="text-[10px] font-bold text-emerald-600 uppercase tracking-tighter">
                                                {{ $booking->sessionMeet->room->provider }}</p>
                                            <p class="text-sm font-medium text-slate-700 truncate">
                                                {{ $booking->sessionMeet->room->link_zoom }}</p>
                                        </div>
                                        <a href="{{ $booking->sessionMeet->room->link_zoom }}" target="_blank"
                                            class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-xl text-xs font-bold transition-all">
                                            Join Now
                                        </a>
                                    </div>
                                @else
                                    <div class="p-4 bg-slate-100 rounded-2xl text-center">
                                        <p class="text-xs text-slate-500 font-medium italic">Link pertemuan sedang
                                            disiapkan oleh admin/psikolog.</p>
                                    </div>
                                @endif
                            @else
                                <div class="p-4 bg-amber-50 border border-amber-100 rounded-2xl text-center">
                                    <p class="text-xs text-amber-600 font-bold uppercase tracking-wide">Selesaikan
                                        pembayaran untuk melihat link meeting.</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-file-alt text-slate-400"></i> Detail Keluhan
                    </h4>
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi
                                Masalah</p>
                            <div
                                class="p-4 bg-slate-50 rounded-2xl text-sm text-slate-600 leading-relaxed italic border border-slate-100">
                                "{{ $booking->problem_description }}"
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Harapan dari
                                Sesi</p>
                            <div
                                class="p-4 bg-slate-50 rounded-2xl text-sm text-slate-600 leading-relaxed italic border border-slate-100">
                                "{{ $booking->expectations }}"
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-[1rem] p-6 border border-slate-100 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-4 text-sm">Topik Fokus</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($topicNames as $topic)
                            <span
                                class="px-3 py-1 bg-cyan-100 text-cyan-600 rounded-lg text-[10px] font-bold uppercase tracking-tighter">
                                {{ $topic }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="bg-amber-50 rounded-[1rem] p-6 border border-amber-100">
                    <div class="flex gap-3">
                        <i class="fas fa-user-shield text-amber-500 mt-1"></i>
                        <div>
                            <h5 class="text-xs font-bold text-amber-800 uppercase tracking-wide mb-1">Privasi Sesi</h5>
                            <p class="text-[10px] text-amber-600 leading-relaxed font-medium">Catatan diagnosa dan
                                observasi psikolog bersifat rahasia dan tidak ditampilkan kepada klien sesuai kebijakan
                                privasi medis.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-900 rounded-[1rem] text-white">
                    <p class="text-xs font-bold mb-3">Butuh Bantuan?</p>
                    <p class="text-[10px] text-white/60 mb-4 leading-relaxed">Jika ada masalah dengan link pertemuan
                        atau ingin reschedule, silakan hubungi psikolog via WhatsApp.</p>
                    <a href="#"
                        class="block w-full text-center bg-white text-slate-900 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-brand transition-all">Hubungi Psikolog</a>
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
