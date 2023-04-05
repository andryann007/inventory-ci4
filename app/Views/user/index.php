<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Dashboard untuk User" />
  <meta name="author" content="Andryan" />

  <link
      rel="icon"
      type="image/png"
      href="<?= base_url(); ?>/img/logo.png"
  />

  <title>Dashboard User</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- template table bootstrap 4 -->
  <link href="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
     <!-- Sidebar -->
     <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/user">
        <img src="<?= base_url(); ?>/img/logo.png" style="width: 25%" />
        <div class="sidebar-brand-text mx-2">Toko Sukses</div>
      </a>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="/user">
          <i class="fas fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />


      <!-- Heading Data Master -->
      <div class="sidebar-heading">Data Transaksi</div>

      <!-- Nav Item - Data Barang Masuk -->
      <li class="nav-item">
        <a class="nav-link" href="/user/masuk">
          <i class="fas fa-arrow-left"></i>
          <span>Data Barang Masuk</span></a
        >
      </li>

      <!-- Nav Item - Data Barang Keluar -->
      <li class="nav-item">
        <a class="nav-link" href="/user/keluar">
          <i class="fas fa-arrow-right"></i>
          <span>Data Barang Keluar</span></a
        >
      </li>

      <!-- Nav Item - Data Retur Barang -->
      <li class="nav-item">
        <a class="nav-link" href="">
        <i class="fas fa-reply"></i>
          <span>Data Retur Barang</span></a
        >
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Laporan</div>

      <!-- Nav Item - Laporan Barang Masuk -->
      <li class="nav-item">
        <a class="nav-link" href="/user/laporan_masuk">
          <i class="fas fa-file-invoice"></i>
          <span>Laporan Barang Masuk</span></a
        >
      </li>

      <!-- Nav Item - Laporan Barang Keluar -->
      <li class="nav-item">
        <a class="nav-link" href="/user/laporan_keluar">
          <i class="fas fa-file-invoice"></i>
          <span>Laporan Barang Keluar</span></a
        >
      </li>

      <!-- Nav Item - Laporan Retur Barang -->
      <li class="nav-item">
        <a class="nav-link" href="">
          <i class="fas fa-file-invoice"></i>
          <span>Laporan Retur Barang</span></a
        >
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Logout</div>

      <!-- Nav Item - Laporan Stok Barang -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('/user/logout');?>">
          <i class="fas fa-power-off"></i>
          <span>Logout</span></a>
      </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
            <?= $this -> include("templates/topbar"); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard User</h1>
          </div>

          <!-- Data Transaksi -->
          <div class="col bg-dark">
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
              <h1 class="h4 mt-2 text-light">Data Transaksi</h1>
            </div>

            <div class="row">
                <!-- Data Barang Masuk -->
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Barang Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_barang_masuk; ?></b> Data</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-left fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <!-- Data Barang Keluar -->
              <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                      Data Barang Keluar</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_barang_keluar; ?></b> Data</div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-arrow-right fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Data Retur Barang -->
              <div class="col-xl-4 col-md-6 mb-4">
                  <div class="card border-left-warning shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                      Data Retur Barang</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><b></b> Data</div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-reply fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-secondary">
        <?= $this -> include("templates/footer"); ?>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <a class="btn btn-primary" href="<?php echo site_url('/user/logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

  <script src="<?= base_url(); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url(); ?>/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url(); ?>/js/demo/chart-area-demo.js"></script>
  <script src="<?= base_url(); ?>/js/demo/chart-pie-demo.js"></script>
</body>

</html>