<!--sidebar start-->
<?php
$id = $_SESSION['admin']['id_member'];
$hasil_profil = $lihat->member_edit($id);
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AJS GROUP<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="index.php?page=samsat">
        <i class="fas fa-fw fa-folder"></i>
            <span>PEMBUKUAN</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4-mitra" aria-expanded="true" aria-controls="collapse4-mitra">
            <i class="fas fa-fw fa-handshake"></i>
            <span>Lain - Lain</span>
        </a>
        <div id="collapse4-mitra" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="index.php?page=mitra">Belum di bayar</a>
                <a class="collapse-item" href="index.php?page=pemitra">Tagihan lain</a>
            </div>
        </div>
    </li>



    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="index.php?page=pengaturan">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Pengaturan Toko</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <h4 style="font-weight: bold; color: black;">AJS SERVICE PHONE</h4>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
                <!-- Topbar Search -->
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="assets/img/user/<?php echo $hasil_profil['gambar']; ?>">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small ml-2"><?php echo $hasil_profil['nm_member']; ?></span>
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php?page=user">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">