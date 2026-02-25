<div class="sidebar" data-background-color="dark2">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark2">
            <a href="{{ route('dashboard') }}" class="logo">
                @if (get_setting('app_logo'))
                    <img src="{{ Storage::url(get_setting('app_logo')) }}" alt="Logo" class="navbar-brand"
                        height="60">
                @else
                    <img src="/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                        height="20" />
                @endif
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <li class="nav-item {{ isActive(['dashboard', 'dashboard.psycholog']) }}">
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    @else
                        <a href="{{ route('dashboard.psycholog') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    @endif
                </li>

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Manajemen Data</h4>
                    </li>

                    <li class="nav-item {{ isActives(['users.*', 'psychologs.*']) }}">
                        <a data-bs-toggle="collapse" href="#userMgmt">
                            <i class="fas fa-users"></i>
                            <p>User Management</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ isShow(['users.*', 'psychologs.*']) }}" id="userMgmt">
                            <ul class="nav nav-collapse">
                                <li class="{{ isActive('users.*') }}"><a href="{{ route('users.index') }}"><span
                                            class="sub-item">Daftar Users</span></a></li>
                                <li class="{{ isActive('psychologs.*') }}"><a
                                        href="{{ route('psychologs.index') }}"><span class="sub-item">Daftar
                                            Psikolog</span></a></li>
                            </ul>
                        </div>
                    </li>

                    <li
                        class="nav-item {{ isActives(['wilayah-praktik.*', 'jenis-psikolog.*', 'topik-keahlian.*', 'services.*']) }}">
                        <a data-bs-toggle="collapse" href="#masterData">
                            <i class="fas fa-boxes"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ isShow(['wilayah-praktik.*', 'jenis-psikolog.*', 'topik-keahlian.*', 'services.*']) }}"
                            id="masterData">
                            <ul class="nav nav-collapse">
                                <li class="{{ isActive('wilayah-praktik.*') }}"><a
                                        href="{{ route('wilayah-praktik.index') }}"><span
                                            class="sub-item">Wilayah</span></a></li>
                                <li class="{{ isActive('jenis-psikolog.*') }}"><a
                                        href="{{ route('jenis-psikolog.index') }}"><span class="sub-item">Jenis
                                            Psikolog</span></a></li>
                                <li class="{{ isActive('topik-keahlian.*') }}"><a
                                        href="{{ route('topik-keahlian.index') }}"><span class="sub-item">Topik
                                            Keahlian</span></a></li>
                                <li class="{{ isActive('services.*') }}"><a href="{{ route('services.index') }}"><span
                                            class="sub-item">Kategori Layanan</span></a></li>

                                <li class="{{ isActive('articles.*') }}"><a href="{{ route('articles.index') }}"><span
                                            class="sub-item">Artikel</span></a></li>

                            </ul>
                        </div>
                    </li>
                @endif

                @if (auth()->user()->hasRole('psycholog'))
                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Pengaturan Praktik</h4>
                    </li>
                    <li class="nav-item {{ isActives(['psycholog-services.*', 'psycholog-weekly-schedules.*']) }}">
                        <a data-bs-toggle="collapse" href="#schedules">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Jadwal & Tarif</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ isShow(['psycholog-services.*', 'psycholog-weekly-schedules.*']) }}"
                            id="schedules">
                            <ul class="nav nav-collapse">
                                <li class="{{ isActive('psycholog-services.*') }}"><a
                                        href="{{ route('psycholog-services.index') }}"><span class="sub-item">Atur
                                            Tarif</span></a></li>
                                <li class="{{ isActive('psycholog-weekly-schedules.*') }}"><a
                                        href="{{ route('psycholog-weekly-schedules.index') }}"><span
                                            class="sub-item">Jadwal Mingguan</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Operasional</h4>
                </li>
                <li class="nav-item {{ isActive('bookings.*') }}">
                    <a href="{{ route('bookings.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Daftar Booking</p>
                    </a>
                </li>

                @if (auth()->user()->isPsycholog())
                    <li class="nav-item {{ isActive('sessions.*') }}">
                        <a href="{{ route('sessions.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Sesi Konsultasi</p>
                        </a>
                @endif

                </li>
                <li class="nav-item {{ isActive('reviews.*') }}">
                    <a href="{{ route('reviews.index') }}">
                        <i class="fas fa-star"></i>
                        <p>Ulasan & Rating</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Keuangan</h4>
                </li>
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item {{ isActive('transactions.*') }}">
                        <a href="{{ route('transactions.index') }}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>Semua Transaksi</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ isActive('payouts.*') }}">
                    <a href="{{ route('payouts.index') }}">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>{{ auth()->user()->hasRole('admin') ? 'Kelola Pengajuan' : 'Pengajuan Tarik Saldo' }}</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Sistem</h4>
                </li>
                <li class="nav-item {{ isActive('profile.*') }}">
                    <a href="{{ route('profile.edit') }}">
                        <i class="fas fa-user-circle"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item {{ isActive('admin.settings.*') }}">
                        <a href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-cog"></i>
                            <p>Pengaturan Sistem</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
