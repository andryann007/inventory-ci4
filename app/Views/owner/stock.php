<?= $this->extend('layout/template_owner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div style="justify-content: space-between; align-items: center; margin-bottom:10px;" class="d-none d-flex">
    <h3 class="mb-3 text-gray-800 col-md-6"><?= $title; ?></h3>

    <button type="button" class="btn btn-success btn-md mr-2" data-bs-toggle="modal" data-bs-target="#addStockModal">
      <i class="fas fa-plus"></i>
      <span class="d-none d-md-inline">Tambah Data</span>
    </button>

    <button type="button" class="btn btn-primary btn-md mr-2" data-bs-toggle="modal" data-bs-target="#filterStockModal">
      <i class="fas fa-filter"></i>
      <span class="d-none d-md-inline">Filter Data</span>
    </button>

    <a href="<?php echo site_url('/owner/stock'); ?>" class="btn btn-dark btn-md" role="button"><i class="fas fa-eye"></i> <span class="d-none d-md-inline">All Data</span></a>

  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Data - Data Stock Barang
      </h6>
    </div>

    <div class="card-body">
      <?= $this->include("layout/notifikasi_stock"); ?>

      <div class="table-responsive table-striped">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Harga/Pcs</th>
              <th>QTY</th>
              <th>Total Harga</th>
              <th>Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($stock as $stk) : ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= ucwords($stk['nama_barang']); ?>
                </td>

                <td>
                  <?php if ($stk['kategori'] == "bumbu") : ?>
                    Bumbu Masakan
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "makanan_instan") : ?>
                    Makanan Instan
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "makanan_ringan") : ?>
                    Makanan Ringan
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "minuman") : ?>
                    Minuman
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "sembako") : ?>
                    Sembako
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "perlengkapan_mandi") : ?>
                    Perlengkapan Mandi
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "perlengkapan_mencuci") : ?>
                    Perlengkapan Mencuci
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "obat") : ?>
                    Obat - Obatan
                  <?php endif; ?>

                  <?php if ($stk['kategori'] == "lain_lain") : ?>
                    Lain Lain
                  <?php endif; ?>
                </td>
                <td>
                  <?= "Rp. " . number_format($stk['harga_satuan'], 2, ',', '.'); ?>
                </td>
                <td>
                  <?= $stk['qty_stock']; ?>
                </td>
                <td>
                  <?= "Rp. " . number_format($stk['qty_stock'] * $stk['harga_satuan'], 2, ',', '.'); ?>
                </td>
                <td>
                  <?php if ($stk['status'] == "tersedia") : ?>
                    Tersedia
                  <?php endif; ?>

                  <?php if ($stk['status'] == 'habis') : ?>
                    Habis
                  <?php endif; ?>
                </td>
                <td class="d-sm-flex justify-content-around align-items-center">
                  <button type="button" class="btn btn-warning mr-2" id="btnEdit" data-bs-toggle="modal" data-bs-target="#editStockModal" data-id="<?= $stk['id_barang']; ?>" data-nama="<?= $stk['nama_barang']; ?>" data-kategori="<?= $stk['kategori']; ?>" data-qty="<?= $stk['qty_stock']; ?>" data-harga="<?= $stk['harga_satuan']; ?>" data-total_harga="<?= $stk['total_harga']; ?>" data-status="<?= $stk['status']; ?>">
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
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">
          Tambah Data Stock Barang
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/owner/save_stock'); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <input type="hidden" name="idBarang" id="idBarang" class="form-control" />

        <div class="form-group">
          <label for="namaBarang">Nama Barang</label>
          <input type="text" name="namaBarang" id="namaBarang" class="form-control" required />
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jumlahBarang">Jumlah Barang</label>
              <input type="number" name="jumlahBarang" id="jumlahBarang" class="form-control" required />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="hargaSatuan">Harga Satuan</label>
              <input type="number" name="hargaSatuan" id="hargaSatuan" class="form-control" required />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="kategoriBarang">Kategori Barang</label>
              <select class="form-control" name="kategoriBarang" id="kategoriBarang">
                <option value="bumbu">Bumbu</option>
                <option value="makanan_instan">Makanan Instan</option>
                <option value="makanan_ringan">Makanan Ringan</option>
                <option value="minuman">Minuman</option>
                <option value="perlengkapan_mandi">Perlengkapan Mandi</option>
                <option value="perlengkapan_rumah">Perlengkapan Rumah</option>
                <option value="sembako">Sembako</option>
                <option value="obat">Obat - Obatan</option>
                <option value="lain_lain">Lain - Lain</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="status">Status Barang</label>
              <select class="form-control" name="status" id="status">
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="d-sm-flex modal-footer mb-4">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="fas fa-trash"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary" name="addStock">
          <i class="fas fa-plus"></i> Tambah
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<!-- Edit Data Modal -->
<div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">
          Edit Data Stock Barang
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/owner/update_stock'); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <input type="hidden" name="idBarang" id="idBarang" class="form-control" />

        <div class="form-group">
          <label for="namaBarang">Nama Barang</label>
          <input type="text" name="namaBarang" id="namaBarang" class="form-control" required />
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jumlahBarang">Jumlah Barang</label>
              <input type="number" name="jumlahBarang" id="jumlahBarang" class="form-control" min="0" required />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="hargaSatuan">Harga Satuan</label>
              <input type="number" name="hargaSatuan" id="hargaSatuan" class="form-control" required />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="kategoriBarang">Kategori Barang</label>
              <select class="form-control" name="kategoriBarang" id="kategoriBarang">
                <option value="bumbu">Bumbu</option>
                <option value="makanan_instan">Makanan Instan</option>
                <option value="makanan_ringan">Makanan Ringan</option>
                <option value="minuman">Minuman</option>
                <option value="perlengkapan_mandi">Perlengkapan Mandi</option>
                <option value="perlengkapan_rumah">Perlengkapan Rumah</option>
                <option value="sembako">Sembako</option>
                <option value="obat">Obat - Obatan</option>
                <option value="lain_lain">Lain - Lain</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="status">Status Barang</label>
              <select class="form-control" name="status" id="status">
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="d-sm-flex modal-footer mb-4">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="fas fa-trash"></i> Batal
        </button>
        <button type="submit" class="btn btn-warning" name="editStock">
          <i class="fas fa-edit"></i> Edit
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<!-- Filter Data Modal -->
<div class="modal fade" id="filterStockModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">
          Filter Data Stock Barang
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('/owner/stock'); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="kategoriBarang">Filter Data by <b>Kategori</b></label>
          <select class="form-control" name="kategoriBarang" id="kategoriBarang">
            <option value="">-- Pilih Kategori Barang --</option>
            <option value="bumbu">Bumbu</option>
            <option value="makanan_instan">Makanan Instan</option>
            <option value="makanan_ringan">Makanan Ringan</option>
            <option value="minuman">Minuman</option>
            <option value="perlengkapan_mandi">Perlengkapan Mandi</option>
            <option value="perlengkapan_rumah">Perlengkapan Rumah</option>
            <option value="sembako">Sembako</option>
            <option value="obat">Obat - Obatan</option>
            <option value="lain_lain">Lain - Lain</option>
          </select>
        </div>

        <div class="form-group">
          <label for="status">Filter Data by <b>Status<b></label>
          <select class="form-control" name="status" id="status">
            <option value="">-- Pilih Status Barang --</option>
            <option value="tersedia">Tersedia</option>
            <option value="habis">Habis</option>
          </select>
        </div>
      </div>

      <div class="d-sm-flex modal-footer mb-4">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="fas fa-trash"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary" name="filterStock">
          <i class="fas fa-filter"></i> Filter
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if (session()->get('stock_message')) : ?>
    Swal.fire(
      'Data Stock Barang',
      '<?= session()->getFlashdata('stock_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('filter_stock_message')) : ?>
    Swal.fire(
      'Data Stock Barang',
      '<?= session()->getFlashdata('filter_stock_message'); ?>',
      'success'
    )
  <?php endif; ?>

  <?php if (session()->get('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Data Stock Barang',
      text: '<?= session()->getFlashdata('error'); ?>',
      footer: 'Terjadi Kesalahan Teknis, Coba Beberapa Saat Lagi'
    })
  <?php endif; ?>
</script>

<script type="text/javascript">
  $(document).on('click', '#btnEdit', function() {
    $('.modal-body #idBarang').val($(this).data('id'));
    $('.modal-body #namaBarang').val($(this).data('nama'));
    $('.modal-body #kategoriBarang').val($(this).data('kategori'));
    $('.modal-body #jumlahBarang').val($(this).data('qty'));
    $('.modal-body #hargaSatuan').val($(this).data('harga'));
    $('.modal-body #totalHarga').val($(this).data('total_harga'));
    $('.modal-body #status').val($(this).data('status'));
  })
</script>

<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });
</script>

<?= $this->endSection(); ?>