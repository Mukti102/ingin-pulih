<x-client-layout>
    <div class="space-y-10">
        <div>
            <h1 class="text-2xl font-black text-slate-900">Jadwal Sesi</h1>
            <p class="text-slate-500 text-sm font-medium">Kelola dan lihat jadwal konsultasi Anda di sini.</p>
        </div>

        <section>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-brand/10 text-brand rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h2 class="font-bold text-slate-800">Sesi Mendatang</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($upcomingSessions as $session)
                    <div
                        class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-4">
                                @if ($session->psycholog->user->avatar)
                                    <img src="{{ Storage::url($session->psycholog->user->avatar) }}" alt="Avatar"
                                        class="w-12 h-12 rounded-2xl object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ $session->psycholog->fullname }}"
                                        class="w-12 h-12 rounded-2xl" alt="">
                                @endif

                                <div>
                                    <h3 class="font-bold text-slate-900 italic">{{ $session->psycholog->fullname }}</h3>
                                    <p class="text-[10px] font-black text-brand uppercase tracking-widest">
                                        {{ $session->meeting_type }}</p>
                                </div>
                            </div>
                            <span
                                class="px-3 py-1 {{ $session->getStatusColor() }} rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                {{ $session->status }}</span>
                            </span>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center gap-3 text-slate-600">
                                <i class="far fa-calendar-alt w-4 text-slate-400"></i>
                                <span
                                    class="text-sm font-medium">{{ \Carbon\Carbon::parse($session->session_date)->translatedFormat('l, d M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-600">
                                <i class="far fa-clock w-4 text-slate-400"></i>
                                <span class="text-sm font-medium">{{ $session->start_time }} - {{ $session->end_time }}
                                    WIB</span>
                            </div>
                        </div>

                        @if ($session->meeting_type == 'online')
                            <a href="{{ route('client.sessions.show', $session->code) }}"
                                class="w-full inline bg-slate-900 text-white font-bold py-3 rounded-xl hover:bg-black transition-all flex items-center justify-center gap-2 text-sm">
                                <i class="fas fa-video"></i>
                                Masuk Ruang Sesi
                            </a>
                        @else
                            <a href="{{ route('client.sessions.show', $session->code) }}"
                                class="w-full inline bg-slate-900 text-white font-bold py-3 rounded-xl hover:bg-black transition-all flex items-center justify-center gap-2 text-sm">
                                Sesi Tatap Muka
                            </a>
                        @endif
                    </div>
                @empty
                    <div
                        class="col-span-full py-12 bg-white rounded-[2rem] border border-dashed border-slate-200 text-center">
                        <p class="text-slate-400 text-sm">Belum ada sesi mendatang. <a href="/"
                                class="text-brand font-bold underline">Cari psikolog?</a></p>
                    </div>
                @endforelse
            </div>
        </section>

    </div>
</x-client-layout>
