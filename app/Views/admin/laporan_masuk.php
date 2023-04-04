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
          <a class="nav-link" href="<?php echo site_url('/admin/logout');?>">
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
              <h2 class="h3 mb-0 text-gray-800 col-md-9">
                Laporan Barang Masuk
              </h2>

              <a
                href="export_stock.php"
                class="btn btn-primary btn-sm"
                role="button"
                ><i class="fas fa-file-export"></i> Export Data</a
              >
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Laporan Barang Masuk
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
                $conn = mysqli_connect("localhost", "root", "", "database_inventory");
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

                <div class="row mb-4">
                  <div class="col">
                    <form method="post" class="form-inline">
                      <input type="date" name="tglMulai" class="form-control" />
                      <input
                        type="date"
                        name="tglSelesai"
                        class="form-control ml-3"
                      />
                      <button
                        type="submit"
                        name="filterTgl"
                        class="btn btn-info ml-3"
                      >
                        <i class="fa fa-filter"></i> Filter
                      </button>
                    </form>
                  </div>
                </div>

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
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                    $conn = mysqli_connect("localhost", "root", "", "database_inventory");
                      if (isset($_POST['filterTgl'])) {
                        $mulai = $_POST['tglMulai'];
                        $selesai = $_POST['tglSelesai'];
                        $dataStock = mysqli_query($conn, "SELECT * FROM data_barang_masuk masuk, data_stock stock WHERE stock.id_barang = masuk.id_barang AND tgl_masuk BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                      } else {
                        $dataStock = mysqli_query($conn, "SELECT * FROM data_barang_masuk masuk, data_stock stock WHERE stock.id_barang = masuk.id_barang");
                      }
                      $i = 1;
                      while ($data = mysqli_fetch_array($dataStock)) {
                        $idMasuk = $data['id_masuk'];
                        $idBarang = $data['id_barang'];
                        $tanggal = $data['tgl_masuk'];
                        $namaBarang = $data['nama_barang'];
                        $kategoriBarang = $data['kategori'];
                        $jumlahBarang = $data['qty_masuk'];
                        $hargaBarang = $data['harga_satuan'];
                        $hargaBarangRp = "Rp. " . number_format($hargaBarang, 2, ',', '.');
                        $totalHarga = $jumlahBarang * $hargaBarang;
                        $totalHargaRp = "Rp. " . number_format($totalHarga, 2, ',', '.');
                        $keterangan = $data['keterangan'];
                        ?>
                      <tr>
                        <td>
                          <?= $i++; ?>
                        </td>
                        <td>
                          <?= $tanggal; ?>
                        </td>
                        <td>
                          <?= ucwords($namaBarang); ?>
                        </td>
                        <td>
                          <?= ucwords($kategoriBarang); ?>
                        </td>
                        <td>
                          <?= $jumlahBarang; ?>
                        </td>
                        <td>
                          <?= $totalHargaRp; ?>
                        </td>
                        <td>
                          <?= $keterangan; ?>
                        </td>
                        <td
                          class="d-sm-flex justify-content-around align-items-center"
                        >
                          <button
                            type="button"
                            class="btn btn-warning"
                            data-toggle="modal"
                            data-target="#editIncomingModal<?= $idMasuk ?>"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <input
                            type="hidden"
                            name="idHapus"
                            value="<?= $idMasuk; ?>"
                          />
                          <button
                            type="button"
                            class="btn btn-danger"
                            data-toggle="modal"
                            data-target="#deleteIncomingModal<?= $idMasuk ?>"
                          >
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      <!-- Delete Data Modal -->
                      <div
                        class="modal fade"
                        tabindex="-1"
                        aria-labelledby="deleteModalLabel"
                        aria-hidden="true"
                        id="deleteIncomingModal<?= $idMasuk; ?>"
                      >
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel">
                                Hapus Barang Masuk ?
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
                            <form method="post">
                              <div class="modal-body text-center">
                                Yakin Ingin Menghapus Data
                                <b><?= ucwords($namaBarang); ?></b> ?
                              </div>
                              <input
                                type="hidden"
                                name="idBarang"
                                value="<?= $idBarang; ?>"
                              />
                              <input
                                type="hidden"
                                name="idHapus"
                                value="<?= $idMasuk; ?>"
                              />

                              <div class="d-sm-flex modal-footer mb-4">
                                <button
                                  type=" submit"
                                  class="btn btn-danger"
                                  name="deleteIncoming"
                                >
                                  <i class="fas fa-trash"></i> Hapus
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- Edit Data Modal -->
                      <div
                        class="modal fade"
                        id="editIncomingModal<?= $idMasuk ?>"
                        tabindex="-1"
                        aria-labelledby="editModalLabel"
                        aria-hidden="true"
                      >
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel">
                                Edit Data Barang Masuk
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
                            <form method="post">
                              <div class="modal-body">
                                <input
                                  type="hidden"
                                  name="idIncoming"
                                  value="<?= $idMasuk; ?>"
                                />

                                <input
                                  type="hidden"
                                  name="jumlahBarangLama"
                                  value="<?= $jumlahBarang; ?>"
                                />
                                <div class="form-group">
                                  <label for="tanggalIncoming">Tanggal</label>
                                  <input
                                    type="date"
                                    name="tglIncoming"
                                    id="tanggalIncoming"
                                    value="<?= $tanggal; ?>"
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
                                    <?php
                                                        $dataNamaBarang = mysqli_query($conn, "SELECT * FROM data_stock");
                                                        while ($fetchArray = mysqli_fetch_array($dataNamaBarang)) {
                                                          $idBarang = $fetchArray['id_barang'];
                                                          $namaBarang = $fetchArray['nama_barang'];
                                                          ?>

                                    <option value="<?= $idBarang; ?>">
                                      <?=
                                                                                ucwords($namaBarang); ?>
                                    </option>

                                    <?php
                                                        }
                                                        ?>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label for="jumlahBarang"
                                    >Jumlah Barang</label
                                  >
                                  <input
                                    type="number"
                                    min="0"
                                    name="jumlahBarang"
                                    id="jumlahBarang"
                                    placeholder="<?= $jumlahBarang; ?>"
                                    value="<?= $jumlahBarang; ?>"
                                    class="form-control"
                                    required
                                  />
                                </div>

                                <div class="form-group">
                                  <label for="hargaSatuan">Harga Barang</label>
                                  <input
                                    type="number"
                                    min="0"
                                    name="hargaSatuan"
                                    id="hargaSatuan"
                                    placeholder="<?= $hargaBarang ?>"
                                    value="<?= $hargaBarang; ?>"
                                    class="form-control"
                                    required
                                  />
                                </div>

                                <div class="form-group">
                                  <label for="namaSupplier"
                                    >Nama Supplier</label
                                  >
                                  <select
                                    class="form-control"
                                    name="namaSupplier"
                                    id="namaSupplier"
                                    required
                                  >
                                    <?php
                                                        $dataNamaSupplier = mysqli_query($conn, "SELECT * FROM data_supplier");
                                                        while ($fetchArray = mysqli_fetch_array($dataNamaSupplier)) {
                                                          $idSupplier = $fetchArray['id_supplier'];
                                                          $namaSupplier = $fetchArray['nama_supplier'];
                                                          ?>

                                    <option value="<?= $idSupplier; ?>">
                                      <?=
                                                                                ucwords($namaSupplier); ?>
                                    </option>

                                    <?php
                                                        }
                                                        ?>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label for="keterangan">Keterangan</label>
                                  <input
                                    type="textarea"
                                    min="0"
                                    name="keterangan"
                                    id="keterangan"
                                    value="<?= $keterangan; ?>"
                                    class="form-control"
                                    required
                                  />
                                </div>
                              </div>

                              <div class="d-sm-flex modal-footer mb-4">
                                <button
                                  type="button"
                                  class="btn btn-danger"
                                  data-dismiss="modal"
                                >
                                  <i class="fas fa-trash"></i> Batal
                                </button>
                                <button
                                  type="submit"
                                  class="btn btn-warning"
                                  name="editIncomingGoods"
                                >
                                  <i class="fas fa-edit"></i> Edit
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <?php

                      }
                      ?>
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
            <a class="btn btn-primary" href="<?php echo site_url('/admin/logout');?>">Logout</a>
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

  <!-- Add Data Modal -->
  <div
    class="modal fade"
    id="addIncomingModal"
    tabindex="-1"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">
            Tambah Data Barang Masuk
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
        <form method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="tanggalIncoming">Tanggal</label>
              <input
                type="date"
                name="tglIncoming"
                id="tanggalIncoming"
                placeholder="Tanggal"
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
                <?php
                $dataNamaBarang = mysqli_query($conn, "SELECT * FROM data_stock");
                while ($fetchArray = mysqli_fetch_array($dataNamaBarang)) {
                  $idBarang = $fetchArray['id_barang'];
                  $namaBarang = $fetchArray['nama_barang'];
                  ?>

                <option value="<?= $idBarang; ?>">
                  <?= ucwords($namaBarang); ?>
                </option>

                <?php
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="jumlahBarang">Jumlah Barang</label>
              <input
                type="number"
                min="0"
                name="jumlahBarang"
                id="jumlahBarang"
                placeholder="Jumlah"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="hargaSatuan">Harga Barang</label>
              <input
                type="number"
                min="0"
                name="hargaSatuan"
                id="hargaSatuan"
                placeholder="Harga Satuan"
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
                <?php
                $dataNamaSupplier = mysqli_query($conn, "SELECT * FROM data_supplier");
                while ($fetchArray = mysqli_fetch_array($dataNamaSupplier)) {
                  $idSupplier = $fetchArray['id_supplier'];
                  $namaSupplier = $fetchArray['nama_supplier'];
                  ?>

                <option value="<?= $idSupplier; ?>">
                  <?= ucwords($namaSupplier); ?>
                </option>

                <?php
                }
                ?>
              </select>
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

          <div class="d-sm-flex modal-footer justify-content-between mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              name="addIncomingGoods"
            >
              <i class="fas fa-plus"></i> Tambah
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</html>