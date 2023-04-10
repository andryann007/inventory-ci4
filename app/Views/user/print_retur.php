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
                <span style="line-height: 1.5; font-weight: bold; font-size:x-large;">Cikarang, <?= date("d-m-Y");?></span><br>
                <span style="line-height: 1.5; font-size:x-large;">Perihal : <b>Laporan Retur Barang</b></span><br>
            </td>
        </tr>
    </table>
    <br>
    
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Tgl Retur</th>
                <th>Nama Barang</th>
                <th>Nama Supplier</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Harga/Pcs</th>
                <th>QTY</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <?php 
            if(isset($retur)){
                $i = 1;
                foreach($retur as $rtr) :
        ?>
        <tbody>
            <tr>
                <th><?= $i++;?></th>
                <th><?= $rtr['tgl_retur'];?></th>
                <th><?= $rtr['nama_barang'];?></th>
                <th><?= $rtr['nama_supplier'];?></th>
                <th><?= $rtr['kategori'];?></th>
                <th><?= $rtr['keterangan'];?></th>
                <th><?= "Rp. " . number_format($rtr['harga_satuan_retur'], 2, ',', '.');?></th>
                <th><?= $rtr['qty_retur'];?></th>
                <th><?= "Rp. " . number_format($rtr['total_harga_retur'], 2, ',', '.');?></th>
            </tr>
        </tbody>
        <?php 
            endforeach;
            }
        ?>
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