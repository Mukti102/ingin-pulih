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

    <div class="pt-4 mt-4 border-t border-slate-50 lg:hidden">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 p-3 text-red-400 font-medium hover:bg-red-50 rounded-xl transition-all">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</nav>