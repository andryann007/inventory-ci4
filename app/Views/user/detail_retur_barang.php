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
        <li class="nav-item active">
          <a class="nav-link" href="/user/retur">
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
          <a class="nav-link" href="/user/laporan_retur">
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
            <?= form_open('user/save_detail_retur', ['class' => 'formSimpanReturBarang']);?>

            <?= csrf_field();?>

            <div
            class="d-sm-flex align-items-center justify-content-between"
            >
            <h2 class="h3 text-gray-800 col-md-9">Detail Retur Barang</h2>

            <a
                class="btn btn-danger btn-sm btnBack"
                href="/user/retur"
            >
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            <button
                type="submit"
                class="btn btn-info btn-sm btnSave"
            >
                <i class="fas fa-save"></i>
                Simpan Data
            </button>

            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Tambah Data Retur Barang
                    </h6>
                </div>

                <div class="card-body">
                <table
                    class="table table-bordered"
                    width="100%"
                    cellspacing="0"
                    >
                    <thead class="thead-dark">
                        <tr>
                        <th>Nama Barang</th>
                        <th>QTY Barang</th>
                        <th>Harga Satuan</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="formTambahBarang">
                        <input
                            type="hidden"
                            name="idRetur[]"
                            id="idRetur[]"
                            value="<?= $id_retur;?>"
                            class="form-control"
                            required
                        />
                        <tr>
                        <td><select class="form-control" name="namaBarang[]" required>
                                <?php foreach ($stock as $stk) : ?>
                                <option value="<?= $stk['id_barang']; ?>">
                                    <?= ucwords($stk['nama_barang']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" min="0" name="jumlahBarang[]" class="form-control" required/></td>
                        <td><input type="number" min="0" name="hargaSatuan[]" class="form-control" required/></td>
                        <td><input type="textarea" name="keterangan[]" placeholder="Ket. Barang Masuk" class="form-control" required/></td>
                        <td><button type="button" class="btn btn-success btnTambahBarang mr-2">
                                <i class="fas fa-plus"></i>
                            </button>
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>

            <?= form_close(); ?>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-sm-flex align-items-center justify-content-between">
                <div class="col-md-10">
                  <h6 class="m-0 font-weight-bold text-primary">
                  Detail Retur Barang
                  </h6><br>
                </div>

                <div class="col-md-1">
                  <form action="/user/print_retur" method="post">
                    <input
                        type="hidden"
                        name="idCetakRetur"
                        id="idCetakRetur"
                        class="form-control"
                        value="<?= $id_retur;?>"
                        required
                    />
                    <button
                        type="submit"
                        class="btn btn-success btn-sm btnPrint"
                    >
                        <i class="fas fa-print"></i>
                        Cetak
                    </button>
                  </form>
                </div>
              </div>

                <h6 class="m-0 font-weight-bold text-dark">No Faktur : <?= $no_faktur;?></h6>
                <h6 class="m-0 font-weight-bold text-dark">Tanggal Transaksi : <?= $tgl_retur;?></h6>
                <h6 class="m-0 font-weight-bold text-dark">Nama Supplier : <?= $nama_supplier;?></h6>
                <h6 class="m-0 font-weight-bold text-dark">Nama Petugas : <?= $nama_lengkap;?></h6>
            </div>

            <div class="card-body">

                <div class="table-responsive table-striped">
                <table
                    class="table table-bordered"
                    width="100%"
                    cellspacing="0"
                >
                    <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>QTY Retur</th>
                        <th>Harga Satuan</th>
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
                        <?= $rtr['nama_barang']; ?>
                        </td>
                        <td>
                        <?= $rtr['qty_retur']; ?>
                        </td>
                        <td>
                        <?= "Rp. " . number_format($rtr['harga_satuan_retur'], 2, ',', '.'); ?>
                        </td>
                        <td>
                        <?= "Rp. " . number_format($rtr['total_harga_retur'], 2, ',', '.'); ?>
                        </td>
                        <td>
                        <?= $rtr['keterangan']; ?>
                        </td>
                        <td
                        class="d-sm-flex justify-content-around align-items-center"
                        >
                        <button
                            type="button"
                            id="btnEdit"
                            class="btn btn-warning mr-2"
                            data-toggle="modal"
                            data-target="#editReturningDetail"
                            data-id_barang="<?= $rtr['id_barang'];?>"
                            data-qty_retur="<?= $rtr['qty_retur'];?>"
                            data-harga_satuan="<?= $rtr['harga_satuan_retur'];?>"
                            data-keterangan="<?= $rtr['keterangan'];?>"
                        >
                            <i class="fas fa-edit"></i>
                        </button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                    <tr>
                        <td colspan="3" align="center"><b>Total Harga</b></td>
                        <td colspan="3" align="center"><b><?= "Rp. ". number_format($grand_total, 2, ',', '.'); ?></b></td>
                    </tr>
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
      <?php if(session()->get('returning_message')) :?>
        Swal.fire(
          'Data Retur Barang',
          '<?= session()->getFlashdata('returning_message');?>',
          'success'
        )
      <?php endif; ?>

      <?php if(session()->get('filter_returning_message')) :?>
        Swal.fire(
          'Data Retur Barang',
          '<?= session()->getFlashdata('filter_returning_message');?>',
          'success'
        )
      <?php endif; ?>

      <?php if(session()->get('error')) :?>
        Swal.fire({
          icon: 'error',
          title: 'Data Retur Barang',
          text: '<?= session()->getFlashdata('error');?>',
          footer: 'Dikarenakan QTY Stock < QTY Retur'
        })
      <?php endif; ?>
    </script>

    <script>
      $(document).ready(function(e){
        $('.btnTambahBarang').click(function(e){
          e.preventDefault();

          $('.formTambahBarang').append('<tr>' +
              '<td><select class="form-control" name="namaBarang[]" required>' +
                    '<?php foreach ($stock as $stk) : ?>' +
                      '<option value="<?= $stk['id_barang']; ?>">' +
                        '<?= ucwords($stk['nama_barang']); ?>' +
                      '</option>' +
                    '<?php endforeach; ?>' +
                  '</select>' +
              '</td>' +
              '<td><input type="number" min="0" name="jumlahBarang[]" class="form-control" required/></td>' +
              '<td><input type="number" min="0" name="hargaSatuan[]" class="form-control" required/></td>' +
              '<td><input type="textarea" name="keterangan[]" placeholder="Ket. Barang Masuk" class="form-control" required/></td>' +
              '<td><button type="button" class="btn btn-danger btnHapusBarang mr-2">' +
                    '<i class="fas fa-trash"></i>' +
                  '</button>' +
              '</td>' +
            '</tr>'
          );
        });

        $('.formSimpanReturBarang').submit(function(e){
          e.preventDefault();
          
          $.ajax({
            type : "post",
            url : $(this).attr('action'),
            data : $(this).serialize(),
            dataType : "json",
            beforeSend: function(){
              $('.btnSave').attr('disable', 'disabled');
              $('.btnSave').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function(){
              $('.btnSave').removeAttr('disable');
              $('.btnSave').html('<i class="fa fa-save"></i> Simpan Data');
            },
            success: function(response){
              if(response.success){
                window.location.href = ("<?= site_url('user/retur'); ?>");
              }
            },
            error: function(xhr, ajaxOptions, thrownError){
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
          });
          return false;
        });
      });

      $(document).on('click', '.btnHapusBarang', function(e){
        e.preventDefault();

        $(this).parents('tr').remove();
      });
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

    <script>
      $(document).on('click', '#btnEdit', function(){ 
        $('.modal-body #idBarang').val($(this).data('id_barang'));
        $('.modal-body #qtyRetur').val($(this).data('qty_retur'));
        $('.modal-body #hargaSatuan').val($(this).data('harga_satuan'));
        $('.modal-body #keterangan').val($(this).data('keterangan'));
      })
    </script>
  </body>

  <!-- Edit Data Modal -->
  <div
    class="modal fade"
    id="editReturningDetail"
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
        <form action="/user/update_detail_retur" method="post">
          <div class="modal-body">
            <input
              type="hidden"
              name="idRetur"
              id="idRetur"
              class="form-control"
              value="<?=$id_retur;?>"
              required
            />

            <div class="form-group">
                <label for="idBarang">Nama Barang</label>
                <select
                    class="form-control"
                    name="idBarang"
                    id="idBarang"
                    required
                >
                <?php foreach ($stock as $stk) : ?>
                    <option value="<?= $stk['id_barang']; ?>">
                    <?= ucwords($stk['nama_barang']); ?>
                    </option>
                <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="qtyRetur">QTY Retur</label>
                  <input
                    type="number"
                    min="0"
                    name="qtyRetur"
                    id="qtyRetur"
                    class="form-control"
                    required
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="hargaSatuan">Harga Satuan</label>
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
                type="text"
                name="keterangan"
                id="keterangan"
                placeholder="Keterangan Retur Barang..."
                class="form-control"
                required
                maxlength="16"
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
              name="editReturningDetail"
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
    id="filterReturningModal"
    tabindex="-1"
    aria-labelledby="filterModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">
            Filter Data Retur Barang
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
          <form action='/user/retur' method="post">
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
                <div class="form-group">
                  <label for="idSupplier">Filter Data by <b>Nama Supplier</b> :</label>
                  <select
                    class="form-control"
                    name="idSupplier"
                    id="idSupplier"
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
                  <label for="idUser">Filter Data by <b>Nama Petugas</b> :</label>
                  <select
                    class="form-control"
                    name="idUser"
                    id="idUser"
                  >
                  <option value="">-- Pilih Nama Petugas --</option>
                  <?php foreach ($user as $usr) : ?>
                    <option value="<?= $usr['id_user']; ?>">
                      <?= ucwords($usr['nama_lengkap']); ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                </div>
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
          <a class="btn btn-danger" href="<?php echo site_url('/user/logout');?>">
            <i class="fas fa-power-off"></i> Logout
          </a>
        </div>
      </div>
    </div>
  </div>
</html>
