<aside class="w-64 bg-white border-r border-slate-100 hidden lg:block">
    <div class="p-6">
        <nav class="space-y-2">
            <a href="{{ route('client.dashboard') }}" 
               class="flex items-center gap-3 p-3 rounded-xl font-bold transition-all {{ request()->routeIs('client.dashboard') ? 'bg-brand/10 text-brand' : 'text-slate-400 hover:bg-slate-50 font-medium' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <a href="{{ route('client.sessions') }}" 
               class="flex items-center gap-3 p-3 rounded-xl font-bold transition-all {{ request()->routeIs('client.sessions') ? 'bg-brand/10 text-brand' : 'text-slate-400 hover:bg-slate-50 font-medium' }}">
                <i class="fas fa-calendar-alt"></i> Jadwal Sesi
            </a>

            <a href="{{ route('client.history') }}" 
               class="flex items-center gap-3 p-3 rounded-xl font-bold transition-all {{ request()->routeIs('client.history') ? 'bg-brand/10 text-brand' : 'text-slate-400 hover:bg-slate-50 font-medium' }}">
                <i class="fas fa-history"></i> Riwayat
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="flex items-center gap-3 p-3 rounded-xl font-bold transition-all {{ request()->routeIs('profile.edit') ? 'bg-brand/10 text-brand' : 'text-slate-400 hover:bg-slate-50 font-medium' }}">
                <i class="fas fa-user-cog"></i> Profil
            </a>
        </nav>
    </div>
</aside>