<?= $this->extend('layout/template_owner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h3 class="mb-3 text-gray-800 col-md-8"><?= $title; ?></h3>

    <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#addIncoming">
      <i class="fas fa-plus"></i>
      <span class="d-none d-md-inline">Tambah Data</span>
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
      <?= $this->include("layout/notifikasi_stock"); ?>

      <div class="table-responsive table-striped">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>No Faktur</th>
              <th>Nama Supplier</th>
              <th>Tgl Masuk</th>
              <th>Petugas</th>
              <th>Jenis Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($masuk as $msk) : ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $msk['no_faktur']; ?>
                </td>
                <td>
                  <?= $msk['nama_supplier']; ?>
                </td>
                <td>
                  <?php
                  $date_masuk = date_create($msk['tgl_masuk']);
                  echo date_format($date_masuk, "d F Y"); ?>
                </td>
                <td>
                  <?= $msk['nama_lengkap']; ?>
                </td>
                <td>
                  Transaksi Barang Masuk
                </td>
                <td>
                  <?= form_open('/owner/detail_masuk'); ?>
                  <?= csrf_field(); ?>

                  <button type="button" id="btnEdit" class="btn btn-warning mr-2" data-bs-toggle="modal" data-bs-target="#editIncoming" data-id_masuk="<?= $msk['id_masuk']; ?>" data-no_faktur="<?= $msk['no_faktur']; ?>" data-id_supplier="<?= $msk['id_supplier']; ?>" data-id_user="<?= $msk['id_user']; ?>" data-tgl_masuk="<?= $msk['tgl_masuk']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>

                  <input type="hidden" name="idMasuk" id="idMasuk" class="form-control" value="<?= $msk['id_masuk']; ?>" required />

                  <input type="hidden" name="noFaktur" id="noFaktur" class="form-control" value="<?= $msk['no_faktur']; ?>" required />

                  <input type="hidden" name="namaSupplier" id="namaSupplier" class="form-control" value="<?= $msk['nama_supplier']; ?>" required />

                  <input type="hidden" name="namaUser" id="namaUser" class="form-control" value="<?= $msk['nama_lengkap']; ?>" required />

                  <input type="hidden" name="tglMasuk" id="tglMasuk" class="form-control" value="<?= $msk['tgl_masuk']; ?>" required />

                  <button type="submit" id="btnInfo" class="btn btn-info mr-2" href="/owner/detail_barang_masuk">
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
<div class="modal fade" id="addIncoming" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">
          Tambah Data Barang Masuk
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/owner/save_masuk'); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <input type="hidden" name="idMasuk" id="idMasuk" class="form-control" required />

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="noFaktur">No Faktur</label>
              <input type="text" name="noFaktur" id="noFaktur" placeholder="No Faktur Barang Keluar" class="form-control" required maxlength="16" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="idSupplier">Nama Supplier</label>
              <select class="form-control" name="idSupplier" id="idSupplier" required>
                <?php foreach ($supplier as $spy) : ?>
                  <option value="<?= $spy['id_supplier']; ?>">
                    <?= ucwords($spy['nama_supplier']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tanggalIncoming">Tanggal Masuk</label>
              <input type="date" name="tglIncoming" id="tglIncoming" class="form-control" required />
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
        <button type="submit" class="btn btn-success" name="addIncomingGoods">
          <i class="fas fa-plus"></i> Tambah
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<!-- Edit Data Modal -->
<div class="modal fade" id="editIncoming" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">
          Edit Data Barang Masuk
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/owner/update_masuk'); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <input type="hidden" name="idMasuk" id="idMasuk" class="form-control" required />

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="noFaktur">No Faktur</label>
              <input type="text" name="noFaktur" id="noFaktur" placeholder="No Faktur Barang Keluar" class="form-control" required maxlength="16" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="idSupplier">Nama Supplier</label>
              <select class="form-control" name="idSupplier" id="idSupplier" required>
                <?php foreach ($supplier as $spy) : ?>
                  <option value="<?= $spy['id_supplier']; ?>">
                    <?= ucwords($spy['nama_supplier']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tanggalIncoming">Tanggal Masuk</label>
              <input type="date" name="tglIncoming" id="tglIncoming" class="form-control" required />
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
        <button type="submit" class="btn btn-warning" name="editIncomingGoods">
          <i class="fas fa-edit"></i> Edit
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if (session()->get('incoming_message')) : ?>
    Swal.fire(
      'Data Barang Masuk',
      '<?= session()->getFlashdata('incoming_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('filter_incoming_message')) : ?>
    Swal.fire(
      'Data Barang Masuk',
      '<?= session()->getFlashdata('filter_incoming_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Data Barang Masuk',
      text: '<?= session()->getFlashdata('error'); ?>',
      footer: 'Terjadi Kesalahan Teknis, Coba Beberapa Saat Lagi'
    })
  <?php endif; ?>
</script>

<script type="text/javascript">
  $(document).on('click', '#btnEdit', function() {
    $('.modal-body #idMasuk').val($(this).data('id_masuk'));
    $('.modal-body #noFaktur').val($(this).data('no_faktur'));
    $('.modal-body #idSupplier').val($(this).data('id_supplier'));
    $('.modal-body #tglIncoming').val($(this).data('tgl_masuk'));
    $('.modal-body #idUser').val($(this).data('id_user'));
  })
</script>

<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });
</script>

<?= $this->endSection(); ?>