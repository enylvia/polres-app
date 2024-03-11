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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Management Access</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <a class="collapse-item" href="/admin/data_laporan">Data Laporan</a>
                <a class="collapse-item" href="/admin/data_laporan_arsip">Arsip</a>

                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Akun</h6>
                <a class="collapse-item" href="/admin/data_user">Akun Pelapor</a>
            </div>
        </div>
    </li>
    @endif
    @if(Auth::user()->id_user_role == 1)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
           aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-fw fa-folder"></i>
            <span>User Access</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kendaraan</h6>
                <a class="collapse-item" href="/user/data_kendaraan">Data Kendaraan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan</h6>
                <a class="collapse-item" href="/user/data_laporan">Data Laporan</a>
            </div>
        </div>
    </li>
    @endif
</ul>
