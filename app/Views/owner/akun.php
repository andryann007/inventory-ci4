<?= $this->extend('layout/template_owner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h2 class="h3 mb-3 text-gray-800 col-md-8"><?= $title; ?></h2>

    <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#addAccountModal">
      <i class="fas fa-plus"></i>
      <span class="d-none d-md-inline">Tambah Data</span>
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
      <?= $this->include("layout/notifikasi_stock"); ?>

      <div class="table-responsive table-striped">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Username</th>
              <th>Password</th>
              <th>Alamat Lengkap</th>
              <th>No. Telp</th>
              <th>Hak Akses</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
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
                  <?= $a['username']; ?>
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
                  <?php if ($a['tipe_akun'] == "owner") : ?>
                    Owner
                  <?php endif; ?>

                  <?php if ($a['tipe_akun'] == "admin") : ?>
                    Admin
                  <?php endif; ?>

                  <?php if ($a['tipe_akun'] == "user") : ?>
                    User
                  <?php endif; ?>
                </td>
                <td class="d-sm-flex justify-content-between align-items-center">

                  <button type="button" class="btn btn-warning mr-2" id="btnEdit" data-bs-toggle="modal" data-bs-target="#editAccountModal" data-id="<?= $a['id_user']; ?>" data-nama="<?= $a['nama_lengkap']; ?>" data-email="<?= $a['email']; ?>" data-username="<?= $a['username']; ?>" data-password="<?= $a['password']; ?>" data-alamat="<?= $a['alamat']; ?>" data-telp="<?= $a['telp']; ?>" data-tipe="<?= $a['tipe_akun']; ?>">
                    <i class="fas fa-edit"></i>
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

<!-- Add Data Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah Data Akun</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php $validation = \Config\Services::validation(); ?>

      <form action='/owner/save_akun' method="post">

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="namaUser">Nama Lengkap</label>
                <input type="text" name="namaUser" id="namaUser" class="form-control" required />
              </div>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="emailUser">Email</label>
                <input type="email" name="emailUser" id="emailUser" class="form-control" required />
              </div>

              <div class="form-group">
                <label for="passUser">Password</label>
                <div class="input-group" id="passwordVisibility1">
                  <input type="password" name="passUser" id="passUser" class="form-control" required />
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button" id="togglePassword1">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="telp">No. Telp</label>
                <input type="textarea" name="telpUser" id="telpUser" class="form-control" />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="tipeAkun">Tipe Akun</label>
                <select class="form-control" name="tipeAkunUser" id="tipeAkunUser" required>
                  <option value="owner">Owner</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="alamat">Alamat Lengkap</label>
            <input type="textarea" name="alamatUser" id="alamatUser" class="form-control" />
          </div>

        </div>

        <div class="d--sm-flex modal-footer mb-4">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
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

<!-- Edit Data Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Password User</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action='/owner/update_akun' method="post">

        <div class="modal-body">
          <input type="hidden" id="idUser" name="idUser" class="form-control" />

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="namaUser">Nama Lengkap</label>
                <input type="text" name="namaUser" id="namaUser" class="form-control" readonly />
              </div>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" readonly />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="emailUser">Email</label>
                <input type="email" name="emailUser" id="emailUser" class="form-control" readonly />
              </div>

              <div class="form-group">
                <label for="passUser">Password</label>
                <div class="input-group" id="passwordVisibility2">
                  <input type="password" name="passUser" id="passUser" class="form-control" required />
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button" id="togglePassword2">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="telp">No. Telp</label>
                <input type="text" name="telpUser" id="telpUser" class="form-control" readonly />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="tipeAkun">Tipe Akun</label>
                <input type="text" name="tipeAkunUser" id="tipeAkunUser" class="form-control" readonly />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="alamat">Alamat Lengkap</label>
            <input type="textarea" name="alamatUser" id="alamatUser" class="form-control" readonly />
          </div>

        </div>

        <div class="d--sm-flex modal-footer mb-4">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fas fa-trash"></i> Batal
          </button>
          <button type="submit" class="btn btn-warning" name="editAccount">
            <i class="fas fa-edit"></i> Edit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if (session()->get('message')) : ?>
    Swal.fire(
      'Data Akun',
      '<?= session()->getFlashdata('message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Data Akun',
      text: '<?= session()->getFlashdata('error'); ?>',
      footer: 'Terjadi Kesalahan Teknis, Coba Beberapa Saat Lagi'
    })
  <?php endif; ?>
</script>

<script type="text/javascript">
  $(document).on('click', '#btnEdit', function() {
    $('.modal-body #idUser').val($(this).data('id'));
    $('.modal-body #namaUser').val($(this).data('nama'));
    $('.modal-body #emailUser').val($(this).data('email'));
    $('.modal-body #username').val($(this).data('username'));
    $('.modal-body #passUser').val($(this).data('password'));
    $('.modal-body #telpUser').val($(this).data('telp'));
    $('.modal-body #alamatUser').val($(this).data('alamat'));
    $('.modal-body #tipeAkunUser').val($(this).data('tipe'));
  });
</script>

<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });
</script>

<?= $this->endSection(); ?>