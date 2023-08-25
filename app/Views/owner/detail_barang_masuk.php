<?= $this->extend('layout/template_owner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <?= form_open('owner/save_detail_masuk', ['class' => 'formSimpanBarangMasuk']); ?>

  <?= csrf_field(); ?>

  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h3 class="text-gray-800 col-md-8">Detail Barang Masuk</h3>

    <a class="btn btn-danger btn-sm btnBack" href="/owner/masuk">
      <i class="fas fa-arrow-left"></i>
      Kembali
    </a>

    <button type="submit" class="btn btn-info btn-sm btnSave">
      <i class="fas fa-save"></i>
      Simpan Data
    </button>

  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Tambah Data Barang Masuk
      </h6>
    </div>

    <div class="card-body">
      <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable1">
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
          <input type="hidden" name="idMasuk[]" id="idMasuk[]" value="<?= $id_masuk; ?>" class="form-control" required />
          <tr>
            <td><select class="form-control" name="namaBarang[]" required>
                <?php foreach ($stock as $stk) : ?>
                  <option value="<?= $stk['id_barang']; ?>">
                    <?= ucwords($stk['nama_barang']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </td>
            <td><input type="number" min="0" name="jumlahBarang[]" class="form-control" required /></td>
            <td><input type="number" min="0" name="hargaSatuan[]" class="form-control" required /></td>
            <td><input type="textarea" name="keterangan[]" placeholder="Ket. Barang Masuk" class="form-control" required /></td>
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
            Detail Barang Masuk
          </h6><br>
        </div>

        <div class="col-md-1">
          <form action="/owner/print_masuk" method="post">
            <input type="hidden" name="idCetakMasuk" id="idCetakMasuk" class="form-control" value="<?= $id_masuk; ?>" required />
            <button type="submit" class="btn btn-success btn-sm btnPrint">
              <i class="fas fa-print"></i>
              Cetak
            </button>
          </form>
        </div>
      </div>

      <h6 class="m-0 font-weight-bold text-dark">No Faktur : <?= $no_faktur; ?></h6>
      <h6 class="m-0 font-weight-bold text-dark">Tanggal Transaksi : <?= $tgl_masuk; ?></h6>
      <h6 class="m-0 font-weight-bold text-dark">Nama Supplier : <?= $nama_supplier; ?></h6>
      <h6 class="m-0 font-weight-bold text-dark">Nama Petugas : <?= $nama_lengkap; ?></h6>
    </div>

    <div class="card-body">

      <div class="table-responsive table-striped">
        <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable2">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>QTY Masuk</th>
              <th>Harga Satuan</th>
              <th>Total Harga</th>
              <th>Keterangan</th>
              <th class="text-center">Aksi</th>
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
                  <?= $msk['nama_barang']; ?>
                </td>
                <td>
                  <?= $msk['qty_masuk']; ?>
                </td>
                <td>
                  <?= "Rp. " . number_format($msk['harga_satuan_masuk'], 2, ',', '.'); ?>
                </td>
                <td>
                  <?= "Rp. " . number_format($msk['total_harga_masuk'], 2, ',', '.'); ?>
                </td>
                <td>
                  <?= $msk['keterangan']; ?>
                </td>
                <td class="d-sm-flex justify-content-around align-items-center">
                  <button type="button" id="btnEdit" class="btn btn-warning mr-2" data-bs-toggle="modal" data-bs-target="#editIncomingDetail" data-id_barang="<?= $msk['id_barang']; ?>" data-qty_masuk="<?= $msk['qty_masuk']; ?>" data-harga_satuan="<?= $msk['harga_satuan_masuk']; ?>" data-keterangan="<?= $msk['keterangan']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tr>
            <td colspan="3" align="center"><b>Total Harga</b></td>
            <td colspan="3" align="center"><b><?= "Rp. " . number_format($grand_total, 2, ',', '.'); ?></b></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Edit Data Modal -->
<div class="modal fade" id="editIncomingDetail" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
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
      <form action="/owner/update_detail_masuk" method="post">
        <div class="modal-body">
          <input type="hidden" name="idMasuk" id="idMasuk" class="form-control" value="<?= $id_masuk; ?>" required />

          <div class="form-group">
            <label for="idBarang">Nama Barang</label>
            <select class="form-control" name="idBarang" id="idBarang" required>
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
                <label for="qtyMasuk">QTY Masuk</label>
                <input type="number" min="0" name="qtyMasuk" id="qtyMasuk" class="form-control" required />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="hargaSatuan">Harga Satuan</label>
                <input type="number" min="0" name="hargaSatuan" id="hargaSatuan" class="form-control" required />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan Barang Masuk..." class="form-control" required maxlength="16" />
          </div>
        </div>

        <div class="d-sm-flex modal-footer mb-4">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fas fa-trash"></i> Batal
          </button>
          <button type="submit" class="btn btn-warning" name="editIncomingDetail">
            <i class="fas fa-edit"></i> Edit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Filter Data Modal -->
<div class="modal fade" id="filterIncomingModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">
          Filter Data Barang Masuk
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action='/owner/masuk' method="post">
        <div class="modal-body">
          <label for="namaBarang">Filter Data by <b>Range of Date</b></label>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="date" name="tglMulai" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="date" name="tglSelesai" class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="idSupplier">Filter Data by <b>Nama Supplier</b> :</label>
                <select class="form-control" name="idSupplier" id="idSupplier">
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
                <select class="form-control" name="idUser" id="idUser">
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
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
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
  $(document).ready(function(e) {
    $('.btnTambahBarang').click(function(e) {
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

    $('.formSimpanBarangMasuk').submit(function(e) {
      e.preventDefault();

      $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
          $('.btnSave').attr('disable', 'disabled');
          $('.btnSave').html('<i class="fa fa-spin fa-spinner"></i>');
        },
        complete: function() {
          $('.btnSave').removeAttr('disable');
          $('.btnSave').html('<i class="fa fa-save"></i> Simpan Data');
        },
        success: function(response) {
          if (response.success) {
            window.location.href = ("<?= site_url('owner/masuk'); ?>");
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });
  });

  $(document).on('click', '.btnHapusBarang', function(e) {
    e.preventDefault();

    $(this).parents('tr').remove();
  });
</script>

<script type="text/javascript">
  $(document).on('click', '#btnEdit', function() {
    $('.modal-body #idBarang').val($(this).data('id_barang'));
    $('.modal-body #qtyMasuk').val($(this).data('qty_masuk'));
    $('.modal-body #hargaSatuan').val($(this).data('harga_satuan'));
    $('.modal-body #keterangan').val($(this).data('keterangan'));
  })
</script>

<script type="text/javascript">
  $('#dataTable1').DataTable({
    info: false,
    ordering: false,
    paging: false,
    searching: false,
    responsive: true
  });

  $('#dataTable2').DataTable({
    info: false,
    paging: false,
    searching: false,
    responsive: true
  });
</script>

<?= $this->endSection(); ?>