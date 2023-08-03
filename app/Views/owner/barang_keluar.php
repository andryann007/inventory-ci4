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

        <!-- Nav Item - Data Customer -->
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
        <li class="nav-item active">
          <a class="nav-link" href="/owner/keluar">
            <i class="fas fa-arrow-right"></i>
            <span>Data Barang Keluar</span></a
          >
        </li>

        <!-- Nav Item - Data Retur Barang -->
        <li class="nav-item">
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
              <h2 class="h3 mb-0 text-gray-800 col-md-7">Data Barang Keluar</h2>

              <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#addOutcomingModal"
              >
                <i class="fas fa-plus"></i>
                Tambah Data
              </button>

              <button
                type="button"
                class="btn btn-primary btn-sm"
                data-toggle="modal"
                data-target="#filterOutcomingModal"
              >
                <i class="fas fa-filter"></i>
                Filter Data
              </button>

              <a
                href="<?php echo site_url('/owner/keluar');?>"
                class="btn btn-dark btn-sm"
                role="button"
                ><i class="fas fa-eye"></i> View All Data</a
              >
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Data - Data Barang Keluar
                </h6>
              </div>

              <div class="card-body">
                
                <!-- Notifikasi Alert Jika Data Barang Keluar Berhasil di Tambah / Edit / Hapus -->
                <?php if(session()->get('message')) :?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">
                      &times;
                    </button>
                    Perhatian !!! Data Barang Keluar 
                    <strong><?= session()->getFlashdata('message'); ?> </strong>
                  </div>
                <?php endif; ?>

                <!-- Notifikasi Alert Jika Data Barang Keluar Gagal di Tambah / Edit / Hapus -->
                <?php if(session()->get('error')) :?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">
                      &times;
                    </button>
                    Perhatian !!! Data Barang Keluar 
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
                        <th>Tgl Keluar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Harga/Pcs</th>
                        <th>QTY</th>
                        <th>Total Harga</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i =1; ?>
                      <?php foreach ($keluar as $klr) : ?>
                      <tr>
                        <td>
                          <?= $i++; ?>
                        </td>
                        <td>
                          <?php
                            $date_keluar = date_create($klr['tgl_keluar']); 
                            echo date_format($date_keluar, "d F Y"); ?>
                        </td>
                        <td>
                          <?= ucwords($klr['nama_barang']); ?>
                        </td>
                        <td>
                          <?= ucwords($klr['kategori']); ?>
                        </td>
                        <td>
                          <?= $klr['keterangan']; ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($klr['harga_satuan_keluar'], 2, ',', '.'); ?>
                        </td>
                        <td>
                          <?= $klr['qty_keluar']; ?>
                        </td>
                        <td>
                          <?= "Rp. " . number_format($klr['total_harga_keluar'], 2, ',', '.'); ?>
                        </td>
                        <td
                          class="d-sm-flex justify-content-around align-items-center"
                        >

                          <button
                            type="button"
                            id="btnEdit"
                            class="btn btn-warning mr-2"
                            data-toggle="modal"
                            data-target="#editOutcomingModal"
                            data-id_keluar="<?= $klr['id_keluar'];?>"
                            data-id_barang="<?= $klr['id_barang'];?>"
                            data-tgl_keluar="<?= $klr['tgl_keluar'];?>"
                            data-qty_keluar="<?= $klr['qty_keluar'];?>"
                            data-harga="<?= $klr['harga_satuan_keluar'];?>"
                            data-total_harga="<?= $klr['total_harga_keluar'];?>"
                            data-keterangan="<?= $klr['keterangan'];?>"
                          >
                            <i class="fas fa-edit"></i>
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

    <script>
      $(document).on('click', '#btnEdit', function(){
        $('.modal-body #idKeluar').val($(this).data('id_keluar'));
        $('.modal-body #namaBarang').val($(this).data('id_barang'));
        $('.modal-body #tglOutcoming').val($(this).data('tgl_keluar'));
        $('.modal-body #jumlahBarang').val($(this).data('qty_keluar'));
        $('.modal-body #hargaSatuan').val($(this).data('harga'));
        $('.modal-body #keterangan').val($(this).data('keterangan'));
      })
    </script>
  </body>

  <!-- Add Data Modal -->
  <div
    class="modal fade"
    id="addOutcomingModal"
    tabindex="-1"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
        <form action="/owner/save_keluar" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tanggalOutcoming">Tanggal Keluar</label>
                  <input
                    type="date"
                    name="tglOutcoming"
                    id="tglOutcoming"
                    class="form-control"
                    required
                  />
                </div>
              </div>

              <div class="col-md-6">
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
            </div>

            <div class="row">
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
                  placeholder="Ket. Barang Keluar"
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
              name="addOutcomingGoods"
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
    id="editOutcomingModal"
    tabindex="-1"
    aria-labelledby="editModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
        <form action="/owner/update_keluar" method="post">
          <div class="modal-body">
            <input
              type="hidden"
              name="idKeluar"
              id="idKeluar"
              class="form-control"
              required
            />

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tanggalOutcoming">Tanggal Keluar</label>
                  <input
                    type="date"
                    name="tglOutcoming"
                    id="tglOutcoming"
                    class="form-control"
                    required
                  />
                </div>
              </div>

              <div class="col-md-6">
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
            </div>

            <div class="row">
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
                  placeholder="Ket. Barang Keluar"
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
              name="editOutcomingGoods"
            >
              <i class="fas fa-edit"></i> Edit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

   <!-- Filter Data Modal -->
   <div
    class="modal fade"
    id="filterOutcomingModal"
    tabindex="-1"
    aria-labelledby="filterModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">
            Filter Data Barang Keluar
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
          <form action='/owner/keluar' method="post">
          <div class="modal-body">
            <label for="namaBarang">Filter Data by <b>Range of Date</b></label>
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
                <label for="namaBarang">Filter Data by <b>Nama Barang</b> :</label>
                <div class="form-group">
                  <select
                    class="form-control"
                    name="idBarang"
                    id="idBarang"
                  >
                  <option></option>
                  <?php foreach ($stock as $stk) : ?>
                    <option value="<?= $stk['id_barang']; ?>">
                      <?= ucwords($stk['nama_barang']); ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <label for="idBarang">Filter Data by <b>Kategori</b> :</label>
                <div class="form-group">
                    <select
                      class="form-control"
                      name="kategoriBarang"
                      id="kategoriBarang"
                    >
                      <option></option>
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
              </div>

              <div class="col-md-12">
                <label for="keterangan"><b>Note :</b> 1. Untuk Filter Data by <b>Nama Barang / Kategori</b>, Silahkan Pilih Salah Satu !!! (Tidak Bisa Keduanya)</label>
              </div>

              <div class="col-md-12">
                <label for="keterangan"><b>Note :</b> 2. Jika Tidak Ada Filter, Maka Data Barang Keluar akan di <b>Tampilkan Semua !!!</b></label>
              </div>

              <div class="col-md-12">
                <label for="keterangan"><b>Note :</b> 3. Jika Tampilan Data Kosong, Maka <b>Tidak Ada Data Yang Memenuhi Kriteria Filter !!!</b></label>
              </div>

            </div>
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button type="submit" class="btn btn-primary" name="filterOutcoming">
              <i class="fas fa-filter"></i> Filter
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
    id="deleteOutcomingModal"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">
            Hapus Barang Keluar ?
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
        <form action="/owner/delete_keluar" method="post">
          <div class="modal-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tanggalOutcoming">Tanggal Keluar</label>
                  <input
                    type="date"
                    name="tglOutcoming"
                    id="tglOutcoming"
                    class="form-control"
                    readonly
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="namaBarang">Nama Barang</label>
                    <select
                      class="form-control"
                      name="namaBarang"
                      id="namaBarang"
                      readonly
                    >
                    <?php foreach ($stock as $stk) : ?>
                      <option value="<?= $stk['id_barang']; ?>">
                        <?= ucwords($stk['nama_barang']); ?>
                      </option>
                    <?php endforeach; ?>
                    </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="jumlahBarang">Jumlah Barang</label>
                  <input
                    type="number"
                    min="0"
                    name="jumlahBarang"
                    id="jumlahBarang"
                    class="form-control"
                    readonly
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
                    readonly
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
                  placeholder="Ket. Barang Keluar"
                  class="form-control"
                  readonly
                />
            </div>

            <div class="col-md-12">
              <b>Apakah Anda Yakin Ingin Menghapus Data Barang Keluar Ini ?</b>
            </div>
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <input
              type="hidden"
              id="idKeluar"
              name="idKeluar"
            />

            <input
              type="hidden"
              id="namaBarang"
              name="namaBarang"
            />

            <button
              type=" submit"
              class="btn btn-danger"
              name="deleteKeluar"
            >
              <i class="fas fa-trash"></i> Hapus
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
            <a class="btn btn-danger" href="<?php echo site_url('/owner/logout');?>">
              <i class="fas fa-power-off"></i> Logout
            </a>
          </div>
        </div>
      </div>
  </div>
</html>
