<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid" style="width: 280px; height: 80px;">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Tembak Pajak -->
    <li class="nav-item {{ request()->routeIs('incomes.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('incomes.index') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Tembak Pajak</span>
        </a>
    </li>

    <!-- Nav Item - Revenue -->
    <li class="nav-item {{ request()->routeIs('revenues.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('revenues.index') }}">
            <i class="fas fa-fw fa-coins"></i>
            <span>Revenue</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->
