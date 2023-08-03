<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\ReturModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class User extends BaseController
{
    protected $akunModel;
    protected $supplierModel;
    protected $stockModel;
    protected $masukModel;
    protected $keluarModel;
    protected $returModel;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
        $this->supplierModel = new SupplierModel();
        $this->stockModel = new StockModel();
        $this->masukModel = new MasukModel();
        $this->keluarModel = new KeluarModel();
        $this->returModel = new ReturModel();
    }

    public function index(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else {
            $data = [
                'data_barang_masuk' => $this->masukModel->qty_masuk(),
                'data_barang_keluar' => $this->keluarModel->qty_keluar(),
                'data_retur_barang' => $this->returModel->qty_retur(),
                'stock' => $this->stockModel->getData()
            ];
    
            return view('user/index', $data);
        }
    }

    public function masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idSupplier = $this->request->getPost('idSupplier');
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');

            // Jika hanya terdapat filter di rentang tanggal
            if($tglMulai !=null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika tidak terdapat filter
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori == null){
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('user/barang_masuk', $filterData);
        }
    }

    

    public function tambah_barang_masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else {
            $data = [
                'title' => 'Tambah Data Barang Keluar',
                'stock' => $this->stockModel->getData(),
                'supplier' => $this->supplierModel->getData()
            ];

            return view('user/tambah_barang_masuk', $data);
        }
    }

    public function save_masuk(){
        $db = \Config\Database::connect();
        $stock = $this->stockModel;

        if($this->request->isAJAX()){
            $idSupplier = $this->request->getVar('namaSupplier');
            $idBarang = $this->request->getVar('namaBarang');
            $tglMasuk = $this->request->getVar('tglIncoming');
            $qtyMasuk = $this->request->getVar('jumlahBarang');
            $hargaSatuan = $this->request->getVar('hargaSatuan');
            $keterangan = $this->request->getVar("keterangan");

            $jumlahData = count($idBarang);

            for($i=0; $i<$jumlahData; $i++){
                $dbStock[$i] = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang[$i]'");

                $row[$i] = $dbStock[$i]->getRowArray();
                $rowStock[$i] = $row[$i]['qty_stock'];
                $rowHargaSatuan[$i] = $row[$i]['harga_satuan'];

                $stockBaru[$i] = $rowStock[$i] + $qtyMasuk[$i];
                $totalHargaBaru[$i] = ($rowStock[$i] + $qtyMasuk[$i]) * $rowHargaSatuan[$i];
                
                $dataStock[$i] = array(
                    'qty_stock' => $stockBaru[$i],
                    'total_harga' => $totalHargaBaru[$i],
                    'status' => "Tersedia"
                );

                $stock->updateData($dataStock[$i], $idBarang[$i]);

                $db->table('data_barang_masuk')
                    -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang', 'inner')
                    -> insert([
                        'id_supplier' => $idSupplier[$i],
                        'id_barang' => $idBarang[$i],
                        'tgl_masuk' => $tglMasuk[$i],
                        'qty_masuk' => $qtyMasuk[$i],
                        'harga_satuan_masuk' => $hargaSatuan[$i],
                        'total_harga_masuk' => $qtyMasuk[$i] * $hargaSatuan[$i],
                        'keterangan' => $keterangan[$i]
                    ]);

                session()->setFlashdata('message', "$jumlahData Data Barang Masuk Berhasil di Tambah !!!");
            }
        }

        $msg = [
            'success' => 'Data Barang Masuk Berhasil di Proses'
        ];

        echo json_encode($msg);
    }

    public function update_masuk(){
        $db = \Config\Database::connect();
        $masuk = $this->masukModel;
        $stock = $this->stockModel;

        $idMasuk = $this->request->getPost('idMasuk');
        $idBarang = $this->request->getPost('namaBarang');

        $stockBarangMasukBaru = $this->request->getPost('jumlahBarang');
        
        $queryMasukLama = $db->query("SELECT qty_masuk FROM data_barang_masuk WHERE id_masuk = '$idMasuk'");
        $rowMasuk = $queryMasukLama->getRowArray();
        
        $queryStock = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $rowStock = $queryStock->getRowArray();

        $dataMasuk = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_masuk' => $this->request->getPost('tglIncoming'),
            'qty_masuk' => $this->request->getPost('jumlahBarang'),
            'harga_satuan_masuk' => $this->request->getPost('hargaSatuan'),
            'total_harga_masuk' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $dataStock = array(
            'qty_stock' => ((int)$rowStock['qty_stock'] - (int)$rowMasuk['qty_masuk']) + (int)$stockBarangMasukBaru,
            'total_harga' => (((int)$rowStock['qty_stock'] - (int)$rowMasuk['qty_masuk']) + (int)$stockBarangMasukBaru) * (int)$rowStock['harga_satuan']
        );
        
        $successUpdate = $masuk->updateData($dataMasuk, $idMasuk);
        $updateStock = $stock->updateData($dataStock, $idBarang);

        if($successUpdate & $updateStock){
            session()->setFlashdata('message', 'Data Barang Masuk Berhasil di Update !!! & Data Stock Berhasil di Update');
        } else {
            session()->setFlashdata('error', 'Data Barang Masuk Gagal di Update !!!');
        }

        return redirect()->to('/user/masuk');
    }

    public function keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData()
                ];
            } 
            
            //Jika hanya terdapat filter terhadap id barang
            else if($tglMulai == null && $tglSelesai == null && $idBarang != null && $kategori == null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData()
                ];
            } 

            //Jika hanya terdapat filter terhadap kategori
            else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData()
                ];
            } 
            
            //Jika hanya terdapat filter tanggal & filter id barang
            else if($tglMulai != null && $tglSelesai != null && $idBarang != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData()
                ];
            }

            //Jika hanya terdapat filter tanggal & filter kategori
            else if($tglMulai != null && $tglSelesai != null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData()
                ];
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori == null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
            }

            $filterData = $data;

            return view('user/barang_keluar', $filterData);
        }
    }

    public function tambah_barang_keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else {
            $data = [
                'title' => 'Tambah Data Barang Keluar',
                'stock' => $this->stockModel->getData()
            ];

            return view('user/tambah_barang_keluar', $data);
        }
    }

    public function save_keluar(){
        $db = \Config\Database::connect();
        $stock = $this->stockModel;

        if($this->request->isAJAX()){
            $idBarang = $this->request->getVar('namaBarang');
            $tglKeluar = $this->request->getVar('tglOutcoming');
            $qtyKeluar = $this->request->getVar('jumlahBarang');
            $hargaSatuan = $this->request->getVar('hargaSatuan');
            $keterangan = $this->request->getVar("keterangan");

            $jumlahData = count($idBarang);

            for($i=0; $i<$jumlahData; $i++){
                $dbStock[$i] = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang[$i]'");

                $row[$i] = $dbStock[$i]->getRowArray();
                $rowStock[$i] = $row[$i]['qty_stock'];
                $rowHargaSatuan[$i] = $row[$i]['harga_satuan'];

                $stockBaru[$i] = $rowStock[$i] - $qtyKeluar[$i];
                $totalHargaBaru[$i] = ($rowStock[$i] - $qtyKeluar[$i]) * $rowHargaSatuan[$i];
                
                if($stockBaru[$i] == 0){
                    $dataStock[$i] = array(
                        'qty_stock' => 0,
                        'total_harga' => $totalHargaBaru[$i],
                        'status' => "Habis"
                    );
                } else {
                    $dataStock[$i] = array(
                        'qty_stock' => $stockBaru[$i],
                        'total_harga' => $totalHargaBaru[$i]
                    );   
                }

                if($rowStock[$i] >= $qtyKeluar[$i]){
                    $stock->updateData($dataStock[$i], $idBarang[$i]);

                    $db->table('data_barang_keluar')
                        -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang', 'inner')
                        -> insert([
                            'id_barang' => $idBarang[$i],
                            'tgl_keluar' => $tglKeluar[$i],
                            'qty_keluar' => $qtyKeluar[$i],
                            'harga_satuan_keluar' => $hargaSatuan[$i],
                            'total_harga_keluar' => $qtyKeluar[$i] * $hargaSatuan[$i],
                            'keterangan' => $keterangan[$i]
                        ]);
                    session()->setFlashdata('message', "$jumlahData Data Barang Keluar Berhasil di Tambah !!!");
                } else if($rowStock[$i] < $qtyKeluar[$i]){
                    session()->setFlashdata('error', "Data Barang Keluar Gagal di Tambah (Karena QTY Stock < QTY Keluar) !!!");
                }
            }

            $msg = [
                'success' => 'Data Barang Keluar Berhasil di Proses'
            ];

            echo json_encode($msg);
        }
    }

    public function update_keluar(){
        $db = \Config\Database::connect();
        $keluar = $this->keluarModel;
        $stock = $this->stockModel;

        $idKeluar = $this->request->getPost('idKeluar');
        $idBarang = $this->request->getPost('namaBarang');

        $stockBarangKeluarBaru = $this->request->getPost('jumlahBarang');
        
        $queryKeluarLama = $db->query("SELECT qty_keluar FROM data_barang_keluar WHERE id_keluar = '$idKeluar'");
        $rowKeluar = $queryKeluarLama->getRowArray();
        
        $queryStock = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $rowStock = $queryStock->getRowArray();

        $dataKeluar = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'tgl_keluar' => $this->request->getPost('tglOutcoming'),
            'qty_keluar' => $this->request->getPost('jumlahBarang'),
            'harga_satuan_keluar' => $this->request->getPost('hargaSatuan'),
            'total_harga_keluar' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $stockBaru = ($rowStock['qty_stock'] + $rowKeluar['qty_keluar']) - $stockBarangKeluarBaru;
        $totalHargaBaru = (($rowStock['qty_stock'] + $rowKeluar['qty_keluar']) - $stockBarangKeluarBaru) * $rowStock['harga_satuan'];

        if($stockBaru == 0){
            $dataStock = array(
                'qty_stock' => "0",
                'total_harga' => $totalHargaBaru,
                'status' => "Habis"
            );
        } else {
            $dataStock = array(
                'qty_stock' => $stockBaru,
                'total_harga' => $totalHargaBaru
            );
        }
        
        if($rowStock['qty_stock'] >= $stockBarangKeluarBaru){
            $successUpdate = $keluar->updateData($dataKeluar, $idKeluar);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successUpdate & $updateStock){
                session()->setFlashdata('message', 'Data Barang Keluar Berhasil di Update !!! & Data Stock Barang Berhasil di Update');
            }
        } else {
            session()->setFlashdata('error', 'Data Barang Keluar Gagal di Update !!!');
        }

        return redirect()->to('/user/keluar');
    }

    public function retur(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idSupplier = $this->request->getPost('idSupplier');
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');

            // Jika hanya terdapat filter di rentang tanggal
            if($tglMulai !=null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->masukModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika tidak terdapat filter
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori == null){
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('user/retur_barang', $filterData);
        }
    }

    public function tambah_retur_barang(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else {
            $data = [
                'title' => 'Tambah Data Barang Keluar',
                'stock' => $this->stockModel->getData(),
                'supplier' => $this->supplierModel->getData()
            ];

            return view('user/tambah_retur_barang', $data);
        }
    }

    public function save_retur(){
        $db = \Config\Database::connect();
        $stock = $this->stockModel;

        if($this->request->isAJAX()){
            $idSupplier = $this->request->getVar('namaSupplier');
            $idBarang = $this->request->getVar('namaBarang');
            $tglRetur = $this->request->getVar('tglRetur');
            $qtyRetur = $this->request->getVar('jumlahBarang');
            $hargaSatuan = $this->request->getVar('hargaSatuan');
            $keterangan = $this->request->getVar("keterangan");

            $jumlahData = count($idBarang);

            for($i=0; $i<$jumlahData; $i++){
                $dbStock[$i] = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang[$i]'");

                $row[$i] = $dbStock[$i]->getRowArray();
                $rowStock[$i] = $row[$i]['qty_stock'];
                $rowHargaSatuan[$i] = $row[$i]['harga_satuan'];

                $stockBaru[$i] = $rowStock[$i] + $qtyRetur[$i];
                $totalHargaBaru[$i] = ($rowStock[$i] + $qtyRetur[$i]) * $rowHargaSatuan[$i];
                
                $dataStock[$i] = array(
                    'qty_stock' => $stockBaru[$i],
                    'total_harga' => $totalHargaBaru[$i],
                    'status' => "Tersedia"
                );

                if($rowStock[$i] >= $qtyRetur[$i]){
                    $stock->updateData($dataStock[$i], $idBarang[$i]);

                    $db->table('data_retur_barang')
                    -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang', 'inner')
                    -> insert([
                        'id_supplier' => $idSupplier[$i],
                        'id_barang' => $idBarang[$i],
                        'tgl_retur' => $tglRetur[$i],
                        'qty_retur' => $qtyRetur[$i],
                        'harga_satuan_retur' => $hargaSatuan[$i],
                        'total_harga_retur' => $qtyRetur[$i] * $hargaSatuan[$i],
                        'keterangan' => $keterangan[$i]
                    ]);

                    session()->setFlashdata('message', "$jumlahData Data Retur Barang Berhasil di Tambah !!!");
                } else if($rowStock[$i] < $qtyRetur[$i]){
                    session()->setFlashdata('error', "Data Barang Keluar Gagal di Tambah (Karena QTY Stock < QTY Retur) !!!");
                }
               
            }
        }

        $msg = [
            'success' => 'Data Retur Barang Berhasil di Proses'
        ];

        echo json_encode($msg);
    }

    public function update_retur(){
        $db = \Config\Database::connect();
        $retur = $this->returModel;
        $stock = $this->stockModel;

        $idRetur = $this->request->getPost('idRetur');
        $idBarang = $this->request->getPost('namaBarang');

        $stockReturBarangBaru = $this->request->getPost('jumlahBarang');
        
        $queryReturLama = $db->query("SELECT qty_retur FROM data_retur_barang WHERE id_retur = '$idRetur'");
        $rowRetur = $queryReturLama->getRowArray();
        
        $queryStock = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $rowStock = $queryStock->getRowArray();

        $dataRetur = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_retur' => $this->request->getPost('tglRetur'),
            'qty_retur' => $this->request->getPost('jumlahBarang'),
            'harga_satuan_retur' => $this->request->getPost('hargaSatuan'),
            'total_harga_retur' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $stockBaru =  ($rowStock['qty_stock'] + $rowRetur['qty_retur']) - $stockReturBarangBaru;
        $totalHargaBaru = (($rowStock['qty_stock'] + $rowRetur['qty_retur']) - $stockReturBarangBaru) * $rowStock['harga_satuan'];

        if($stockBaru == 0){
            $dataStock = array(
                'qty_stock' => "0",
                'total_harga' => $totalHargaBaru,
                'status' => "Habis"
            );
        } else {
            $dataStock = array(
                'qty_stock' => $stockBaru,
                'total_harga' => $totalHargaBaru
            );
        }
        
        if($rowStock['qty_stock'] >= $stockReturBarangBaru){
            $successUpdate = $retur->updateData($dataRetur, $idRetur);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successUpdate & $updateStock){
                session()->setFlashdata('message', 'Data Retur Barang Berhasil di Update !!! & Data Stock Barang Berhasil di Update');
            }
        } else if($rowStock['qty_stock'] < $stockReturBarangBaru) {
            session()->setFlashdata('error', 'Data Retur Barang Gagal di Update (QTY Stock < QTY Retur) !!!');
        }

        return redirect()->to('/user/retur');
    }

    public function laporan_masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idSupplier = $this->request->getPost('idSupplier');
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');

            // Jika hanya terdapat filter di rentang tanggal
            if($tglMulai !=null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            // Jika tidak terdapat filter
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori == null){
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('user/laporan_masuk', $filterData);
            }
    }

    public function laporan_keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData()
                ];
            } 
            
            //Jika hanya terdapat filter terhadap id barang
            else if($tglMulai == null && $tglSelesai == null && $idBarang != null && $kategori == null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData()
                ];
            } 

            //Jika hanya terdapat filter terhadap kategori
            else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData()
                ];
            } 
            
            //Jika hanya terdapat filter tanggal & filter id barang
            else if($tglMulai != null && $tglSelesai != null && $idBarang != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData()
                ];
            }

            //Jika hanya terdapat filter tanggal & filter kategori
            else if($tglMulai != null && $tglSelesai != null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData()
                ];
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori == null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
            }

            $filterData = $data;
                
            return view('user/laporan_keluar', $filterData);
        }
    }

    public function laporan_retur(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idSupplier = $this->request->getPost('idSupplier');
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');
    
            // Jika hanya terdapat filter di rentang tanggal
            if($tglMulai !=null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->masukModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            // Jika tidak terdapat filter
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori == null){
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }
    
            $filterData = $data;
    
            return view('user/laporan_retur', $filterData);
        }
       
    }

    public function print_masuk(){
        $tglMulai = $this->request->getPost('tglMulai');
        $tglSelesai = $this->request->getPost('tglSelesai');
        $idSupplier = $this->request->getPost('idSupplier');
        $idBarang = $this->request->getPost('idBarang');
        $kategori = $this->request->getPost('kategoriBarang');

        // Jika hanya terdapat filter di rentang tanggal
        if($tglMulai !=null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori == null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterRangeOfDate($tglMulai, $tglSelesai),
                'grand_total' => $this->masukModel->grandTotalPerDate($tglMulai, $tglSelesai)
            ];
        }

        // Jika hanya terdapat filter di nama supplier
        else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterSupplier($idSupplier),
                'grand_total' => $this->masukModel->grandTotalPerSupplier($idSupplier)
            ];
        }

        // Jika hanya terdapat filter di nama barang
        else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterBarang($idBarang),
                'grand_total' => $this->masukModel->grandTotalPerBarang($idBarang)
            ];
        }

        // Jika hanya terdapat filter di kategori
        else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterKategori($kategori),
                'grand_total' => $this->masukModel->grandTotalPerKategori($kategori)
            ];
        }

        // Jika hanya terdapat filter di nama supplier & rentang tanggal
        else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                'grand_total' => $this->masukModel->grandTotalPerDateSupplier($tglMulai, $tglSelesai, $idSupplier)
            ];
        }

        // Jika hanya terdapat filter di nama barang & rentang tanggal
        else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                'grand_total' => $this->masukModel->grandTotalPerDateBarang($tglMulai, $tglSelesai, $idBarang)
            ];
        }

        // Jika hanya terdapat filter di kategori & rentang tanggal
        else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                'grand_total' => $this->masukModel->grandTotalPerDateKategori($tglMulai, $tglSelesai, $kategori)
            ];
        }

        // Jika hanya terdapat filter di nama barang & nama supplier
        else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterBarangSupplier($idBarang, $idSupplier),
                'grand_total' => $this->masukModel->grandTotalPerBarangSupplier($idBarang, $idSupplier)
            ];
        }

        // Jika hanya terdapat filter di kategori & nama supplier
        else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterKategoriSupplier($kategori, $idSupplier),
                'grand_total' => $this->masukModel->grandTotalPerKategoriSupplier($kategori, $idSupplier)
            ];
        }

        // Jika terdapat semua filter (tidak termasuk filter kategori)
        else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                'grand_total' => $this->masukModel->grandTotalPerDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier)
            ];
        }

        // Jika terdapat semua filter (tidak termasuk filter nama barang)
        else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                'grand_total' => $this->masukModel->grandTotalPerDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier)
            ];
        }

        // Jika tidak terdapat filter
        else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori == null){
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->getData(),
                'grand_total' => $this->masukModel->grandTotalAll()
            ];
        }

        $filterData = $data;

        return view('user/print_masuk', $filterData);
    }

    public function print_keluar(){
        $tglMulai = $this->request->getPost('tglMulai');
        $tglSelesai = $this->request->getPost('tglSelesai');
        $idBarang = $this->request->getPost('idBarang');
        $kategori = $this->request->getPost('kategoriBarang');

        //Jika hanya terdapat filter terhadap tanggal
        if($tglMulai != null && $tglSelesai != null && $idBarang == null && $kategori == null) {
            $data = [
                'title' => 'Daftar Barang Keluar',
                'keluar' => $this->keluarModel->filterRangeOfDate($tglMulai, $tglSelesai),
                'grand_total' => $this->keluarModel->grandTotalPerDate($tglMulai, $tglSelesai)
            ];
        } 
        
        //Jika hanya terdapat filter terhadap id barang
        else if($tglMulai == null && $tglSelesai == null && $idBarang != null && $kategori == null){
            $data = [
                'title' => 'Daftar Barang Keluar',
                'keluar' => $this->keluarModel->filterBarang($idBarang),
                'grand_total' => $this->keluarModel->grandTotalPerBarang($idBarang)
            ];
        } 

        //Jika hanya terdapat filter terhadap kategori
        else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori != null){
            $data = [
                'title' => 'Daftar Barang Keluar',
                'keluar' => $this->keluarModel->filterKategori($kategori),
                'grand_total' => $this->keluarModel->grandTotalPerKategori($kategori)
            ];
        } 
        
        //Jika hanya terdapat filter tanggal & filter id barang
        else if($tglMulai != null && $tglSelesai != null && $idBarang != null){
            $data = [
                'title' => 'Daftar Barang Keluar',
                'keluar' => $this->keluarModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                'grand_total' => $this->keluarModel->grandTotalPerDateBarang($tglMulai, $tglSelesai, $idBarang)
            ];
        }

        //Jika hanya terdapat filter tanggal & filter kategori
        else if($tglMulai != null && $tglSelesai != null && $kategori != null){
            $data = [
                'title' => 'Daftar Barang Keluar',
                'keluar' => $this->keluarModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                'grand_total' => $this->keluarModel->grandTotalPerDateKategori($tglMulai, $tglSelesai, $kategori)
            ];
        }

        //Jika tidak terdapat filter, maka data yang ditampilkan semua
        else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori == null){
            $data = [
                'title' => 'Daftar Barang Keluar',
                'keluar' => $this->keluarModel->getData(),
                'grand_total' => $this->keluarModel->grandTotalAll()
            ];
        }

        $filterData = $data;
        
        return view('user/print_keluar', $filterData);
    }

    public function print_retur(){
        $tglMulai = $this->request->getPost('tglMulai');
        $tglSelesai = $this->request->getPost('tglSelesai');
        $idSupplier = $this->request->getPost('idSupplier');
        $idBarang = $this->request->getPost('idBarang');
        $kategori = $this->request->getPost('kategoriBarang');

        // Jika hanya terdapat filter di rentang tanggal
        if($tglMulai !=null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori == null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterRangeOfDate($tglMulai, $tglSelesai),
                'grand_total' => $this->returModel->grandTotalPerDate($tglMulai, $tglSelesai)
            ];
        }

        // Jika hanya terdapat filter di nama supplier
        else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterSupplier($idSupplier),
                'grand_total' => $this->returModel->grandTotalPerSupplier($idSupplier)
            ];
        }

        // Jika hanya terdapat filter di nama barang
        else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterBarang($idBarang),
                'grand_total' => $this->returModel->grandTotalPerBarang($idBarang)
            ];
        }

        // Jika hanya terdapat filter di kategori
        else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterKategori($kategori),
                'grand_total' => $this->returModel->grandTotalPerKategori($kategori)
            ];
        }

        // Jika hanya terdapat filter di nama supplier & rentang tanggal
        else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                'grand_total' => $this->returModel->grandTotalPerDateSupplier($tglMulai, $tglSelesai, $idSupplier)
            ];
        }

        // Jika hanya terdapat filter di nama barang & rentang tanggal
        else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                'grand_total' => $this->returModel->grandTotalPerDateBarang($tglMulai, $tglSelesai, $idBarang)
            ];
        }

        // Jika hanya terdapat filter di kategori & rentang tanggal
        else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                'grand_total' => $this->returModel->grandTotalPerDateKategori($tglMulai, $tglSelesai, $kategori)
            ];
        }

        // Jika hanya terdapat filter di nama barang & nama supplier
        else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterBarangSupplier($idBarang, $idSupplier),
                'grand_total' => $this->returModel->grandTotalPerBarangSupplier($idBarang, $idSupplier)
            ];
        }

        // Jika hanya terdapat filter di kategori & nama supplier
        else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterKategoriSupplier($kategori, $idSupplier),
                'grand_total' => $this->returModel->grandTotalPerKategoriSupplier($kategori, $idSupplier)
            ];
        }

        // Jika terdapat semua filter (tidak termasuk filter kategori)
        else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                'grand_total' => $this->returModel->grandTotalPerDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier)
            ];
        }

        // Jika terdapat semua filter (tidak termasuk filter nama barang)
        else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                'grand_total' => $this->returModel->grandTotalPerDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier)
            ];
        }

        // Jika tidak terdapat filter
        else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori == null){
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->getData(),
                'grand_total' => $this->returModel->grandTotalAll()
            ];
        }

        $filterData = $data;

        return view('user/print_retur', $filterData);
    }

    public function update_profile(){
        $akun = $this->akunModel;
        $id = $this->request->getPost('idUser');
        $data = array(
            'nama_lengkap' => $this->request->getPost('namaUser'),
            'email' => $this->request->getPost('emailUser'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('passUser'),
            'alamat'=> $this->request->getPost('alamatUser'),
            'telp' => $this->request->getPost('telpUser')
        );
        
        $success = $akun->updateProfile($id, $data);

        if($success){
            session()->regenerate(true);
            
            $nama = $this->request->getPost('namaUser');
            $email = $this->request->getPost('emailUser');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('passUser');
            $alamat = $this->request->getPost('alamatUser');
            $telp = $this->request->getPost('telpUser');
            
            session()->set('nama_lengkap', $nama);
            session()->set('email', $email);
            session()->set('username', $username);
            session()->set('password', $password);
            session()->set('alamat', $alamat);
            session()->set('telp', $telp);
            
            session()->setFlashdata('message', 'Profil Berhasil di Update !!!');
        } else {
            session()->setFlashdata('error', 'Profil Gagal di Update !!!');
        }

        return redirect()->to('/user');
    }

    public function logout(){
        session() -> remove('logged_in');
        session() -> destroy();
        return redirect() -> to('/home');
    }
}
