<!-- resources/views/partials/sidebar.blade.php -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            ⚽
        </div>
        <div class="sidebar-brand-text mx-3">Akademi Sepak Bola</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Data
    </div>

    <!-- Data Pendaftar -->
    <li class="nav-item {{ request()->routeIs('pendaftars.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pendaftars.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pendaftar</span>
        </a>
    </li>

    <!-- Jadwal Seleksi -->
    <li class="nav-item {{ request()->routeIs('jadwals.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('jadwals.index') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Jadwal Seleksi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
</ul>
