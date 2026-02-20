<x-client-layout>
    <div class="space-y-10">
        <div>
            <h1 class="text-2xl font-black text-slate-900">Riwayat Konsultasi</h1>
            <p class="text-slate-500 text-sm font-medium">Kelola dan lihat Riwayat konsultasi Anda di sini.</p>
        </div>

        <section>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-slate-100 text-slate-400 rounded-lg flex items-center justify-center text-sm">
                    <i class="fas fa-history"></i>
                </div>
                <h2 class="font-bold text-slate-800">Riwayat Konsultasi</h2>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Psikolog
                            </th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($historySessions as $history)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="p-6">
                                    <span
                                        class="font-bold text-slate-800 text-sm italic">{{ $history->psycholog->fullname }}</span>
                                </td>
                                <td class="p-6">
                                    <span
                                        class="text-sm text-slate-500 font-medium">{{ \Carbon\Carbon::parse($history->session_date)->format('d/m/Y') }}</span>
                                </td>
                                <td class="p-6">
                                    <span
                                        class="px-2 py-1 rounded-md text-[9px] font-black uppercase tracking-tighter {{ $history->getStatusColor() }}">
                                        {{ $history->status }}
                                    </span>
                                </td>
                                <td class="p-6 text-right">
                                    <a href="{{ route('client.sessions.show', $history->code) }}"
                                        class="text-brand font-black text-[10px] uppercase tracking-widest hover:underline">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6 border-t border-slate-50">
                    {{ $historySessions->links() }}
                </div>
            </div>
        </section>
    </div>
</x-client-layout>
