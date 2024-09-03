<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion shadow" style="background: white;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <img width="50%" height="" src="{{ asset('img/logo-tulis.png') }}">
    </a>

    <!-- Nav Item - Dashboard -->
    <style>
        .nav-link:hover {
            background: #38CC1A;
            border-radius: 25px;
            border: 15px solid white !important;
            color: white !important;
        }

        .nav-link:hover span {
            color: white !important;
        }
        .nav-link:hover i {
            color: white !important;
        }
    </style>
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('home') }}">
            <i style="color: black" class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if (auth()->user()->hasRole('admin'))
        <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
            <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('user') }}">
                <i style="color: black" class="fas fa-users"></i>
                <span>User</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('kelas') ? 'active' : '' }}">
            <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('kelas') }}">
                <i style="color: black" class="fas fa-school"></i>
                <span>Kelas</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('mapel') ? 'active' : '' }}">
            <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('mapel') }}">
                <i style="color: black" class="fas fa-book"></i>
                <span>Mapel</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('mapelkelas') ? 'active' : '' }}">
            <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('mapelkelas') }}">
                <i style="color: black" class="fas fa-chalkboard-teacher"></i>
                <span>Mapel Kelas</span>
            </a>
        </li>
    @endif
    @if (auth()->user()->hasRole('guru') || auth()->user()->hasRole('admin'))
        <li class="nav-item {{ request()->is('materi') ? 'active' : '' }}">
            <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('materi') }}">
                <i style="color: black" class="fas fa-file-alt"></i>
                <span>Materi</span>
            </a>
        </li>


        <li class="nav-item {{ request()->is('tugasguru') ? 'active' : '' }}">
            <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('tugasguru') }}">
                <i style="color: black" class="fas fa-tasks"></i>
                <span>
                    Tugas
                    @role('admin')
                        Guru
                    @endrole
                </span>
            </a>
        </li>
    @endif

    @if (auth()->user()->hasRole('murid') || auth()->user()->hasRole('admin'))
        <li class="nav-item {{ request()->is('tugasmurid') ? 'active' : '' }}">
            <a class="nav-link" style="color: black;border: 15px solid white !important;" href="{{ route('tugasmurid') }}">
                <i style="color: black" class="fas fa-file-signature"></i>
                <span>
                    Tugas
                    @role('admin')
                        Murid
                    @endrole
                </span>
            </a>
        </li>
    @endif
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
