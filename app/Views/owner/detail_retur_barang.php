<?= $this->extend('layout/template_owner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <?= form_open('owner/save_detail_retur', ['class' => 'formSimpanReturBarang']); ?>

  <?= csrf_field(); ?>

  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h3 class="text-gray-800 col-md-8">Detail Retur Barang</h3>

    <a class="btn btn-danger btn-md mr-2 btnBack" href="/owner/retur">
      <i class="fas fa-arrow-left"></i>
      <span class="d-none d-md-inline">Kembali</span>
    </a>

    <button type="submit" class="btn btn-info btn-md btnSave">
      <i class="fas fa-save"></i>
      <span class="d-none d-md-inline">Simpan</span>
    </button>

  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Tambah Data Retur Barang
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
          <input type="hidden" name="idRetur[]" id="idRetur[]" value="<?= $id_retur; ?>" class="form-control" required />
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
      <div style="justify-content: space-between; align-items: center;" class="d-none d-flex">
        <h6 class="font-weight-bold text-primary col-md-8">
          Detail Retur Barang
        </h6>

        <?= form_open('/owner/print_retur'); ?>
        <?= csrf_field(); ?>
        <input type="hidden" name="idCetakRetur" id="idCetakRetur" class="form-control" value="<?= $id_retur; ?>" required />
        <button type="submit" class="btn btn-success btn-md btnPrint">
          <i class="fas fa-print"></i>
          <span class="d-none d-md-inline">Cetak</span>
        </button>
        <?= form_close(); ?>
      </div>

      <h6 class="font-weight-bold text-dark col-md-8 mt-3">No Faktur : <?= $no_faktur; ?></h6>
      <h6 class="font-weight-bold text-dark col-md-8">Tanggal Transaksi : <?= $tgl_retur; ?></h6>
      <h6 class="font-weight-bold text-dark col-md-8">Nama Supplier : <?= $nama_supplier; ?></h6>
      <h6 class="font-weight-bold text-dark col-md-8">Nama Petugas : <?= $nama_lengkap; ?></h6>
    </div>

    <div class="card-body">

      <div class="table-responsive table-striped">
        <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable2">
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
            <?php $i = 1; ?>
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
                <td class="d-sm-flex justify-content-around align-items-center">
                  <button type="button" id="btnEdit" class="btn btn-warning mr-2" data-bs-toggle="modal" data-bs-target="#editReturningDetail" data-id_barang="<?= $rtr['id_barang']; ?>" data-qty_retur="<?= $rtr['qty_retur']; ?>" data-harga_satuan="<?= $rtr['harga_satuan_retur']; ?>" data-keterangan="<?= $rtr['keterangan']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">
                <h5 style="text-align: center;"><b>Total Harga</b></h5>
              </td>
              <td colspan="4"><b>
                  <h5 style="text-align: center;"><?= "Rp. " . number_format($grand_total, 2, ',', '.'); ?>
                </b></h5>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Edit Data Modal -->
<div class="modal fade" id="editReturningDetail" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">
          Edit Data Retur Barang
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/owner/update_detail_retur'); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <input type="hidden" name="idRetur" id="idRetur" class="form-control" value="<?= $id_retur; ?>" required />

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
              <label for="qtyRetur">QTY Retur</label>
              <input type="number" min="0" name="qtyRetur" id="qtyRetur" class="form-control" required />
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
          <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan Retur Barang..." class="form-control" required maxlength="16" />
        </div>
      </div>

      <div class="d-sm-flex modal-footer mb-4">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="fas fa-trash"></i> Batal
        </button>
        <button type="submit" class="btn btn-warning" name="editReturningDetail">
          <i class="fas fa-edit"></i> Edit
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if (session()->get('returning_message')) : ?>
    Swal.fire(
      'Data Retur Barang',
      '<?= session()->getFlashdata('returning_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('filter_returning_message')) : ?>
    Swal.fire(
      'Data Retur Barang',
      '<?= session()->getFlashdata('filter_returning_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Data Retur Barang',
      text: '<?= session()->getFlashdata('error'); ?>',
      footer: 'Dikarenakan QTY Stock < QTY Retur'
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

    $('.formSimpanReturBarang').submit(function(e) {
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
            window.location.href = ("<?= site_url('owner/retur'); ?>");
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
    $('.modal-body #qtyRetur').val($(this).data('qty_retur'));
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