<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="Andryan" />
    <link
      rel="icon"
      type="image/png"
      href="<?= base_url(); ?>/img/logo.png"
    />

    <title>Aplikasi Inventory - Toko Sukses</title>

    <!-- Custom fonts for this template-->
    <link
      href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- template table bootstrap 4 -->
    <link
      href="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css"
      rel="stylesheet"
    />

    <!-- Sweet Alert 2 Library-->
    <link href="<?= base_url(); ?>/css/sweetalert2.min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul
        class="navbar-nav bg-dark sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="/admin"
        >
          <img src="<?= base_url(); ?>/img/logo.png" style="width: 25%" />
          <div class="sidebar-brand-text mx-2">Toko Sukses</div>
        </a>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="/admin">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading Data Master -->
        <div class="sidebar-heading">Data Master</div>

        <!-- Nav Item - Data Supplier -->
        <li class="nav-item">
          <a class="nav-link" href="/admin/supplier">
            <i class="fas fa-truck"></i>
            <span>Data Supplier</span></a
          >
        </li>

        <!-- Nav Item - Data Stock -->
        <li class="nav-item">
          <a class="nav-link" href="/admin/stock">
            <i class="fas fa-cubes"></i>
            <span>Data Stock Barang</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading Data Master -->
        <div class="sidebar-heading">Data Transaksi</div>

        <!-- Nav Item - Data Barang Masuk -->
        <li class="nav-item">
          <a class="nav-link" href="/admin/masuk">
            <i class="fas fa-arrow-left"></i>
            <span>Data Barang Masuk</span></a
          >
        </li>

        <!-- Nav Item - Data Barang Keluar -->
        <li class="nav-item">
          <a class="nav-link" href="/admin/keluar">
            <i class="fas fa-arrow-right"></i>
            <span>Data Barang Keluar</span></a
          >
        </li>

        <!-- Nav Item - Data Retur Barang -->
        <li class="nav-item">
          <a class="nav-link" href="/admin/retur">
          <i class="fas fa-reply"></i>
            <span>Data Retur Barang</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Laporan</div>

        <!-- Nav Item - Laporan Barang Masuk -->
        <li class="nav-item active">
          <a class="nav-link" href="/admin/laporan_masuk">
            <i class="fas fa-file-invoice"></i>
            <span>Laporan Barang Masuk</span></a
          >
        </li>

        <!-- Nav Item - Laporan Barang Keluar -->
        <li class="nav-item">
          <a class="nav-link" href="/admin/laporan_keluar">
            <i class="fas fa-file-invoice"></i>
            <span>Laporan Barang Keluar</span></a
          >
        </li>

        <!-- Nav Item - Laporan Retur Barang -->
        <li class="nav-item">
          <a class="nav-link" href="/admin/laporan_retur">
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
          <a class="nav-link" type="button" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-power-off"></i>
            <span>Logout</span></a
          >
        </li>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <?= $this ->
          include("templates/topbar"); ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h2 class="h3 mb-0 text-gray-800 col-md-7">Laporan Barang Masuk</h2>

              <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#printIncoming"
              >
                <i class="fas fa-print"></i>
                Print Data
              </button>

              <button
                type="button"
                class="btn btn-primary btn-sm"
                data-toggle="modal"
                data-target="#filterIncoming"
              >
                <i class="fas fa-filter"></i>
                Filter Data
              </button>

              <form action='/admin/laporan_masuk' method="post">
                <button
                  type="submit"
                  class="btn btn-dark btn-sm"
                  ><i class="fas fa-eye"></i> View All Data</button
                >
              </form>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Laporan Barang Masuk
                </h6>
              </div>

              <div class="card-body">
                <!-- Notifikasi Alert Jika Stock Barang Habis -->
                <?php foreach ($stock as $stk) : ?>
                  <?php if($stk['qty_stock'] < 1) :?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">
                        &times;
                      </button>
                      <strong>Perhatian !!! </strong>Stock Barang
                      <strong><?= ucwords($stk['nama_barang']); ?> </strong>Sudah Habis
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              
                <!-- Notifikasi Alert Jika Stock Barang Sedikit -->
                <?php foreach ($stock as $stk) : ?>
                  <?php if($stk['qty_stock'] < 10 && $stk['qty_stock'] > 1) :?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert">
                        &times;
                      </button>
                      <strong>Perhatian !!! </strong>Stock Barang
                      <strong><?= ucwords($stk['nama_barang']); ?> </strong>Tersisa Sedikit
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>

                <div class="table-responsive table-striped">
                  <table
                    class="table table-bordered"
                    id="dataTable"
                    width="100%"
                    cellspacing="0"
                  >
                    <thead class="thead-dark">
                      <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Tgl Masuk</th>
                        <th>Nama Supplier</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>QTY Barang</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i =1; ?>
                      <?php foreach ($masuk as $msk) : ?>
                      <tr>
                        <td>
                          <?= $i++; ?>
                        </td>
                        <td>
                          <?= $msk['no_faktur']; ?>
                        </td>
                        <td>
                          <?php
                            $date_masuk = date_create($msk['tgl_masuk']); 
                            echo date_format($date_masuk, "d F Y"); ?>
                        </td>
                        <td>
                          <?= $msk['nama_supplier']; ?>
                        </td>
                        <td>
                          <?= $msk['nama_barang']; ?>
                        </td>
                        <td>
                        <?php if($msk['kategori'] == "bumbu") :?>
                            Bumbu Masakan
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "makanan_instan") :?>
                            Makanan Instan
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "makanan_ringan") :?>
                            Makanan Ringan
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "minuman") :?>
                            Minuman
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "sembako") :?>
                            Sembako
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "perlengkapan_mandi") :?>
                            Perlengkapan Mandi
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "perlengkapan_mencuci") :?>
                            Perlengkapan Mencuci
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "obat") :?>
                            Obat - Obatan
                          <?php endif; ?>

                          <?php if($msk['kategori'] == "lain_lain") :?>
                            Lain Lain
                          <?php endif; ?>
                        </td>
                        <td>
                        <?= $msk['qty_masuk']; ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($msk['harga_satuan_masuk'], 2, ',', '.'); ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($msk['total_harga_masuk'], 2, ',', '.'); ?>
                        </td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-secondary">
          <?= $this ->
          include("templates/footer"); ?>
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

    <script src="<?= base_url(); ?>/js/sweetalert2.all.min.js"></script>

    <script>
      <?php if(session()->get('incoming_message')) :?>
        Swal.fire(
          'Laporan Barang Masuk',
          '<?= session()->getFlashdata('incoming_message');?>',
          'success'
        )
      <?php endif; ?>

      <?php if(session()->get('filter_incoming_message')) :?>
        Swal.fire(
          'Laporan Barang Masuk',
          '<?= session()->getFlashdata('filter_incoming_message');?>',
          'success'
        )
      <?php endif; ?>

      <?php if(session()->get('error')) :?>
        Swal.fire({
          icon: 'error',
          title: 'Laporan Barang Masuk',
          text: '<?= session()->getFlashdata('error');?>',
          footer: 'Terjadi Kesalahan Teknis, Coba Beberapa Saat Lagi'
        })
      <?php endif; ?>
    </script>

    <script type="text/javascript">
      $(document).on('click', '#btnProfile', function(){
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
      $(document).ready(function(){
        $('#tooglePassword').on('click', function(event){

          event.preventDefault();
          if($('#passwordVisibility input').attr("type") == "password"){
            $('#passwordVisibility input').attr('type', 'text');
            $('#passwordVisibility i').removeClass('fa-eye');
            $('#passwordVisibility i').addClass('fa-eye-slash');
          } else {
            $('#passwordVisibility input').attr('type', 'password');
            $('#passwordVisibility i').removeClass('fa-eye-slash');
            $('#passwordVisibility i').addClass('fa-eye');
          }
        });
      });

      $('#tooglePassword3').on('click', function(event){
        event.preventDefault();
        if($('#passwordVisibility3 input').attr("type") == "password"){
          $('#passwordVisibility3 input').attr('type', 'text');
          $('#passwordVisibility3 i').removeClass('fa-eye');
          $('#passwordVisibility3 i').addClass('fa-eye-slash');
        } else {
          $('#passwordVisibility3 input').attr('type', 'password');
          $('#passwordVisibility3 i').removeClass('fa-eye-slash');
          $('#passwordVisibility3 i').addClass('fa-eye');
        }
      });
    </script>
  </body>

  <!-- Filter Data Modal -->
  <div
    class="modal fade"
    id="filterIncoming"
    tabindex="-1"
    aria-labelledby="filterLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterLabel">
            Filter Laporan Barang Masuk
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form action='/admin/laporan_masuk' method="post">
          <div class="modal-body">
            <label for="tglMulai">Filter Data by <b>Range of Date</b></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="date" 
                    name="tglMulai" 
                    class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="date" 
                    name="tglSelesai" 
                    class="form-control" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaSupplier">Filter Data by <b>Nama Supplier</b> :</label>
                  <select
                    class="form-control"
                    name="namaSupplier"
                    id="namaSupplier"
                  >
                  <option value="">-- Pilih Nama Supplier --</option>
                  <?php foreach ($supplier as $spy) : ?>
                    <option value="<?= $spy['id_supplier']; ?>">
                      <?= ucwords($spy['nama_supplier']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaBarang">Filter Data by <b>Nama Barang</b> :</label>
                  <select
                    class="form-control"
                    name="namaBarang"
                    id="namaBarang"
                  >
                  <option value="">-- Pilih Nama Barang --</option>
                  <?php foreach ($stock as $stk) : ?>
                    <option value="<?= $stk['id_barang']; ?>">
                      <?= ucwords($stk['nama_barang']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <label for="keterangan"><b>Note :</b> Filter Dapat Dilakukan Satu - Satu / Semua !!!</label>
              </div>

            </div>
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button type="submit" class="btn btn-primary" name="filterIncoming">
              <i class="fas fa-filter"></i> Filter
            </button>
          </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Print Data Modal -->
  <div
    class="modal fade"
    id="printIncoming"
    tabindex="-1"
    aria-labelledby="printLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="printLabel">
            Print Laporan Barang Masuk
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form action='/admin/print_masuk' method="post">
          <div class="modal-body">
            <label for="tglMulai">Print Data <b>Filter Range of Date</b></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="date" 
                    name="tglMulai" 
                    class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="date" 
                    name="tglSelesai" 
                    class="form-control" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaSupplier">Print Data <b>Filter Nama Supplier</b> :</label>
                  <select
                    class="form-control"
                    name="namaSupplier"
                    id="namaSupplier"
                  >
                  <option value="">-- Pilih Nama Supplier --</option>
                  <?php foreach ($supplier as $spy) : ?>
                    <option value="<?= $spy['id_supplier']; ?>">
                      <?= ucwords($spy['nama_supplier']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaBarang">Print Data <b>Filter Nama Barang</b> :</label>
                  <select
                    class="form-control"
                    name="namaBarang"
                    id="namaBarang"
                  >
                  <option value="">-- Pilih Nama Barang --</option>
                  <?php foreach ($stock as $stk) : ?>
                    <option value="<?= $stk['id_barang']; ?>">
                      <?= ucwords($stk['nama_barang']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              
              <div class="col-md-12">
                <label for="keterangan"><b>Note :</b> Filter Dapat Dilakukan Satu - Satu / Semua, Untuk Opsi Filter Print Bersifat Optional (Tidak Wajib).<br>
                 Jika Tidak Ada Filter, Maka Laporan Barang Masuk akan di <b>Print Semua !!!</b></label>
              </div>

            </div>
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button type="submit" class="btn btn-success" name="printOutcoming">
              <i class="fas fa-print"></i> Print
            </button>
          </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select <b>"Logout"</b> below if you are ready to leave !!!
          </div>
          <div class="modal-footer">
            <a class="btn btn-danger" href="<?php echo site_url('/admin/logout');?>">
              <i class="fas fa-power-off"></i> Logout
            </a>
          </div>
        </div>
      </div>
  </div>
</html>