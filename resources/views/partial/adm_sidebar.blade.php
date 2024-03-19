<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Polres Nabire</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin/index">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    @if(Auth::user()->id_user_role == 2)
    <li class="nav-item">
        <a class="nav-link" href="/data_laporan">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Laporan</span>
        </a>
        <a class="nav-link" href="/admin/data_laporan_arsip">
            <i class="fas fa-fw fa-paperclip"></i>
            <span>Data Arsip</span>
        </a>
        <a class="nav-link" href="/admin/data_user">
            <i class="fas fa-fw fa-user"></i>
            <span>Data User</span>
        </a>
    </li>
    @endif
    @if(Auth::user()->id_user_role == 1)
        <li class="nav-item">

        <a class="nav-link" href="/user/data_kendaraan">
            <i class="fas fa-fw fa-motorcycle"></i>
            <span>Data Kendaraan</span>
        </a>
        <a class="nav-link" href="/data_laporan">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Laporan</span>
        </a>
        </li>
    @endif
</ul>
