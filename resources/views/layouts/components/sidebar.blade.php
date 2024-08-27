<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        {{-- <img width="50%" height="" src="{{ asset('img/logo-aja.png') }}"> --}}
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @if (auth()->user()->hasRole('admin'))
        <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user') }}">
                <i class="fas fa-users"></i>
                <span>User</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('kelas') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kelas') }}">
                <i class="fas fa-school"></i>
                <span>Kelas</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('mapel') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mapel') }}">
                <i class="fas fa-book"></i>
                <span>Mapel</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('mapelkelas') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mapelkelas') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Mapel Kelas</span>
            </a>
        </li>
    @endif
    @if (auth()->user()->hasRole('guru') || auth()->user()->hasRole('admin'))
        <li class="nav-item {{ request()->is('materi') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('materi') }}">
                <i class="fas fa-file-alt"></i>
                <span>Materi</span>
            </a>
        </li>


        <li class="nav-item {{ request()->is('tugasguru') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tugasguru') }}">
                <i class="fas fa-tasks"></i>
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
            <a class="nav-link" href="{{ route('tugasmurid') }}">
                <i class="fas fa-file-signature"></i>
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
