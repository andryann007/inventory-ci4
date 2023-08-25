<?= $this->extend('layout/template_user'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h3 class="mb-3 text-gray-800 col-md-8"><?= $title; ?></h3>

    <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#addOutcoming">
      <i class="fas fa-plus"></i>
      <span class="d-none d-md-inline">Tambah Data</span>
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
      <?= $this->include("layout/notifikasi_stock"); ?>

      <div class="table-responsive table-striped">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>No Faktur</th>
              <th>Tgl Keluar</th>
              <th>Petugas</th>
              <th>Jenis Transaksi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($keluar as $klr) : ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $klr['no_faktur']; ?>
                </td>
                <td>
                  <?php
                  $date_keluar = date_create($klr['tgl_keluar']);
                  echo date_format($date_keluar, "d F Y"); ?>
                </td>
                <td>
                  <?= $klr['nama_lengkap']; ?>
                </td>
                <td>
                  Transaksi Barang Keluar
                </td>
                <td class="d-sm-flex" style="justify-content: center;">
                  <?= form_open('/user/detail_keluar'); ?>
                  <?= csrf_field(); ?>
                  <button type="button" id="btnEdit" class="btn btn-warning mr-2" data-bs-toggle="modal" data-bs-target="#editOutcoming" data-id_keluar="<?= $klr['id_keluar']; ?>" data-no_faktur="<?= $klr['no_faktur']; ?>" data-id_user="<?= $klr['id_user']; ?>" data-tgl_keluar="<?= $klr['tgl_keluar']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <input type="hidden" name="idKeluar" id="idKeluar" class="form-control" value="<?= $klr['id_keluar']; ?>" required />

                  <input type="hidden" name="noFaktur" id="noFaktur" class="form-control" value="<?= $klr['no_faktur']; ?>" required />

                  <input type="hidden" name="namaUser" id="namaUser" class="form-control" value="<?= $klr['nama_lengkap']; ?>" required />

                  <input type="hidden" name="tglKeluar" id="tglKeluar" class="form-control" value="<?= $klr['tgl_keluar']; ?>" required />

                  <button type="submit" id="btnInfo" class="btn btn-info mr-2" href="/user/detail_barang_keluar">
                    <i class="fas fa-info-circle"></i>
                  </button>
                  <?= form_close(); ?>
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
<div class="modal fade" id="addOutcoming" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">
          Tambah Data Barang Keluar
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/user/save_keluar" method="post">
        <div class="modal-body">
          <input type="hidden" name="idKeluar" id="idKeluar" class="form-control" required />

          <div class="form-group">
            <label for="noFaktur">No Faktur</label>
            <input type="text" name="noFaktur" id="noFaktur" placeholder="No Faktur Barang Keluar" class="form-control" required maxlength="16" />
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tanggalOutcoming">Tanggal Keluar</label>
                <input type="date" name="tglOutcoming" id="tglOutcoming" class="form-control" required />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="idUser">Nama Petugas</label>
                <select class="form-control" name="idUser" id="idUser" required>
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
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fas fa-trash"></i> Batal
          </button>
          <button type="submit" class="btn btn-success" name="addOutcomingGoods">
            <i class="fas fa-plus"></i> Tambah
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Data Modal -->
<div class="modal fade" id="editOutcoming" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">
          Edit Data Barang Keluar
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/user/update_keluar" method="post">
        <div class="modal-body">
          <input type="hidden" name="idKeluar" id="idKeluar" class="form-control" required />

          <div class="form-group">
            <label for="noFaktur">No Faktur</label>
            <input type="text" name="noFaktur" id="noFaktur" placeholder="No Faktur Barang Keluar" class="form-control" required maxlength="16" />
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="tglOutcoming">Tanggal Keluar</label>
                <input type="date" name="tglOutcoming" id="tglOutcoming" class="form-control" required />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="idUser">Nama Petugas</label>
                <select class="form-control" name="idUser" id="idUser" required>
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
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fas fa-trash"></i> Batal
          </button>
          <button type="submit" class="btn btn-warning" name="editOutcomingGoods">
            <i class="fas fa-edit"></i> Edit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if (session()->get('outcoming_message')) : ?>
    Swal.fire(
      'Data Barang Keluar',
      '<?= session()->getFlashdata('outcoming_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('filter_outcoming_message')) : ?>
    Swal.fire(
      'Data Barang Keluar',
      '<?= session()->getFlashdata('filter_outcoming_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Data Barang Keluar',
      text: '<?= session()->getFlashdata('error'); ?>',
      footer: 'Dikarenakan QTY Stock < QTY Keluar'
    })
  <?php endif; ?>
</script>

<script type="text/javascript">
  $(document).on('click', '#btnEdit', function() {
    $('.modal-body #idKeluar').val($(this).data('id_keluar'));
    $('.modal-body #noFaktur').val($(this).data('no_faktur'));
    $('.modal-body #tglOutcoming').val($(this).data('tgl_keluar'));
    $('.modal-body #idUser').val($(this).data('id_user'));
  })
</script>

<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });
</script>

<?= $this->endSection(); ?>