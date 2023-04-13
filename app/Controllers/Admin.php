<?php

namespace App\Controllers;

use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\ReturModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class Admin extends BaseController
{
    protected $akunModel;
    protected $supplierModel;
    protected $stockModel;
    protected $masukModel;
    protected $keluarModel;
    protected $returModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->stockModel = new StockModel();
        $this->masukModel = new MasukModel();
        $this->keluarModel = new KeluarModel();
        $this->returModel = new ReturModel();
    }

    public function index(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
        } else {
            $data = [
                'data_akun'  => $this->akunModel->qty_akun(),
                'data_stock' => $this->stockModel->qty_stock(),
                'data_supplier' => $this->supplierModel->qty_supplier(),
                'data_barang_masuk' => $this->masukModel->qty_masuk(),
                'data_barang_keluar' => $this->keluarModel->qty_keluar(),
                'data_retur_barang' => $this->returModel->qty_retur(),
                'stock' => $this->stockModel->getData()
            ];
    
            return view('admin/index', $data);
        }
    }

    public function supplier(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
        } else {
            $data = [
                'title' => 'Daftar Supplier',
                'supplier' => $this->supplierModel->getData(),
                'stock' => $this->stockModel->getData()
            ];
            return view('admin/supplier', $data);
        }
    }

    public function save_supplier(){
        $supplier = $this->supplierModel;
        
        $data = array(
            'id_supplier' => $this->request->getPost('idSupplier'),
            'nama_supplier' => $this->request->getPost('namaSupplier'),
            'alamat'=> $this->request->getPost('alamatSupplier'),
            'email' => $this->request->getPost('emailSupplier'),
            'telp' => $this->request->getPost('telpSupplier')
        );
        
        $success = $supplier->saveData($data);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Tambah !!!');
        }

        return redirect()->to('/admin/supplier');
    }

    public function update_supplier(){
        $supplier = $this->supplierModel;
        $id = $this->request->getPost('idSupplier');
        $data = array(
            'nama_supplier' => $this->request->getPost('namaSupplier'),
            'alamat'=> $this->request->getPost('alamatSupplier'),
            'email' => $this->request->getPost('emailSupplier'),
            'telp' => $this->request->getPost('telpSupplier')
        );

        $success = $supplier->updateData($data, $id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Update !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/admin/supplier');
    }

    public function delete_supplier(){
        $supplier = $this->supplierModel;
        $id = $this->request->getPost('idSupplier');

        $success = $supplier->deleteData($id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Hapus !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Hapus !!!');
        }

        return redirect()->to('/admin/supplier');
    }

    public function stock(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
        } else {
            $kategori = $this->request->getPost('kategoriBarang');
            $status = $this->request->getPost('status');

            //Jika tidak ada filter, maka data akan tampil semua
            if($kategori == null && $status == null){
                $data = [
                    'title' => 'Daftar Stock Barang',
                    'stock' => $this->stockModel->getData()
                ];
            } 
            
            //Jika input filter dari status tidak ada / status = semua, maka data akan di filter berdasarkan kategori
            else if ($status == null){
                $data = [
                    'title' => 'Daftar Stock Barang',
                    'stock' => $this->stockModel->filterCategory($kategori)
                ];
            }
            
            //Jika input filter dari kategori tidak ada / kategori = semua, maka data akan di filter berdasarkan status
            else if($kategori == null){
                $data = [
                    'title' => 'Daftar Stock Barang',
                    'stock' => $this->stockModel->filterStatus($status)
                ];
            }
            
            //Jika semua input filter ada, maka data akan di filter berdasarkan kategori & status
            else {
                $data = [
                    'title' => 'Daftar Stock Barang',
                    'stock' => $this->stockModel->filterCategoryStatus($kategori, $status)
                ];
            }

            //Mendapatkan data sesuai kondisi filter
            $filterData = $data;

            return view('admin/stock', $filterData);
        }
    }

    public function save_stock(){
        $stock = $this->stockModel;
        $data = array(
            'id_barang' => $this->request->getPost('idBarang'),
            'nama_barang' => $this->request->getPost('namaBarang'),
            'kategori'=> $this->request->getPost('kategoriBarang'),
            'qty_stock' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'status' => $this->request->getPost('status')
        );
        
        $success = $stock->saveData($data);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Tambah !!!');
        }
        return redirect()->to('/admin/stock');
    }

    public function update_stock(){
        $stock = $this->stockModel;
        $id = $this->request->getPost('idBarang');
        $data = array(
            'nama_barang' => $this->request->getPost('namaBarang'),
            'kategori'=> $this->request->getPost('kategoriBarang'),
            'qty_stock' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'status' => $this->request->getPost('status')
        );
        $success = $stock->updateData($data, $id);
        
        if($success){
            session()->setFlashdata('message', 'Berhasil di Update !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/admin/stock');
    }

    public function delete_stock(){
        $stock = $this->stockModel;
        $id = $this->request->getPost('idBarang');

        $success = $stock->deleteData($id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Hapus !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Hapus !!!');
        }

        return redirect()->to('/admin/stock');
    }

    public function masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
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

            return view('admin/barang_masuk', $filterData);
        }
    }

    public function save_masuk(){
        $db = \Config\Database::connect();
        $masuk = $this->masukModel;
        $stock = $this->stockModel;

        $idBarang = $this->request->getPost('namaBarang');
        $stockBarangMasuk = $this->request->getPost('jumlahBarang');
        
        $query = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $row = $query->getRowArray();

        $data = array(
            'id_masuk' => $this->request->getPost('idMasuk'),
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_masuk' => $this->request->getPost('tglIncoming'),
            'qty_masuk' => $this->request->getPost('jumlahBarang'),
            'harga_satuan_masuk' => $this->request->getPost('hargaSatuan'),
            'total_harga_masuk' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan'),
        );

        $dataStock = array(
            'qty_stock' => (int)$row['qty_stock'] + (int)$stockBarangMasuk,
            'total_harga' => ((int)$row['qty_stock'] + (int)$stockBarangMasuk) * (int)$row['harga_satuan']
        );
        
        $successTambah = $masuk->saveData($data);
        $updateStock = $stock->updateData($dataStock, $idBarang);

        if($successTambah & $updateStock){
            session()->setFlashdata('message', 'Data Barang Masuk Berhasil di Tambah !!! & Data Stock Berhasil di Update');
        } else {
            session()->setFlashdata('error', 'Data Barang Masuk Gagal di Tambah !!!');
        }

        return redirect()->to('/admin/masuk');
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

        return redirect()->to('/admin/masuk');
    }

    public function delete_masuk(){
        $db = \Config\Database::connect();
        $stock = $this->stockModel;
        $masuk = $this->masukModel;

        $idMasuk = $this->request->getPost('idMasuk');
        $idBarang = $this->request->getPost('namaBarang');
        
        $queryMasuk = $db->query("SELECT qty_masuk FROM data_barang_masuk WHERE id_masuk = '$idMasuk'");
        $rowMasuk = $queryMasuk->getRowArray();
        
        $queryStock = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $rowStock = $queryStock->getRowArray();

        $dataStock = array(
            'qty_stock' => (int)$rowStock['qty_stock'] - (int)$rowMasuk['qty_masuk'],
            'total_harga' => ((int)$rowStock['qty_stock'] - (int)$rowMasuk['qty_masuk']) * (int)$rowStock['harga_satuan']
        );
        
        $updateStock = $stock->updateData($dataStock, $idBarang);
        $successDelete = $masuk->deleteData($idMasuk);

        if($successDelete & $updateStock){
            session()->setFlashdata('message', 'Data Barang Masuk Berhasil di Hapus !!! & Data Stock Barang Berhasil di Update !!!');
        } else {
            session()->setFlashdata('error', 'Data Barang Masuk Gagal di Hapus !!!');
        }

        return redirect()->to('/admin/masuk');
    }

    public function keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
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

            return view('admin/barang_keluar', $filterData);
        }
    }

    public function save_keluar(){
        $db = \Config\Database::connect();
        $keluar = $this->keluarModel;
        $stock = $this->stockModel;

        $idBarang = $this->request->getPost('namaBarang');
       
        $stockBarangKeluar = $this->request->getPost('jumlahBarang');
        
        $query = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $row = $query->getRowArray();

        $data = array(
            'id_keluar' => $this->request->getPost('idKeluar'),
            'id_barang' => $this->request->getPost('namaBarang'),
            'tgl_keluar' => $this->request->getPost('tglOutcoming'),
            'qty_keluar' => $this->request->getPost('jumlahBarang'),
            'harga_satuan_keluar' => $this->request->getPost('hargaSatuan'),
            'total_harga_keluar' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $dataStock = array(
            'qty_stock' => (int)$row['qty_stock'] - (int)$stockBarangKeluar,
            'total_harga' => ((int)$row['qty_stock'] - (int)$stockBarangKeluar) * (int)$row['harga_satuan']
        );

        if($row['qty_stock'] >= $stockBarangKeluar){
            $successTambah = $keluar->saveData($data);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successTambah & $updateStock){
                session()->setFlashdata('message', 'Data Barang Keluar Berhasil di Tambah !!! & Data Stock Barang Berhasil di Update');
            }
        }
        else if ($row['qty_stock'] < $stockBarangKeluar) {
            session()->setFlashdata('error', 'Gagal di Tambah (Karena QTY Keluar > QTY Stock !!!');
        }

        return redirect()->to('/admin/keluar');
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
        
        $dataStock = array(
            'qty_stock' => ((int)$rowStock['qty_stock'] + (int)$rowKeluar['qty_keluar']) - (int)$stockBarangKeluarBaru,
            'total_harga' => (((int)$rowStock['qty_stock'] + (int)$rowKeluar['qty_keluar']) - (int)$stockBarangKeluarBaru) * (int)$rowStock['harga_satuan']
        );
        
        if($rowStock['qty_stock'] >= $stockBarangKeluarBaru){
            $successUpdate = $keluar->updateData($dataKeluar, $idKeluar);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successUpdate & $updateStock){
                session()->setFlashdata('message', 'Data Barang Keluar Berhasil di Update !!! & Data Stock Barang Berhasil di Update');
            }
        } else {
            session()->setFlashdata('error', 'Data Barang Keluar Gagal di Update !!!');
        }

        return redirect()->to('/admin/keluar');
    }

    public function delete_keluar(){
        $db = \Config\Database::connect();
        $stock = $this->stockModel;
        $keluar = $this->keluarModel;

        $idKeluar = $this->request->getPost('idKeluar');
        $idBarang = $this->request->getPost('namaBarang');
        
        $queryKeluar = $db->query("SELECT qty_keluar FROM data_barang_keluar WHERE id_keluar = '$idKeluar'");
        $rowKeluar = $queryKeluar->getRowArray();
        
        $queryStock = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $rowStock = $queryStock->getRowArray();

        $dataStock = array(
            'qty_stock' => (int)$rowStock['qty_stock'] + (int)$rowKeluar['qty_keluar'],
            'total_harga' => ((int)$rowStock['qty_stock'] + (int)$rowKeluar['qty_keluar']) * (int)$rowStock['harga_satuan']
        );
        
        $updateStock = $stock->updateData($dataStock, $idBarang);
        $successDelete = $keluar->deleteData($idKeluar);

        if($successDelete & $updateStock){
            session()->setFlashdata('message', 'Data Barang Keluar Berhasil di Hapus !!! & Data Stock Berhasil di Update');
        } else {
            session()->setFlashdata('error', 'Gagal di Hapus !!!');
        }

        return redirect()->to('/admin/keluar');
    }

    public function retur(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
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

            return view('admin/retur_barang', $filterData);
        }
    }

    public function save_retur(){
        $db = \Config\Database::connect();
        $retur = $this->returModel;
        $stock = $this->stockModel;

        $idBarang = $this->request->getPost('namaBarang');
        $stockBarangRetur = $this->request->getPost('jumlahBarang');
        
        $query = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $row = $query->getRowArray();

        $data = array(
            'id_retur' => $this->request->getPost('idRetur'),
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_retur' => $this->request->getPost('tglRetur'),
            'qty_retur' => $this->request->getPost('jumlahBarang'),
            'harga_satuan_retur' => $this->request->getPost('hargaSatuan'),
            'total_harga_retur' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan'),
        );

        $dataStock = array(
            'qty_stock' => (int)$row['qty_stock'] - (int)$stockBarangRetur,
            'total_harga' => ((int)$row['qty_stock'] - (int)$stockBarangRetur) * (int)$row['harga_satuan']
        );

        if($row['qty_stock'] >= $stockBarangRetur){
            $successTambah = $retur->saveData($data);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successTambah & $updateStock){
                session()->setFlashdata('message', 'Data Barang Keluar Berhasil di Tambah !!! & Data Retur Barang Berhasil di Update');
            }
        }
        else if ($row['qty_stock'] < $stockBarangRetur) {
            session()->setFlashdata('error', 'Gagal di Tambah (Karena QTY Keluar > QTY Stock !!!');
        }

        return redirect()->to('/admin/retur');
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

        $dataStock = array(
            'qty_stock' => ((int)$rowStock['qty_stock'] + (int)$rowRetur['qty_retur']) - (int)$stockReturBarangBaru,
            'total_harga' => (((int)$rowStock['qty_stock'] + (int)$rowRetur['qty_retur']) - (int)$stockReturBarangBaru) * (int)$rowStock['harga_satuan']
        );
        if($rowStock['qty_stock'] >= $stockReturBarangBaru){
            $successUpdate = $retur->updateData($dataRetur, $idRetur);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successUpdate & $updateStock){
                session()->setFlashdata('message', 'Data Retur Barang Berhasil di Update !!! & Data Stock Barang Berhasil di Update');
            }
        } else if($rowStock['qty_stock'] < $stockReturBarangBaru) {
            session()->setFlashdata('error', 'Data Retur Barang Gagal di Update (QTY Stock < QTY Retur) !!!');
        }

        return redirect()->to('/admin/retur');
    }

    public function delete_retur(){
        $db = \Config\Database::connect();
        $stock = $this->stockModel;
        $retur = $this->returModel;

        $idRetur = $this->request->getPost('idRetur');
        $idBarang = $this->request->getPost('namaBarang');
        
        $queryRetur = $db->query("SELECT qty_retur FROM data_retur_barang WHERE id_retur = '$idRetur'");
        $rowRetur = $queryRetur->getRowArray();
        
        $queryStock = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $rowStock = $queryStock->getRowArray();

        $dataStock = array(
            'qty_stock' => (int)$rowStock['qty_stock'] + (int)$rowRetur['qty_retur'],
            'total_harga' => ((int)$rowStock['qty_stock'] + (int)$rowRetur['qty_retur']) * (int)$rowStock['harga_satuan']
        );
        
        $updateStock = $stock->updateData($dataStock, $idBarang);
        $successDelete = $retur->deleteData($idRetur);

        if($successDelete & $updateStock){
            session()->setFlashdata('message', 'Data Retur Barang Berhasil di Hapus !!! & Data Stock Barang Berhasil di Update !!!');
        } else {
            session()->setFlashdata('error', 'Data Retur Barang Gagal di Hapus !!!');
        }

        return redirect()->to('/admin/retur');
    }

    public function laporan_masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
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

            return view('admin/laporan_masuk', $filterData);
            }
    }

    public function laporan_keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
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
                
            return view('admin/laporan_keluar', $filterData);
        }
    }

    public function laporan_retur(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "Owner"){
            return redirect()->to('owner');
        } else if(session()->get('tipe_akun') == "User"){
            return redirect()->to('user');
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
    
            return view('admin/laporan_retur', $filterData);
        }
       
    }

    public function print_masuk(){
        $data = [
            'masuk' => $this->masukModel->getData(),
            'grand_total' => $this->masukModel->grand_total()
        ];
        
        return view('admin/print_masuk', $data);
    }

    public function print_keluar(){
         $data = [
            'keluar' => $this->keluarModel->getData(),
            'grand_total' => $this->keluarModel->grand_total()
        ];

        return view('admin/print_keluar', $data);
    }

    public function print_retur(){
        $data = [
            'retur' => $this->returModel->getData(),
            'grand_total' => $this->returModel->grand_total()
        ];
        
        return view('admin/print_retur', $data);
    }

    public function logout(){
        session() -> remove('logged_in');
        session() -> destroy();
        return redirect() -> to('home');
    }
}
