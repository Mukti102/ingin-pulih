<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ isactive('dashboard') }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">DATA MASTER</h4>
                </li>
                <li
                    class="nav-item {{ isActives(['wilayah-praktik.*', 'jenis-psikolog.*', 'topik-keahlian.*', 'services.*']) }}">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-boxes"></i>
                        <p>Data Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ isShow(['wilayah-praktik.*', 'jenis-psikolog.*', 'topik-keahlian.*', 'services.*']) }}"
                        id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ isActive('wilayah-praktik.*') }}">
                                <a href="{{ route('wilayah-praktik.index') }}">
                                    <span class="sub-item">Wilayah Praktik</span>
                                </a>
                            </li>
                            <li class="{{ isActive('jenis-psikolog.*') }}">
                                <a href="{{ route('jenis-psikolog.index') }}">
                                    <span class="sub-item">jenis Psikolog</span>
                                </a>
                            </li>
                            <li class="{{ isActive('topik-keahlian.*') }}">
                                <a href="{{ route('topik-keahlian.index') }}">
                                    <span class="sub-item">Topik Keahlian</span>
                                </a>
                            </li>
                            <li class="{{ isActive('services.*') }}">
                                <a href="{{ route('services.index') }}">
                                    <span class="sub-item">Layanan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ isActives(['users.*', 'psychologs.*']) }}">
                    <a data-bs-toggle="collapse" href="#base1">
                        <i class="fas fa-users"></i>
                        <p>User Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ isShow(['users.*', 'psychologs.*']) }}" id="base1">
                        <ul class="nav nav-collapse">
                            <li class="{{ isActive('users.*') }}">
                                <a href="{{ route('users.index') }}">
                                    <span class="sub-item">Users</span>
                                </a>
                            </li>
                            <li class="{{ isActive('psychologs.*') }}">
                                <a href="{{ route('psychologs.index') }}">
                                    <span class="sub-item">Psikolog</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ isActives(['psycholog-services.*', 'psycholog-weekly-schedules.*']) }}">
                    <a data-bs-toggle="collapse" href="#base3">
                        <i class="
fas fa-calendar-alt"></i>
                        <p>Jadwal Praktik</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ isShow(['psycholog-services.*', 'psycholog-weekly-schedules.*']) }}"
                        id="base3">
                        <ul class="nav nav-collapse">
                            <li class="{{ isActive('psycholog-services.*') }}">
                                <a href="{{ route('psycholog-services.index') }}">
                                    <span class="sub-item">Layanan</span>
                                </a>
                            </li>
                            <li class="{{ isActive('psycholog-weekly-schedules.*') }}">
                                <a href="{{ route('psycholog-weekly-schedules.index') }}">
                                    <span class="sub-item">Jadwal Mingguan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ isActive('bookings.*') }}">
                    <a href="{{ route('bookings.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Daftar Booking</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item {{ isActive('sessions.*') }}">
                    <a href="{{ route('sessions.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Daftar Sesi</p>
                        {{-- <span class="badge badge-success">4</span> --}}
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
