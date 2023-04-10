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
          href="/owner"
        >
          <img src="<?= base_url(); ?>/img/logo.png" style="width: 25%" />
          <div class="sidebar-brand-text mx-2">Toko Sukses</div>
        </a>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="/owner">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading Data Master -->
        <div class="sidebar-heading">Data Master</div>

        <!-- Nav Item - Data Akun -->
        <li class="nav-item">
          <a class="nav-link" href="/owner/akun">
            <i class="fas fa-id-card"></i>
            <span>Data Akun</span></a
          >
        </li>

        <!-- Nav Item - Data Supplier -->
        <li class="nav-item">
          <a class="nav-link" href="/owner/supplier">
            <i class="fas fa-truck"></i>
            <span>Data Supplier</span></a
          >
        </li>

        <!-- Nav Item - Data Stock -->
        <li class="nav-item">
          <a class="nav-link" href="/owner/stock">
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
          <a class="nav-link" href="/owner/masuk">
            <i class="fas fa-arrow-left"></i>
            <span>Data Barang Masuk</span></a
          >
        </li>

        <!-- Nav Item - Data Barang Keluar -->
        <li class="nav-item">
          <a class="nav-link" href="/owner/keluar">
            <i class="fas fa-arrow-right"></i>
            <span>Data Barang Keluar</span></a
          >
        </li>

        <!-- Nav Item - Data Retur Barang -->
        <li class="nav-item active">
          <a class="nav-link" href="/owner/retur">
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
          <a class="nav-link" href="/owner/laporan_masuk">
            <i class="fas fa-file-invoice"></i>
            <span>Laporan Barang Masuk</span></a
          >
        </li>

        <!-- Nav Item - Laporan Barang Keluar -->
        <li class="nav-item">
          <a class="nav-link" href="/owner/laporan_keluar">
            <i class="fas fa-file-invoice"></i>
            <span>Laporan Barang Keluar</span></a
          >
        </li>

        <!-- Nav Item - Laporan Retur Barang -->
        <li class="nav-item">
          <a class="nav-link" href="/owner/laporan_retur">
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
          <a class="nav-link" href="<?php echo site_url('/owner/logout');?>">
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
              <h2 class="h3 mb-0 text-gray-800 col-md-8">Data Retur Barang</h2>

              <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#addReturModal"
              >
                <i class="fas fa-plus"></i>
                Tambah Data
              </button>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Data - Data Retur Barang
                </h6>
              </div>

              <div class="card-body">
                
                <!-- Notifikasi Alert Jika Data Retur Barang Berhasil di Tambah / Edit / Hapus -->
                <?php if(session()->get('message')) :?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">
                      &times;
                    </button>
                    Perhatian !!! 
                    <strong><?= session()->getFlashdata('message'); ?> </strong>
                  </div>
                <?php endif; ?>

                <!-- Notifikasi Alert Jika Data Retur Barang Gagal di Tambah / Edit / Hapus -->
                <?php if(session()->get('error')) :?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">
                      &times;
                    </button>
                    Perhatian !!! 
                    <strong><?= session()->getFlashdata('error'); ?> </strong>
                  </div>
                <?php endif; ?>
                
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
                        <th>ID Retur</th>
                        <th>Tgl Retur</th>
                        <th>Nama Barang</th>
                        <th>Nama Supplier</th>
                        <th>Kategori</th>
                        <th>Harga/Pcs</th>
                        <th>QTY</th>
                        <th>Total Harga</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i =1; ?>
                      <?php foreach ($retur as $rtr) : ?>
                        
                      <tr>
                        <td>
                          <?= $i++; ?>
                        </td>
                        <td>
                          <?= $rtr['id_retur']; ?>
                        </td>
                        <td>
                          <?= $rtr['tgl_retur']; ?>
                        </td>
                        <td>
                          <?= $rtr['nama_barang']; ?>
                        </td>
                        <td>
                          <?= ucwords($rtr['nama_supplier']); ?>
                        </td>
                        <td>
                          <?= $rtr['kategori']; ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($rtr['harga_satuan'], 2, ',', '.'); ?>
                        </td>
                        <td>
                          <?= $rtr['qty_retur']; ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($rtr['qty_retur'] * $rtr['harga_satuan'], 2, ',', '.'); ?>
                        </td>
                        <td>
                          <?= $rtr['keterangan']; ?>
                        </td>
                        <td
                          class="d-sm-flex justify-content-around align-items-center"
                        >

                          <button
                            type="button"
                            class="btn btn-warning mr-2"
                            id="btnEdit"
                            data-toggle="modal"
                            data-target="#editReturModal"
                            data-id_retur="<?= $rtr['id_retur'];?>"
                            data-id_barang="<?= $rtr['id_barang'];?>"
                            data-id_supplier="<?= $rtr['id_supplier'];?>"
                            data-tgl_retur="<?= $rtr['tgl_retur'];?>"
                            data-qty_retur="<?= $rtr['qty_retur'];?>"
                            data-harga="<?= $rtr['harga_satuan'];?>"
                            data-total_harga="<?= $rtr['total_harga'];?>"
                            data-keterangan="<?= $rtr['keterangan'];?>"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            type="button"
                            class="btn btn-danger"
                            id="btnDelete"
                            data-toggle="modal"
                            data-target="#deleteReturModal"
                            data-id_retur="<?= $rtr['id_retur'];?>"
                            data-id_barang="<?= $rtr['id_barang'];?>"
                          >
                            <i class="fas fa-trash"></i>
                          </button>
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

    <!-- Logout Modal-->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
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
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="<?php echo site_url('/owner/logout');?>">Logout</a>
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

    <script>
      $(document).on('click', '#btnEdit', function(){
        $('.modal-body #idRetur').val($(this).data('id_retur'));
        $('.modal-body #namaBarang').val($(this).data('id_barang'));
        $('.modal-body #namaSupplier').val($(this).data('id_supplier'));
        $('.modal-body #tglRetur').val($(this).data('tgl_retur'));
        $('.modal-body #jumlahBarang').val($(this).data('qty_retur'));
        $('.modal-body #hargaSatuan').val($(this).data('harga'));
        $('.modal-body #keterangan').val($(this).data('keterangan'));
      })

      $(document).on('click', '#btnDelete', function(){
        $('.modal-footer #idRetur').val($(this).data('id_retur'));
        $('.modal-footer #namaBarang').val($(this).data('id_barang'));
      })
    </script>
  </body>

  <!-- Add Data Modal -->
  <div
    class="modal fade"
    id="addReturModal"
    tabindex="-1"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">
            Tambah Data Retur Barang
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
        <form action="/owner/save_retur" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="idRetur">ID Retur Barang</label>
                  <input
                    type="text"
                    min="0"
                    name="idRetur"
                    id="idRetur"
                    class="form-control"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="namaBarang">Nama Barang</label>
                  <select
                    class="form-control"
                    name="namaBarang"
                    id="namaBarang"
                    required
                  >
                  <?php foreach ($stock as $stk) : ?>
                    <option value="<?= $stk['id_barang']; ?>">
                      <?= ucwords($stk['nama_barang']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
                
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tanggalRetur">Tanggal Retur</label>
                  <input
                    type="date"
                    name="tglRetur"
                    id="tglRetur"
                    class="form-control"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="namaSupplier">Nama Supplier</label>
                  <select
                    class="form-control"
                    name="namaSupplier"
                    id="namaSupplier"
                    required
                  >
                  <?php foreach ($supplier as $s) : ?>
                    <option value="<?= $s['id_supplier']; ?>">
                      <?= ucwords($s['nama_supplier']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="jumlahBarang">Jumlah Barang</label>
                  <input
                    type="number"
                    min="0"
                    name="jumlahBarang"
                    id="jumlahBarang"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            
              <div class="col-md-6">
                <div class="form-group">
                  <label for="hargaSatuan">Harga Barang Satuan</label>
                  <input
                    type="number"
                    min="0"
                    name="hargaSatuan"
                    id="hargaSatuan"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input
                type="textarea"
                min="0"
                name="keterangan"
                id="keterangan"
                placeholder="Ket. Barang Masuk"
                class="form-control"
                required
              />
            </div>
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              name="addReturGoods"
            >
              <i class="fas fa-plus"></i> Tambah
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Data Modal -->
  <div
    class="modal fade"
    id="editReturModal"
    tabindex="-1"
    aria-labelledby="editModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">
            Edit Data Retur Barang
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
        <form action="/owner/update_retur" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="idRetur">ID Retur Barang</label>
                  <input
                    type="text"
                    min="0"
                    name="idRetur"
                    id="idRetur"
                    class="form-control"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="namaBarang">Nama Barang</label>
                  <select
                    class="form-control"
                    name="namaBarang"
                    id="namaBarang"
                    required
                  >
                  <?php foreach ($stock as $stk) : ?>
                    <option value="<?= $stk['id_barang']; ?>">
                      <?= ucwords($stk['nama_barang']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
                
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tanggalRetur">Tanggal Retur</label>
                  <input
                    type="date"
                    name="tglRetur"
                    id="tglRetur"
                    class="form-control"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="namaSupplier">Nama Supplier</label>
                  <select
                    class="form-control"
                    name="namaSupplier"
                    id="namaSupplier"
                    required
                  >
                  <?php foreach ($supplier as $s) : ?>
                    <option value="<?= $s['id_supplier']; ?>">
                      <?= ucwords($s['nama_supplier']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="jumlahBarang">Jumlah Barang</label>
                  <input
                    type="number"
                    min="0"
                    name="jumlahBarang"
                    id="jumlahBarang"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            
              <div class="col-md-6">
                <div class="form-group">
                  <label for="hargaSatuan">Harga Barang Satuan</label>
                  <input
                    type="number"
                    min="0"
                    name="hargaSatuan"
                    id="hargaSatuan"
                    class="form-control"
                    required
                  />
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input
                type="textarea"
                min="0"
                name="keterangan"
                id="keterangan"
                placeholder="Ket. Barang Masuk"
                class="form-control"
                required
              />
            </div>
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button
              type="submit"
              class="btn btn-warning"
              name="editReturGoods"
            >
              <i class="fas fa-edit"></i> Edit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

   <!-- Delete Data Modal -->
   <div
    class="modal fade"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true"
    id="deleteReturModal"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">
            Hapus Retur Barang ?
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
        <form action="/owner/delete_retur" method="post">
          <div class="modal-body text-center">
            Apakah anda yakin ingin menghapus data retur barang ini ?
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <input
              type="hidden"
              id="idRetur"
              name="idRetur"
            />

            <input
              type="hidden"
              id="namaBarang"
              name="namaBarang"
            />

            <button
              type=" submit"
              class="btn btn-danger"
              name="deleteMasuk"
            >
              <i class="fas fa-trash"></i> Hapus
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</html>
