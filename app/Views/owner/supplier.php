<?= $this->extend('layout/template_owner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h3 class="mb-3 text-gray-800 col-md-8"><?= $title; ?></h3>

    <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
      <i class="fas fa-plus"></i>
      <span class="d-none d-md-inline">Tambah Data</span>
    </button>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Data - Data Supplier
      </h6>
    </div>

    <div class="card-body">
      <?= $this->include("layout/notifikasi_stock"); ?>

      <div class="table-responsive table-striped">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>Nama Supplier</th>
              <th>Alamat</th>
              <th>Email</th>
              <th>No. Telp</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($supplier as $s) : ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $s['nama_supplier']; ?>
                </td>
                <td>
                  <?= $s['alamat']; ?>
                </td>
                <td>
                  <?= $s['email']; ?>
                </td>
                <td>
                  <?= $s['telp']; ?>
                </td>
                <td class="d-sm-flex justify-content-around align-items-center">
                  <button type="button" class="btn btn-warning" id="btnEdit" data-bs-toggle="modal" data-bs-target="#editSupplierModal" data-id="<?= $s['id_supplier']; ?>" data-nama="<?= $s['nama_supplier']; ?>" data-email="<?= $s['email']; ?>" data-alamat="<?= $s['alamat']; ?>" data-telp="<?= $s['telp']; ?>">
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
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah Data Supplier</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action='/owner/save_supplier' method="post">
        <div class="modal-body">
          <input type="hidden" name="idSupplier" id="idSupplier" class="form-control" required />

          <div class="form-group">
            <label for="namaSupplier">Nama Supplier</label>
            <input type="text" name="namaSupplier" id="namaSupplier" class="form-control" required />
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="telpSupplier">No. Telp Supplier</label>
                <input type="telp" name="telpSupplier" id="telpSupplier" class="form-control" required />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="emailSupplier">Email Supplier</label>
                <input type="email" name="emailSupplier" id="emailSupplier" class="form-control" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="alamatSupplier">Alamat Supplier</label>
            <input type="text" name="alamatSupplier" id="alamatSupplier" class="form-control" required />
          </div>
        </div>
        <div class="d-sm-flex modal-footer mb-4">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fas fa-trash"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary" name="addNewSupplier">
            <i class="fas fa-plus"></i> Tambah
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Edit Data Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Supplier</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action='/owner/update_supplier' method="post">
        <div class="modal-body">
          <input type="hidden" name="idSupplier" id="idSupplier" class="form-control" required />

          <div class="form-group">
            <label for="namaSupplier">Nama Supplier</label>
            <input type="text" name="namaSupplier" id="namaSupplier" class="form-control" required />
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="telpSupplier">No. Telp Supplier</label>
                <input type="telp" name="telpSupplier" id="telpSupplier" class="form-control" required />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="emailSupplier">Email Supplier</label>
                <input type="email" name="emailSupplier" id="emailSupplier" class="form-control" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="alamatSupplier">Alamat Supplier</label>
            <input type="text" name="alamatSupplier" id="alamatSupplier" class="form-control" required />
          </div>
        </div>
        <div class="d-sm-flex modal-footer mb-4">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fas fa-trash"></i> Batal
          </button>
          <button type="submit" class="btn btn-warning" name="addNewSupplier">
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
      'Data Supplier',
      '<?= session()->getFlashdata('message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Data Supplier',
      text: '<?= session()->getFlashdata('error'); ?>',
      footer: 'Terjadi Kesalahan Teknis, Coba Beberapa Saat Lagi'
    })
  <?php endif; ?>
</script>

<script type="text/javascript">
  $(document).on('click', '#btnEdit', function() {
    $('.modal-body #idSupplier').val($(this).data('id'));
    $('.modal-body #namaSupplier').val($(this).data('nama'));
    $('.modal-body #alamatSupplier').val($(this).data('alamat'));
    $('.modal-body #emailSupplier').val($(this).data('email'));
    $('.modal-body #telpSupplier').val($(this).data('telp'));
  })
</script>

<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });
</script>

<?= $this->endSection(); ?>