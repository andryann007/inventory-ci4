<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\CustomerModel;
use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class Admin extends BaseController
{
    protected $supplierModel;
    protected $stockModel;
    protected $masukModel;
    protected $keluarModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->stockModel = new StockModel();
        $this->masukModel = new MasukModel();
        $this->keluarModel = new KeluarModel();
    }

    public function index(){
        $data = [
            'data_stock' => $this->stockModel->qty_stock(),
            'data_supplier' => $this->supplierModel->qty_supplier(),
            'data_barang_masuk' => $this->masukModel->qty_masuk(),
            'data_barang_keluar' => $this->keluarModel->qty_keluar()
        ];

        return view('admin/index', $data);
    }

    public function supplier(){
        $data = [
            'title' => 'Daftar Supplier',
            'supplier' => $this->supplierModel->getData()
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
            'masuk' => $this->masukModel->getData()
        ];

        return view('admin/barang_masuk', $data);
    }

    public function save_masuk(){
        $masuk = $this->masukModel;
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

        $success = $masuk->saveData($data);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Tambah !!!');
        }

        return redirect()->to('/admin/masuk');
    }

    public function update_masuk(){
        $masuk = $this->masukModel;
        $id = $this->request->getPost('idMasuk');
        $data = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_masuk' => $this->request->getPost('tglMasuk'),
            'qty_masuk' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $success = $masuk->updateData($data, $id);

        if($success){
            session()->setFlashdata('message', 'Berhasil di Edit !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Edit !!!');
        }

        return redirect()->to('/admin/masuk');
    }

    public function delete_masuk(){
        $masuk = $this->masukModel;
        $id = $this->request->getPost('idMasuk');

        $success = $masuk->deleteData($id);
        
        if($success){
            session()->setFlashdata('message', 'Berhasil di Hapus !!!');
        } else {
            session()->setFlashdata('error', 'Gagal di Hapus !!!');
        }

        return redirect()->to('/admin/masuk');
    }

    public function keluar(){
        $data = [
            'title' => 'Daftar Barang Keluar',
            'keluar' => $this->keluarModel->getData()
        ];

        return view('admin/barang_keluar', $data);
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
        
        return redirect()->to('/admin/keluar');
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

        return redirect()->to('/admin/keluar');
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

        return redirect()->to('/admin/keluar');
    }

    public function retur_masuk(){
        return view('admin/retur_masuk');
    }

    public function laporan_masuk(){
        return view('admin/laporan_masuk');
    }

    public function laporan_keluar(){
        return view('admin/laporan_keluar');
    }

    public function logout(){
        session() -> destroy();
        return redirect() -> to('home');
    }
}
