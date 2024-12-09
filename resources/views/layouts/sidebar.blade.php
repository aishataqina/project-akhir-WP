<ul class="navbar-nav bg-pink-300 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15 text-pink-800">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-pink-800">Toko Onlen <sup>{{ auth()->user()->id }}</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item text-pink-800">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt fill-pink-800"></i>
            <span class="text-pink-800">Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('products') }}">
            <i class="fas fa-box"></i>
            <span class="text-pink-800">Product</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/profile">
            <i class="fas fa-user fa-sm fa-fw text-pink-800"></i>
            <span class="text-pink-800">Profile</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('formUser') }}">
            <i class="fas fa-file-alt text-pink-800"></i>
            <span class="text-pink-800">Laporan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 " id="sidebarToggle"></button>
    </div>


</ul>
