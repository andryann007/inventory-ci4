<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class Owner extends BaseController
{
    protected $akunModel;
    protected $supplierModel;
    protected $stockModel;
    protected $masukModel;
    protected $keluarModel;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
        $this->supplierModel = new SupplierModel();
        $this->stockModel = new StockModel();
        $this->masukModel = new MasukModel();
        $this->keluarModel = new KeluarModel();
    }

    public function index(){
        $data = [
            'data_akun'  => $this->akunModel->qty_akun(),
            'data_stock' => $this->stockModel->qty_stock(),
            'data_supplier' => $this->supplierModel->qty_supplier(),
            'data_barang_masuk' => $this->masukModel->qty_masuk(),
            'data_barang_keluar' => $this->keluarModel->qty_keluar()
        ];

        return view('owner/index', $data);
    }

    public function akun(){
        $data = [
            'title' => 'Daftar Akun',
            'akun' => $this->akunModel->getData()
        ];
        return view('owner/akun', $data);
    }

    public function save_akun(){
        $akun = $this->akunModel;

        $data = array(
            'id_user' => $this->request->getPost('idUser'),
            'nama_lengkap' => $this->request->getPost('namaUser'),
            'email' => $this->request->getPost('emailUser'),
            'password' => $this->request->getPost('passUser'),
            'alamat'=> $this->request->getPost('alamatUser'),
            'telp' => $this->request->getPost('telpUser'),
            'tipe_akun' => $this->request->getPost('tipeAkunUser')
        );

        $success = $akun->saveData($data);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Tambah !!!');
        }

        return redirect()->to('/owner/akun');
    }

    public function update_akun(){
        $akun = $this->akunModel;
        $id = $this->request->getPost('idUser');
        $data = array(
            'nama_lengkap' => $this->request->getPost('namaUser'),
            'email' => $this->request->getPost('emailUser'),
            'password' => $this->request->getPost('passUser'),
            'alamat'=> $this->request->getPost('alamatUser'),
            'telp' => $this->request->getPost('telpUser'),
            'tipe_akun' => $this->request->getPost('tipeAkunUser')
        );
        
        $success = $akun->updateData($data, $id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Edit !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Edit !!!');
        }

        return redirect()->to('/owner/akun');
    }

    public function delete_akun(){
        $akun = $this->akunModel;
        $id = $this->request->getPost('idUser');
        
        $success =$akun->deleteData($id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Hapus !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Hapus !!!');
        }

        return redirect()->to('/owner/akun');
    }

    public function supplier(){
        $data = [
            'title' => 'Daftar Supplier',
            'supplier' => $this->supplierModel->getData()
        ];
        return view('owner/supplier', $data);
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

        return redirect()->to('/owner/supplier');
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

        return redirect()->to('/owner/supplier');
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

        return redirect()->to('/owner/supplier');
    }

    public function stock(){
        $data = [
            'title' => 'Daftar Stock Barang',
            'stock' => $this->stockModel->getData()
        ];

        return view('owner/stock', $data);
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
        return redirect()->to('/owner/stock');
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

        return redirect()->to('/owner/stock');
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

        return redirect()->to('/owner/stock');
    }

    public function masuk(){
        $data = [
            'title' => 'Daftar Barang Masuk',
            'masuk' => $this->masukModel->getData()
        ];

        return view('owner/barang_masuk', $data);
    }

    public function save_masuk(){
        $stock = $this->stockModel;
        $masuk = $this->masukModel;

        $idBarang = $this->request->getPost('namaBarang');

        $dataStock = array(
            'qty_stock' => 'qty_stock' + $this->request->getPost('jumlahBarang')
        );

        $data = array(
            'id_masuk' => $this->request->getPost('idMasuk'),
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_masuk' => $this->request->getPost('tglMasuk'),
            'qty_masuk' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );
        $stock->updateData($dataStock, $idBarang);
        $success = $masuk->saveData($data);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Tambah !!!');
        }

        return redirect()->to('/owner/masuk');
    }

    public function update_masuk(){
        $stock = $this->stockModel;
        $masuk = $this->masukModel;

        $idBarang = $this->request->getPost('namaBarang');
        $idMasuk = $this->request->getPost('idMasuk');

        $dataStock = array(
            'qty_stock' => 'qty_stock' - 'qty_masuk' + $this->request->getPost('jumlahBarang')
        );

        $dataMasuk = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_masuk' => $this->request->getPost('tglMasuk'),
            'qty_masuk' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );
        
        $stock->updateData($dataStock, $idBarang);
        $success = $masuk->updateData($dataMasuk, $idMasuk);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Edit !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Edit !!!');
        }

        return redirect()->to('/owner/masuk');
    }

    public function delete_masuk(){
        $stock = $this->stockModel;
        $masuk = $this->masukModel;

        $idBarang = $this->request->getPost('namaBarang');

        $dataStock = array(
            'qty_stock' => 'qty_stock' - $this->request->getPost('jumlahBarang')
        );

        $id = $this->request->getPost('idMasuk');

        $stock->updateData($dataStock, $idBarang);
        $success = $masuk->deleteData($id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Hapus !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Hapus !!!');
        }

        return redirect()->to('/owner/masuk');
    }

    public function keluar(){
        $data = [
            'title' => 'Daftar Barang Keluar',
            'keluar' => $this->keluarModel->getData()
        ];

        return view('owner/barang_keluar', $data);
    }

    public function save_keluar(){
        $keluar = $this->keluarModel;
        $data = array(
            'id_keluar' => $this->request->getPost('idKeluar'),
            'id_barang' => $this->request->getPost('namaBarang'),
            'tgl_keluar' => $this->request->getPost('tglKeluar'),
            'qty_keluar' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );
        $success = $keluar->saveData($data);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Tambah !!!');
        }

        return redirect()->to('/owner/masuk');
    }

    public function update_keluar(){
        $keluar = $this->keluarModel;
        $id = $this->request->getPost('idKeluar');
        $data = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'tgl_keluar' => $this->request->getPost('tglKeluar'),
            'qty_keluar' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );
        
        $success = $keluar->updateData($data, $id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Edit !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Edit !!!');
        }

        return redirect()->to('/owner/keluar');
    }

    public function delete_keluar(){
        $keluar = $this->keluarModel;
        $id = $this->request->getPost('idKeluar');

        $success = $keluar->deleteData($id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Hapus !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Hapus !!!');
        }

        return redirect()->to('/owner/keluar');
    }

    public function retur_masuk(){
        return view('owner/retur_masuk');
    }

    public function laporan_masuk(){
        return view('owner/laporan_masuk');
    }

    public function laporan_keluar(){
        return view('owner/laporan_keluar');
    }

    public function logout(){
        session() -> destroy();
        return redirect() -> to('home');
    }
}
