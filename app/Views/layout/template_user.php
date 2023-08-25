<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Andryan" />
    <link rel="icon" type="<?= base_url(); ?>/image/png" href="<?= base_url(); ?>/img/logo.png" />

    <title>Dashboard User | <?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Template Table Bootstrap 5 -->
    <link href="<?= base_url(); ?>/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <!-- Template Responsive Table Bootstrap 5-->
    <link href="<?= base_url(); ?>/css/responsive.dataTables.min.css" rel="stylesheet" />

    <!-- Sweet Alert 2 Library-->
    <link href="<?= base_url(); ?>/css/sweetalert2.min.css" rel="stylesheet" />

    <!-- Core JavaScript-->
    <script src="<?= base_url(); ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/js/jquery.easing.min.js"></script>
    <script src="<?= base_url(); ?>/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url(); ?>/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url(); ?>/js/sweetalert2.all.min.js"></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a style="justify-content: center; align-items:center;" class="sidebar-brand">
                <img src="<?= base_url(); ?>/img/logo.png" style="width: 25%" />
                <div class="sidebar-brand-text mx-2">Toko Sukses</div>
            </a>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($title === 'Home') ? 'active' : ''; ?>">
                <a class="nav-link" href="/user">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading Data Master -->
            <div class="sidebar-heading">Data Transaksi</div>

            <!-- Nav Item - Data Barang Masuk -->
            <li class="nav-item <?= ($title === 'Data Barang Masuk') ? 'active' : ''; ?>">
                <a class="nav-link" href="/user/masuk">
                    <i class="fas fa-arrow-left"></i>
                    <span>Data Barang Masuk</span></a>
            </li>

            <!-- Nav Item - Data Barang Keluar -->
            <li class="nav-item <?= ($title === 'Data Barang Keluar') ? 'active' : ''; ?>">
                <a class="nav-link" href="/user/keluar">
                    <i class="fas fa-arrow-right"></i>
                    <span>Data Barang Keluar</span></a>
            </li>

            <!-- Nav Item - Data Retur Barang -->
            <li class="nav-item <?= ($title === 'Data Retur Barang') ? 'active' : ''; ?>">
                <a class="nav-link" href="/user/retur">
                    <i class="fas fa-reply"></i>
                    <span>Data Retur Barang</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Laporan</div>

            <!-- Nav Item - Laporan Barang Masuk -->
            <li class="nav-item <?= ($title === 'Laporan Barang Masuk') ? 'active' : ''; ?>">
                <a class="nav-link" href="/user/laporan_masuk">
                    <i class="fas fa-file-invoice"></i>
                    <span>Laporan Barang Masuk</span></a>
            </li>

            <!-- Nav Item - Laporan Barang Keluar -->
            <li class="nav-item <?= ($title === 'Laporan Barang Keluar') ? 'active' : ''; ?>">
                <a class="nav-link" href="/user/laporan_keluar">
                    <i class="fas fa-file-invoice"></i>
                    <span>Laporan Barang Keluar</span></a>
            </li>

            <!-- Nav Item - Laporan Retur Barang -->
            <li class="nav-item <?= ($title === 'Laporan Retur Barang') ? 'active' : ''; ?>">
                <a class="nav-link" href="/user/laporan_retur">
                    <i class="fas fa-file-invoice"></i>
                    <span>Laporan Retur Barang</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Logout</div>

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fas fa-power-off"></i>
                    <span>Logout</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?= $this->include("layout/topbar"); ?>

                <?= $this->renderSection('content'); ?>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-secondary">
                <?= $this->include("layout/footer"); ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
        $(document).on('click', '#btnProfile', function() {
            $('.modal-body #idUser').val($(this).data('id'));
            $('.modal-body #namaUser').val($(this).data('nama'));
            $('.modal-body #emailUser').val($(this).data('email'));
            $('.modal-body #username').val($(this).data('username'));
            $('.modal-body #passUser').val($(this).data('password'));
            $('.modal-body #telpUser').val($(this).data('telp'));
            $('.modal-body #alamatUser').val($(this).data('alamat'));
            $('.modal-body #tipeAkunUser').val($(this).data('tipe'));
        })
    </script>

    <script type="text/javascript">
        $(document).on('click', '.btnTooglePassword', function(event) {
            event.preventDefault();
            if ($('.toogleVisibility input').attr("type") == "password") {
                $('.toogleVisibility input').attr('type', 'text');
                $('.toogleVisibility i').removeClass('fa-eye');
                $('.toogleVisibility i').addClass('fa-eye-slash');
            } else {
                $('.toogleVisibility input').attr('type', 'password');
                $('.toogleVisibility i').removeClass('fa-eye-slash');
                $('.toogleVisibility i').addClass('fa-eye');
            }
        });
    </script>
</body>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Select <b>"Logout"</b> below if you are ready to leave !!!
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="<?php echo site_url('/user/logout'); ?>">
                    <i class="fas fa-power-off"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>

</html>