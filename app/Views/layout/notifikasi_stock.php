<!-- Notifikasi Alert Jika Stock Barang Habis -->
<?php foreach ($stock as $stk) : ?>
    <?php if ($stk['qty_stock'] < 1) : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            <strong>Perhatian !!! </strong>Stock Barang
            <strong><?= ucwords($stk['nama_barang']); ?> </strong>Sudah Habis
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Notifikasi Alert Jika Stock Barang Sedikit -->
<?php foreach ($stock as $stk) : ?>
    <?php if ($stk['qty_stock'] < 10 && $stk['qty_stock'] > 1) : ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            <strong>Perhatian !!! </strong>Stock Barang
            <strong><?= ucwords($stk['nama_barang']); ?> </strong>Tersisa Sedikit
        </div>
    <?php endif; ?>
<?php endforeach; ?>