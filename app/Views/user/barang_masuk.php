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
          href="/user"
        >
          <img src="<?= base_url(); ?>/img/logo.png" style="width: 25%" />
          <div class="sidebar-brand-text mx-2">Toko Sukses</div>
        </a>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="/user">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />
       
        <!-- Heading Data Master -->
        <div class="sidebar-heading">Data Transaksi</div>

        <!-- Nav Item - Data Barang Masuk -->
        <li class="nav-item active">
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
              <h2 class="h3 mb-0 text-gray-800 col-md-8">Data Barang Masuk</h2>

              <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#addIncomingModal"
              >
                <i class="fas fa-plus"></i>
                Tambah Data
              </button>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Data - Data Barang Masuk
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
                        <th>ID Masuk</th>
                        <th>ID Barang</th>
                        <th>ID Supplier</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
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
                          <?= $msk['tgl_masuk']; ?>
                        </td>
                        <td>
                          <?= $msk['id_masuk']; ?>
                        </td>
                        <td>
                          <?= $msk['id_barang']; ?>
                        </td>
                        <td>
                          <?= ucwords($msk['id_supplier']); ?>
                        </td>
                        <td>
                          <?= $msk['qty_masuk']; ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($msk['harga_satuan'], 2, ',', '.'); ?>
                        </td>
                        <td>
                          <?= $msk['keterangan']; ?>
                        </td>
                        <td
                          class="d-sm-flex justify-content-around align-items-center"
                        >
                          <a href="" class="btn btn-primary" role="button"
                            ><i class="fas fa-info"></i
                          ></a>

                          <button
                            type="button"
                            class="btn btn-warning"
                            id="btnEdit"
                            data-toggle="modal"
                            data-target="#editIncomingModal"
                            data-id_masuk="<?= $msk['id_masuk'];?>"
                            data-id_barang="<?= $msk['id_barang'];?>"
                            data-id_supplier="<?= $msk['id_supplier'];?>"
                            data-tgl_masuk="<?= $msk['tgl_masuk'];?>"
                            data-qty_masuk="<?= $msk['qty_masuk'];?>"
                            data-harga="<?= $msk['harga_satuan'];?>"
                            data-total_harga="<?= $msk['total_harga'];?>"
                            data-keterangan="<?= $msk['keterangan'];?>"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            type="button"
                            class="btn btn-danger"
                            id="btnDelete"
                            data-toggle="modal"
                            data-target="#deleteIncomingModal"
                            data-id="<?= $msk['id_masuk'];?>"
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

    <script>
      $(document).on('click', '#btnEdit', function(){
        $('.modal-body #idMasuk').val($(this).data('id_masuk'));
        $('.modal-body #namaBarang').val($(this).data('id_barang'));
        $('.modal-body #namaSupplier').val($(this).data('id_supplier'));
        $('.modal-body #tglIncoming').val($(this).data('tgl_masuk'));
        $('.modal-body #jumlahBarang').val($(this).data('qty_masuk'));
        $('.modal-body #hargaSatuan').val($(this).data('harga'));
        $('.modal-body #keterangan').val($(this).data('keterangan'));
      })

      $(document).on('click', '#btnDelete', function(){
        $('.modal-footer #idMasuk').val($(this).data('id'));
      })
    </script>
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
        <form action="/user/save_masuk" method="post">
          <div class="modal-body">
          <div class="form-group">
              <label for="idMasuk">ID Barang Masuk</label>
              <input
                type="text"
                min="0"
                name="idMasuk"
                id="idMasuk"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="tanggalIncoming">Tanggal</label>
              <input
                type="date"
                name="tglIncoming"
                id="tglIncoming"
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
                $conn = mysqli_connect("localhost", "root", "", "database_inventory");
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
                class="form-control"
                required
              />
            </div>

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

            <div class="form-group">
              <label for="namaSupplier">Nama Supplier</label>
              <select
                class="form-control"
                name="namaSupplier"
                id="namaSupplier"
                required
              >
                <?php
                $conn = mysqli_connect("localhost", "root", "", "database_inventory");
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

  <!-- Edit Data Modal -->
  <div
    class="modal fade"
    id="editIncomingModal"
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
        <form action="/user/update_masuk" method="post">
          <div class="modal-body">
          <div class="form-group">
              <label for="idMasuk">ID Barang Masuk</label>
              <input
                type="text"
                min="0"
                name="idMasuk"
                id="idMasuk"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="tglIncoming">Tanggal</label>
              <input
                type="date"
                name="tglIncoming"
                id="tglIncoming"
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
                class="form-control"
                required
              />
            </div>

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

   <!-- Delete Data Modal -->
   <div
    class="modal fade"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true"
    id="deleteIncomingModal"
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
        <form action="/user/delete_masuk" method="post">
          <div class="modal-body text-center">
            Apakah anda yakin ingin menghapus data barang masuk ini ?
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <input
              type="hidden"
              id="idMasuk"
              name="idMasuk"
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
