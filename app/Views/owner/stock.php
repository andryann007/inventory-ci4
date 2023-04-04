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
        <li class="nav-item active">
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
              <h2 class="h3 mb-0 text-gray-800 col-md-9">Data Stock</h2>
              
              <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#addStockModal"
              >
                <i class="fas fa-plus"></i>
                Tambah Data
              </button>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Data - Data Stock Barang
                </h6>
              </div>

              <div class="card-body">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "database_inventory");
                $barangHabis = mysqli_query($conn, "SELECT * FROM data_stock WHERE qty_stock < 1");

                while ($fetch = mysqli_fetch_array($barangHabis)) {
                  $barang = $fetch['nama_barang'];

                  ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">
                    &times;
                  </button>
                  <strong>Perhatian !!! </strong>Stock Barang
                  <strong><?= ucwords($barang); ?> </strong>Sudah Habis
                </div>
                <?php
                }
                ?>

                <?php
                $barangSedikit = mysqli_query($conn, "SELECT * FROM data_stock WHERE qty_stock < 10 AND qty_stock >
                0"); while ($fetch = mysqli_fetch_array($barangSedikit)) {
                $barang = $fetch['nama_barang']; ?>
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">
                    &times;
                  </button>
                  <strong>Perhatian !!! </strong>Stock Barang
                  <strong><?= ucwords($barang); ?> </strong>Tersisa Sedikit
                </div>
                <?php
                }
                ?>

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
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i =1; ?>
                      <?php foreach ($stock as $stk) : ?>
                      <tr>
                        <td>
                          <?= $i++; ?>
                        </td>
                        <td>
                          <?= $stk['id_barang']; ?>
                        </td>
                        <td>
                          <?= ucwords($stk['nama_barang']); ?>
                        </td>
                        <td>
                          <?= ucwords($stk['kategori']); ?>
                        </td>
                        <td>
                          <?= $stk['qty_stock']; ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($stk['harga_satuan'], 2, ',', '.'); ?>
                        </td>

                        <td
                          class="d-sm-flex justify-content-between align-items-center"
                        >
                          <a href="" class="btn btn-primary" role="button"
                            ><i class="fas fa-info"></i></a
                          >

                          <button
                            type="button"
                            class="btn btn-warning"
                            id="btnEdit"
                            data-toggle="modal"
                            data-target="#editStockModal"
                            data-id="<?= $stk['id_barang'];?>"
                            data-nama="<?= $stk['nama_barang'];?>"
                            data-kategori="<?= $stk['kategori'];?>"
                            data-qty="<?= $stk['qty_stock'];?>"
                            data-harga="<?= $stk['harga_satuan'];?>"
                            data-total_harga="<?= $stk['total_harga'];?>"
                            data-status="<?= $stk['status'];?>"
                          >
                            <i class="fas fa-edit"></i>
                          </button>

                          <button
                            type="button"
                            class="btn btn-danger"
                            id="btnDelete"
                            data-toggle="modal"
                            data-target="#deleteStockModal"
                            data-id="<?= $stk['id_barang'];?>"
                          >
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      <?php endforeach; ?>
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
        $('.modal-body #idBarang').val($(this).data('id'));
        $('.modal-body #namaBarang').val($(this).data('nama'));
        $('.modal-body #kategoriBarang').val($(this).data('kategori'));
        $('.modal-body #jumlahBarang').val($(this).data('qty'));
        $('.modal-body #hargaSatuan').val($(this).data('harga'));
        $('.modal-body #totalHarga').val($(this).data('total_harga'));
        $('.modal-body #status').val($(this).data('status'));
      })

      $(document).on('click', '#btnDelete', function(){
        $('.modal-footer #idBarang').val($(this).data('id'));
      })
    </script>
  </body>

  <!-- Add Data Modal -->
  <div
    class="modal fade"
    id="addStockModal"
    tabindex="-1"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">
            Tambah Data Stock Barang
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
        <form action='/owner/update_stock' method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="idBarang">ID Barang</label>
              <input
                type="text"
                name="idBarang"
                id="idBarang"
                placeholder="ID Barang"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="namaBarang">Nama Barang</label>
              <input
                type="text"
                name="namaBarang"
                id="namaBarang"
                placeholder="Nama Barang"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="kategoriBarang">Kategori Barang</label>
              <select
                class="form-control"
                name="kategoriBarang"
                id="kategoriBarang"
              >
                <option>Sembako</option>
                <option>Makanan Ringan</option>
                <option>Minuman</option>
                <option>Perlengkapan Mandi & Mencuci</option>
                <option>Perlengkapan Rumah Tangga</option>
                <option>Obat - Obatan</option>
                <option>Bumbu Dapur</option>
                <option>Makanan Instan</option>
              </select>
            </div>

            <div class="form-group">
              <label for="jumlahBarang">Jumlah Barang</label>
              <input
                type="number"
                name="jumlahBarang"
                id="jumlahBarang"
                placeholder="Jumlah Barang"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="hargaSatuan">Harga Satuan</label>
              <input
                type="number"
                name="hargaSatuan"
                id="hargaSatuan"
                placeholder="Harga/Pcs"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="status">Status Barang</label>
              <select
                class="form-control"
                name="status"
                id="status"
              >
                <option>Tersedia</option>
                <option>Habis</option>
              </select>
            </div>
          </div>

          <div class="d-sm-flex modal-footer justify-content-between mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button type="submit" class="btn btn-primary" name="addNewStock">
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
    id="editStockModal"
    tabindex="-1"
    aria-labelledby="editModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">
            Edit Data Stock Barang
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
        <form action='/owner/update_stock' method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="idBarang">ID Barang</label>
              <input
                type="text"
                name="idBarang"
                id="idBarang"
                placeholder="ID Barang"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="namaBarang">Nama Barang</label>
              <input
                type="text"
                name="namaBarang"
                id="namaBarang"
                placeholder="Nama Barang"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="kategoriBarang">Kategori Barang</label>
              <select
                class="form-control"
                name="kategoriBarang"
                id="kategoriBarang"
              >
                <option>Sembako</option>
                <option>Makanan Ringan</option>
                <option>Minuman</option>
                <option>Perlengkapan Mandi & Mencuci</option>
                <option>Perlengkapan Rumah Tangga</option>
                <option>Obat - Obatan</option>
                <option>Bumbu Dapur</option>
                <option>Makanan Instan</option>
              </select>
            </div>

            <div class="form-group">
              <label for="jumlahBarang">Jumlah Barang</label>
              <input
                type="number"
                name="jumlahBarang"
                id="jumlahBarang"
                placeholder="Jumlah Barang"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="hargaSatuan">Harga Satuan</label>
              <input
                type="number"
                name="hargaSatuan"
                id="hargaSatuan"
                placeholder="Harga/Pcs"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="status">Status Barang</label>
              <select
                class="form-control"
                name="status"
                id="status"
              >
                <option>Tersedia</option>
                <option>Habis</option>
              </select>
            </div>
          </div>

          <div class="d-sm-flex modal-footer justify-content-between mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button type="submit" class="btn btn-warning" name="editStock">
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
    id="deleteStockModal"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">
            Hapus Stock ?
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
        <form action="/owner/delete_stock" method="post">
          <div class="modal-body text-center">
            Apakah anda yakin ingin menghapus stock ini ?
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <input
              type="hidden"
              id="idBarang"
              name="idBarang"
            />

            <button
              type=" submit"
              class="btn btn-danger"
              name="deleteStock"
            >
              <i class="fas fa-trash"></i> Hapus
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</html>
