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
    <link rel="icon" type="<?= base_url(); ?>/image/png" href="<?= base_url(); ?>/img/logo.png" />

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
        <li class="nav-item active">
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
            <?= $this -> include("templates/topbar"); ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h2 class="h3 mb-0 text-gray-800 col-md-9">Data Akun</h2>

              <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#addAccountModal"
              >
                <i class="fas fa-plus"></i>
                Tambah Data
              </button>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Data - Data Akun
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
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Alamat Lengkap</th>
                        <th>No. Telp</th>
                        <th>Hak Akses</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i =1; ?>
                      <?php foreach ($akun as $a) : ?>
                      <tr>
                        <td>
                          <?= $i++; ?>
                        </td>
                        <td>
                          <?= $a['nama_lengkap']; ?>
                        </td>
                        <td>
                          <?= $a['email']; ?>
                        </td>
                        <td>
                          <?= $a['password']; ?>
                        </td>
                        <td>
                          <?= $a['alamat']; ?>
                        </td>
                        <td>
                          <?= $a['telp']; ?>
                        </td>
                        <td>
                          <?= ucwords($a['tipe_akun']); ?>
                        </td>
                        <td
                          class="d-sm-flex justify-content-between align-items-center"
                        >

                          <button
                            type="button"
                            class="btn btn-warning"
                            id="btnEdit"
                            data-toggle="modal"
                            data-target="#editAccountModal"
                            data-id="<?= $a['id_user'];?>"
                            data-nama="<?= $a['nama_lengkap'];?>"
                            data-email="<?= $a['email'];?>"
                            data-password="<?= $a['password'];?>"
                            data-alamat="<?= $a['alamat'];?>"
                            data-telp="<?= $a['telp'];?>"
                            data-tipe="<?= $a['tipe_akun'];?>"
                          >
                            <i class="fas fa-edit"></i>
                          </button>
                          <button
                            type="button"
                            class="btn btn-danger"
                            id="btnDelete"
                            data-toggle="modal"
                            data-target="#deleteAccountModal"
                            data-id="<?= $a['id_user'];?>"
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
        $('.modal-body #idUser').val($(this).data('id'));
        $('.modal-body #namaUser').val($(this).data('nama'));
        $('.modal-body #emailUser').val($(this).data('email'));
        $('.modal-body #passUser').val($(this).data('password'));
        $('.modal-body #telpUser').val($(this).data('telp'));
        $('.modal-body #alamatUser').val($(this).data('alamat'));
        $('.modal-body #tipeAkunUser').val($(this).data('tipe'));
      })

      $(document).on('click', '#btnDelete', function(){
        $('.modal-footer #idUser').val($(this).data('id'));
      })
    </script>
  </body>

  <!-- Add Data Modal -->
  <div
    class="modal fade"
    id="addAccountModal"
    tabindex="-1"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Akun</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <?php $validation = \Config\Services::validation(); ?>

        <form action='/owner/save_akun' method="post">=

          <div class="modal-body">
            
          <div class="form-group">
              <label for="idUser">ID User</label>
              <input
                type="text"
                name="idUser"
                id="idUser"
                placeholder="@example"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="namaUser">Nama Lengkap</label>
              <input
                type="text"
                name="namaUser"
                id="namaUser"
                placeholder="Nama Lengkap"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="emailUser">Email</label>
              <input
                type="email"
                name="emailUser"
                id="emailUser"
                placeholder="example@gmail.com"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="passUser">Password</label>
              <input
                type="password"
                name="passUser"
                id="passUser"
                placeholder="********"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="alamat">Alamat Lengkap</label>
              <input
                type="textarea"
                name="alamatUser"
                id="alamatUser"
                placeholder="Alamat Lengkap"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="telp">No. Telp</label>
              <input
                type="textarea"
                name="telpUser"
                id="telpUser"
                placeholder="No. Telpon"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="tipeAkun">Tipe Akun</label>
              <select
                class="form-control"
                name="tipeAkunUser"
                id="tipeAkunUser"
                required
              >
                <option>Owner</option>
                <option>Admin</option>
                <option>User</option>
              </select>
            </div>
          </div>

          <div class="d--sm-flex modal-footer mb-4">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash"></i> Batal
            </button>
            <button type="submit" class="btn btn-primary" name="addNewAccount">
              <i class="fas fa-plus"></i> Tambah
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Add Data Modal -->

  <!-- Edit Data Modal -->
  <div
    class="modal fade"
    id="editAccountModal"
    tabindex="-1"
    aria-labelledby="addModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action='/owner/update_akun' method="post">
          <div class="modal-body">
          <div class="form-group">
              <label for="idUser">ID User</label>
              <input
                type="text"
                name="idUser"
                id="idUser"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="namaUser">Nama Lengkap</label>
              <input
                type="text"
                name="namaUser"
                id="namaUser"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="emailUser">Email</label>
              <input
                type="email"
                name="emailUser"
                id="emailUser"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="passUser">Password</label>
              <input
                type="password"
                name="passUser"
                id="passUser"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="alamat">Alamat Lengkap</label>
              <input
                type="textarea"
                name="alamatUser"
                id="alamatUser"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="telp">No. Telp</label>
              <input
                type="textarea"
                name="telpUser"
                id="telpUser"
                class="form-control"
                required
              />
            </div>

            <div class="form-group">
              <label for="tipeAkun">Tipe Akun</label>
              <select
                class="form-control"
                name="tipeAkunUser"
                id="tipeAkunUser"
                required
              >
                <option>Owner</option>
                <option>Admin</option>
                <option>User</option>
              </select>
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
              type=" submit"
              class="btn btn-warning"
              name="editAccount"
            >
              <i class="fas fa-edit"></i> Edit
            </button>
          </div>
        </form>
      </div>
    </div>
    </div>
  <!-- End Edit Data Modal -->

  <!-- Delete Data Modal -->
  <div
    class="modal fade"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true"
    id="deleteAccountModal"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">
            Hapus Akun ?
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
        <form action="/owner/delete_akun" method="post">
          <div class="modal-body text-center">
            Apakah anda yakin ingin menghapus akun ini ?
          </div>

          <div class="d-sm-flex modal-footer mb-4">
            <input
              type="hidden"
              id="idUser"
              name="idUser"
            />

            <button
              type=" submit"
              class="btn btn-danger"
              name="deleteAccount"
            >
              <i class="fas fa-trash"></i> Hapus
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Delete Data Modal -->
  
</html>