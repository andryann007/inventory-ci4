<?= $this->extend('layout/template_user'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h3 class="mb-3 text-gray-800 col-md-6"><?= $title; ?></h3>

    <button type="button" class="btn btn-success btn-md mr-2" data-bs-toggle="modal" data-bs-target="#printReturning">
      <i class="fas fa-print"></i>
      <span class="d-none d-md-inline">Print Data</span>
    </button>

    <button type="button" class="btn btn-primary btn-md mr-2" data-bs-toggle="modal" data-bs-target="#filterReturning">
      <i class="fas fa-filter"></i>
      <span class="d-none d-md-inline">Filter Data</span>
    </button>

    <?= form_open('/user/laporan_retur'); ?>
    <?= csrf_field(); ?>
    <button type="submit" class="btn btn-dark btn-md"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">All Data</span></button>
    <?= form_close(); ?>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Laporan Retur Barang
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
              <th>Tgl Masuk</th>
              <th>Nama Supplier</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>QTY Barang</th>
              <th>Harga Satuan</th>
              <th>Total Harga</th>
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
                  <?= $rtr['no_faktur']; ?>
                </td>
                <td>
                  <?php
                  $date_retur = date_create($rtr['tgl_retur']);
                  echo date_format($date_retur, "d F Y"); ?>
                </td>
                <td>
                  <?= $rtr['nama_supplier']; ?>
                </td>
                <td>
                  <?= $rtr['nama_barang']; ?>
                </td>
                <td>
                  <?php if ($rtr['kategori'] == "bumbu") : ?>
                    Bumbu Masakan
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "makanan_instan") : ?>
                    Makanan Instan
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "makanan_ringan") : ?>
                    Makanan Ringan
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "minuman") : ?>
                    Minuman
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "sembako") : ?>
                    Sembako
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "perlengkapan_mandi") : ?>
                    Perlengkapan Mandi
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "perlengkapan_mencuci") : ?>
                    Perlengkapan Mencuci
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "obat") : ?>
                    Obat - Obatan
                  <?php endif; ?>

                  <?php if ($rtr['kategori'] == "lain_lain") : ?>
                    Lain Lain
                  <?php endif; ?>
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
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Filter Data Modal -->
<div class="modal fade" id="filterReturning" tabindex="-1" aria-labelledby="filterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterLabel">
          Filter Data Retur Barang
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/user/laporan_retur'); ?>
      <?= csrf_field(); ?>
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
              <label for="namaSupplier">Filter Data by <b>Nama Supplier</b> :</label>
              <select class="form-control" name="namaSupplier" id="namaSupplier">
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
              <label for="namaBarang">Filter Data by <b>Nama Barang</b> :</label>
              <select class="form-control" name="namaBarang" id="namaBarang">
                <option value="">-- Pilih Nama Barang --</option>
                <?php foreach ($stock as $stk) : ?>
                  <option value="<?= $stk['id_barang']; ?>">
                    <?= ucwords($stk['nama_barang']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <label for="keterangan"><b>Note :</b> Filter Dapat Dilakukan Satu - Satu / Semua !!!</label>
          </div>

        </div>
      </div>

      <div class="d-sm-flex modal-footer mb-4">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="fas fa-trash"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary" name="filterReturning">
          <i class="fas fa-filter"></i> Filter
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<!-- Print Data Modal -->
<div class="modal fade" id="printReturning" tabindex="-1" aria-labelledby="printLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printLabel">
          Print Data Retur Barang
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/user/print_retur'); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <label for="namaBarang">Print Data <b>Filter Range of Date</b></label>
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
              <label for="namaSupplier">Print Data <b>Filter Nama Supplier</b> :</label>
              <select class="form-control" name="namaSupplier" id="namaSupplier">
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
              <label for="namaBarang">Print Data <b>Filter Nama Barang</b> :</label>
              <select class="form-control" name="namaBarang" id="namaBarang">
                <option value="">-- Pilih Nama Barang --</option>
                <?php foreach ($stock as $stk) : ?>
                  <option value="<?= $stk['id_barang']; ?>">
                    <?= ucwords($stk['nama_barang']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-md-12">
            <label for="keterangan"><b>Note :</b> Filter Dapat Dilakukan Satu - Satu / Semua, Untuk Opsi Filter Print Bersifat Optional (Tidak Wajib).<br>
              Jika Tidak Ada Filter, Maka Laporan Retur Barang akan di <b>Print Semua !!!</b></label>
          </div>

        </div>
      </div>

      <div class="d-sm-flex modal-footer mb-4">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="fas fa-trash"></i> Batal
        </button>
        <button type="submit" class="btn btn-success" name="printReturning">
          <i class="fas fa-print"></i> Print
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if (session()->get('returning_message')) : ?>
    Swal.fire(
      'Laporan Retur Barang',
      '<?= session()->getFlashdata('returning_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('filter_returning_message')) : ?>
    Swal.fire(
      'Laporan Retur Barang',
      '<?= session()->getFlashdata('filter_returning_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Laporan Retur Barang',
      text: '<?= session()->getFlashdata('error'); ?>',
      footer: 'Dikarenakan QTY Stock < QTY Retur'
    })
  <?php endif; ?>
</script>

<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });
</script>

<?= $this->endSection(); ?>