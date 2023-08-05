<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="" />
        <meta name="author" content="Andryan" />
        <link
        rel="icon"
        type="image/png"
        href="<?= base_url(); ?>/img/logo.png"
        />

        <title>Aplikasi Inventory - Toko Sukses</title>

        <!-- Custom fonts for this template-->
        <link
        href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet"
        type="text/css"
        />
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"
        />

        <!-- Custom styles for this template-->
        <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet" />

        <!-- template table bootstrap 4 -->
        <link
        href="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css"
        rel="stylesheet"
        />
    </head>
    
    <body>
    <table width="100%">
        <tr>
            <td style="text-align: center;">
                <span style="line-height: 1.5; font-weight: bold; font-size:xxx-large;">Toko Sukses</span><br>
                <span style="line-height: 1.5; font-weight: bold; font-size:xx-large;">Jalan Yos Sudarso, Pasar Permai Cikarang, Karangasih</span><br>
                <span style="line-height: 1.5; font-weight: bold; font-size:xx-large;">Kecamatan Cikarang, Kabupaten Bekasi</span><br>
            </td>
        </tr>
    </table>
    <br>
    
    <br>
    <hr style="line-height: 2;" class="line-title">
    <br>

    <table width="100%">
        <tr>
            <td style="text-align: left; margin: 15px;">
                <span style="line-height: 1.5; font-weight: bold; font-size:x-large;">Cikarang, <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    echo date("d F Y"); ?></span><br>
                <span style="line-height: 1.5; font-size:x-large;"><b>Perihal : Laporan Barang Keluar</b></span><br>
            </td>
        </tr>
    </table>
    <br>
    
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Tgl Keluar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Harga/Pcs</th>
                <th>QTY</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <?php 
            if(isset($keluar)){
                $i = 1;
                foreach($keluar as $klr) :
        ?>
        <tbody>
            <tr>
                <td><?= $i++;?></td>
                <td>
                    <?php
                        $date_keluar = date_create($klr['tgl_keluar']); 
                        echo date_format($date_keluar, "d F Y"); ?>
                </td>
                <td><?= $klr['nama_barang'];?></td>
                <td>
                    <?php if($klr['kategori'] == "bumbu") :?>
                    Bumbu Masakan
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "makanan_instan") :?>
                    Makanan Instan
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "makanan_ringan") :?>
                    Makanan Ringan
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "minuman") :?>
                    Minuman
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "sembako") :?>
                    Sembako
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "perlengkapan_mandi") :?>
                    Perlengkapan Mandi
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "perlengkapan_mencuci") :?>
                    Perlengkapan Mencuci
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "obat") :?>
                    Obat - Obatan
                    <?php endif; ?>

                    <?php if($klr['kategori'] == "lain_lain") :?>
                    Lain Lain
                    <?php endif; ?>
                </td>
                <td><?= $klr['keterangan'];?></td>
                <td><?= "Rp. " . number_format($klr['harga_satuan_keluar'], 2, ',', '.');?></td>
                <td><?= $klr['qty_keluar'];?></td>
                <td><?= "Rp. " . number_format(($klr['total_harga_keluar']), 2, ',', '.');?></td>
            </tr>
        </tbody>
        <?php 
            endforeach;
            }
        ?>
        <tr>
            <td colspan="5" align="center"><b>Total Harga</b></td>
            <td colspan="3" align="center"><b><?= "Rp. ". number_format($grand_total, 2, ',', '.'); ?></b></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    
    <table width="100%">
        <tr>
            <td style="text-align: right; margin: 15px;">
                <span style="line-height: 1.5; font-size:x-large;">Owner Toko Sukses,</span>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <span style="line-height: 1.5; font-size:x-large;"><b>Fendy Jay</b></span><br>
            </td>
        </tr>
    </table>
    
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

     <!-- Core plugin Data Table-->
    <script src="<?= base_url(); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/js/demo/datatables-demo.js"></script>

    <!-- JS Print Report-->
    <script type="text/javascript">
        window.print();
    </script>
    </body>
</html>