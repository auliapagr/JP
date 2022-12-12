<style>
    ul {
        background: linear-gradient(to right, #D785E6, #7FEEBD 100%);
    }
</style>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fa fa-motorcycle" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">JANPANIK</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('DashboardArdian'); ?>">
            <i class="fa fa-home fa-fw" aria-hidden="true"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Profile -->

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-motorcycle fa-fw"></i>
            <span>Parkir</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('ParkirArdian/ardianParkir'); ?>">Parkir Masuk</a>
                <a class="collapse-item" href="<?= base_url('parkirardian/ardianParkirKeluar'); ?>">Parkir Keluar</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="far fa-fw fa-clipboard"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('LaporanArdian/tanggalArdian'); ?>">Laporan Parkir</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('User'); ?>">
            <i class="fas fa-fw fa-user" aria-hidden="true"></i>
            <span>Profile</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/changePassword'); ?>">
            <i class="fas fa-fw fa-user-edit" aria-hidden="true"></i>
            <span>Change Password</span></a>
    </li>

    <!-- logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('login/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->