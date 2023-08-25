<?= $this->extend('layout/template_owner'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <?= $this->include("layout/notifikasi_stock"); ?>

  <!-- Data Master -->
  <div class="col bg-dark">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <h1 class="h4 mt-2 text-light">Data Master</h1>
    </div>

    <div class="row">
      <!-- Data Akun -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Data Akun</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_akun; ?> Data</b></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-id-card fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Stock -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Data Stock Barang</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_stock; ?> Data</b></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-cubes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Supplier -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Data Supplier</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_supplier; ?> Data</b></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-truck fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Data Transaksi -->
  <div class="col bg-dark">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <h1 class="h4 mt-2 text-light">Data Transaksi</h1>
    </div>

    <div class="row">
      <!-- Data Barang Masuk -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Data Barang Masuk</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_barang_masuk; ?> Data</b></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-arrow-left fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Barang Keluar -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Data Barang Keluar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_barang_keluar; ?> Data</b></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-arrow-right fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Retur Barang -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Data Retur Barang</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $data_retur_barang; ?> Data</b></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-reply fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php if (session()->get('message')) : ?>
    Swal.fire(
      'Berhasil Login',
      '<?= session()->getFlashdata('message'); ?>',
      'success'
    )
  <?php endif; ?>
</script>

<script type="text/javascript">
  $('#dataTable').DataTable({
    responsive: true
  });
</script>

<?= $this->endSection(); ?>