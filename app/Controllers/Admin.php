<?php

namespace App\Controllers;

use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\ReturModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class Admin extends BaseController
{
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
        $data = [
            'data_stock' => $this->stockModel->qty_stock(),
            'data_supplier' => $this->supplierModel->qty_supplier(),
            'data_barang_masuk' => $this->masukModel->qty_masuk(),
            'data_barang_keluar' => $this->keluarModel->qty_keluar(),
            'data_retur_barang' => $this->returModel->qty_retur(),
            'stock' => $this->stockModel->getData()
        ];

        return view('admin/index', $data);
    }

    public function supplier(){
        $data = [
            'title' => 'Daftar Supplier',
            'supplier' => $this->supplierModel->getData(),
            'stock' => $this->stockModel->getData()
        ];
        return view('admin/supplier', $data);
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
            session()->setFlashdata('message', 'Berhasil di Edit !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Edit !!!');
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
        $data = [
            'title' => 'Daftar Stock Barang',
            'stock' => $this->stockModel->getData()
        ];

        return view('admin/stock', $data);
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
            session()->setFlashdata('message', 'Berhasil di Edit !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Edit !!!');
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
        $data = [
            'title' => 'Daftar Barang Masuk',
            'masuk' => $this->masukModel->getData(),
            'stock' => $this->stockModel->getData(),
            'supplier' => $this->supplierModel->getData()
        ];

        return view('admin/barang_masuk', $data);
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
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
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
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
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
        $data = [
            'title' => 'Daftar Barang Keluar',
            'keluar' => $this->keluarModel->getData(),
            'stock' => $this->stockModel->getData()
        ];

        return view('admin/barang_keluar', $data);
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
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
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
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
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
        $data = [
            'title' => 'Daftar Retur Barang',
            'retur' => $this->returModel->getData(),
            'stock' => $this->stockModel->getData(),
            'supplier' => $this->supplierModel->getData()
        ];

        return view('admin/retur_barang', $data);
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
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan'),
        );

        $dataStock = array(
            'qty_stock' => (int)$row['qty_stock'] - (int)$stockBarangRetur,
            'total_harga' => ((int)$row['qty_stock'] - (int)$stockBarangRetur) * (int)$row['harga_satuan']
        );
        
        $successTambah = $retur->saveData($data);
        $updateStock = $stock->updateData($dataStock, $idBarang);

        if($successTambah & $updateStock){
            session()->setFlashdata('message', 'Data Retur Barang Berhasil di Tambah !!! & Data Stock Berhasil di Update');
        } else {
            session()->setFlashdata('error', 'Data Retur Barang Gagal di Tambah !!!');
        }

        return redirect()->to('/admin/retur');
    }

    public function update_retur(){
        $db = \Config\Database::connect();
        $retur = $this->returModel;
        $stock = $this->stockModel;

        $idRetur = $this->request->getPost('idRetur');
        $idBarang = $this->request->getPost('namaBarang');

        $stockBarangMasukBaru = $this->request->getPost('jumlahBarang');
        
        $queryReturLama = $db->query("SELECT qty_retur FROM data_retur_barang WHERE id_retur = '$idRetur'");
        $rowRetur = $queryReturLama->getRowArray();
        
        $queryStock = $db->query("SELECT qty_stock, harga_satuan FROM data_stock WHERE id_barang = '$idBarang'");
        $rowStock = $queryStock->getRowArray();

        $dataMasuk = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_retur' => $this->request->getPost('tglRetur'),
            'qty_retur' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $dataStock = array(
            'qty_stock' => ((int)$rowStock['qty_stock'] + (int)$rowRetur['qty_retur']) - (int)$stockBarangMasukBaru,
            'total_harga' => (((int)$rowStock['qty_stock'] + (int)$rowRetur['qty_retur']) - (int)$stockBarangMasukBaru) * (int)$rowStock['harga_satuan']
        );
        
        $successUpdate = $retur->updateData($dataMasuk, $idRetur);
        $updateStock = $stock->updateData($dataStock, $idBarang);

        if($successUpdate & $updateStock){
            session()->setFlashdata('message', 'Data Retur Barang Berhasil di Update !!! & Data Stock Berhasil di Update');
        } else {
            session()->setFlashdata('error', 'Data Retur Barang Gagal di Update !!!');
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
        return view('admin/laporan_masuk');
    }

    public function laporan_keluar(){
        return view('admin/laporan_keluar');
    }

    public function laporan_retur(){
        return view('admin/laporan_retur');
    }

    public function print_masuk(){
        $data['masuk'] = $this->masukModel->getData();
        return view('admin/print_masuk', $data);
    }

    public function print_keluar(){
        $data['print_keluar'] = $this->keluarModel->getData();
        return view('admin/print_keluar', $data);
    }

    public function print_retur(){
        $data['retur'] = $this->returModel->getData();
        return view('admin/print_retur', $data);
    }

    public function logout(){
        session() -> destroy();
        return redirect() -> to('home');
    }
}
