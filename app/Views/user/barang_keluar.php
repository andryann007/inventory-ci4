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
    <meta name="author" content="" />
    <link
      rel="icon"
      type="image/png"
      href="<?= base_url(); ?>/img/icons/favicon.ico"
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
      <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <img src="<?= base_url(); ?>/img/logo.png" style="width: 25%" />
        <div class="sidebar-brand-text mx-2">Toko Sukses</div>
      </a>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
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
            <i class="fas fa-cube"></i>
            <span>Data Barang Masuk</span></a>
        </li>

        <!-- Nav Item - Data Barang Keluar -->
        <li class="nav-item active">
            <a class="nav-link" href="/user/keluar">
            <i class="fas fa-cube"></i>
            <span>Data Barang Keluar</span></a>
        </li>
    <!-- Divider -->
<hr class="sidebar-divider" />

<!-- Divider -->
<hr class="sidebar-divider" />

<!-- Heading -->
<div class="sidebar-heading">Laporan</div>

<!-- Nav Item - Laporan Barang Masuk -->
<li class="nav-item">
  <a class="nav-link" href="/user/laporan_masuk">
    <i class="fas fa-file-invoice"></i>
    <span>Laporan Barang Masuk</span></a>
</li>

<!-- Nav Item - Laporan Barang Keluar -->
<li class="nav-item">
  <a class="nav-link" href="/user/laporan_keluar">
    <i class="fas fa-file-invoice"></i>
    <span>Laporan Barang Keluar</span></a>
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
          <?= $this ->
          include("templates/topbar"); ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h2 class="h3 mb-0 text-gray-800 col-md-8">Data Barang Keluar</h2>
              <a
                href="export_stock.php"
                class="btn btn-info btn-sm"
                role="button"
                ><i class="fas fa-file"></i> Data Retur</a
              >

              <a
                href="export_keluar.php"
                class="btn btn-primary btn-sm"
                role="button"
                ><i class="fas fa-file-export"></i> Export Data</a
              >

              <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#addOutcomingModal"
              >
                <i class="fas fa-plus"></i>
                Tambah Data
              </button>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Data - Data Barang Keluar
                </h6>
              </div>
              <div class="card-body">
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
                      $dataStock = mysqli_query($conn, "SELECT * FROM data_barang_keluar keluar, data_stock stock WHERE keluar.id_barang = stock.id_barang AND jenis_transaksi = 'penjualan'");
                      $i = 1;
                      while ($data = mysqli_fetch_array($dataStock)) {
                        $idKeluar = $data['id_keluar'];
                        $idBarang = $data['id_barang'];
                        $tanggal = $data['tgl_keluar'];
                        $namaBarang = $data['nama_barang'];
                        $kategoriBarang = $data['kategori'];
                        $jumlahBarang = $data['qty_keluar'];
                        $hargaBarang = $data['harga_satuan'];
                        $hargaBarangRp = "Rp. " . number_format($hargaBarang, 2, ',', '.');
                        $totalHarga = $hargaBarang * $jumlahBarang;
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
                          <a href="" class="btn btn-primary" role="button"
                            ><i class="fas fa-info"></i></a
                          >

                          <button
                            type="button"
                            class="btn btn-warning"
                            data-toggle="modal"
                            data-target="#editOutcomingModal<?= $idKeluar ?>"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <input
                            type="hidden"
                            name="idHapus"
                            value="<?= $idKeluar; ?>"
                          />
                          <button
                            type="button"
                            class="btn btn-danger"
                            data-toggle="modal"
                            data-target="#deleteOutcomingModal<?= $idKeluar ?>"
                          >
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>

                      <!-- Edit Data Modal -->
                      <div
                        class="modal fade"
                        id="editOutcomingModal<?= $idKeluar ?>"
                        tabindex="-1"
                        aria-labelledby="editModalLabel"
                        aria-hidden="true"
                      >
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel">
                                Edit Data Barang Keluar
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
                                  name="idOutcoming"
                                  value="<?= $idKeluar; ?>"
                                />

                                <input
                                  type="hidden"
                                  name="jumlahBarangLama"
                                  value="<?= $jumlahBarang; ?>"
                                />
                                <div class="form-group">
                                  <label for="tanggalOutcoming">Tanggal</label>
                                  <input
                                    type="date"
                                    name="tglOutcoming"
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
                                  <label for="namaCustomer"
                                    >Nama Customer</label
                                  >
                                  <select
                                    class="form-control"
                                    name="namaCustomer"
                                    id="namaCustomer"
                                    required
                                  >
                                    <?php
                                        $dataNamaSupplier = mysqli_query($conn, "SELECT * FROM data_customer");
                                        while ($fetchArray = mysqli_fetch_array($dataNamaSupplier)) {
                                          $idCustomer = $fetchArray['id_customer'];
                                          $namaCustomer = $fetchArray['nama_customer'];
                                          ?>
                                    <option value="<?= $idCustomer; ?>">
                                      <?=
                                                ucwords($namaCustomer); ?>
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
                                  name="editOutcomingGoods"
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
                        id="deleteOutcomingModal<?= $idKeluar; ?>"
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
                                <b>Yakin Menghapus Barang Ini ?</b>
                              </div>
                              <input
                                type="hidden"
                                name="idBarang"
                                value="<?= $idBarang; ?>"
                              />
                              <input
                                type="hidden"
                                name="idHapus"
                                value="<?= $idKeluar; ?>"
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

  <!-- Add Data Modal -->
  <div
    class="modal fade"
    id="addOutcomingModal"
    tabindex="-1"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">
            Tambah Data Barang Keluar
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
              <label for="tanggalOutcoming">Tanggal</label>
              <input
                type="date"
                name="tglOutcoming"
                id="tanggalOutcoming"
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
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="namaCustomer">Nama Customer</label>
              <select
                class="form-control"
                name="namaCustomer"
                id="namaCustomer"
                required
              >
                <?php
                $dataNamaCustomer = mysqli_query($conn, "SELECT * FROM data_customer");
                while ($fetchArray = mysqli_fetch_array($dataNamaCustomer)) {
                  $idCustomer = $fetchArray['id_customer'];
                  $namaCustomer = $fetchArray['nama_customer'];
                  ?>
                <option value="<?= $idCustomer; ?>">
                  <?= ucwords($namaCustomer); ?>
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
                placeholder="Ket. Barang Keluar"
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
              name="addOutcomingGoods"
            >
              <i class="fas fa-plus"></i> Tambah
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</html>
