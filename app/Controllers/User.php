<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\CustomerModel;
use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class User extends BaseController
{
    protected $masukModel;
    protected $keluarModel;

    public function __construct()
    {
        $this->masukModel = new MasukModel();
        $this->keluarModel = new KeluarModel();
    }

    public function index(){
        $data = [
            'data_barang_masuk' => $this->masukModel->qty_masuk(),
            'data_barang_keluar' => $this->keluarModel->qty_keluar()
        ];
        return view('user/index', $data);
    }

    public function masuk(){
        $data = [
            'title' => 'Daftar Barang Masuk',
            'masuk' => $this->masukModel->getData()
        ];

        return view('user/barang_masuk', $data);
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

        return redirect()->to('/user/masuk');
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

        return redirect()->to('/user/masuk');
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

        return redirect()->to('/user/masuk');
    }

    public function keluar(){
        $data = [
            'title' => 'Daftar Barang Keluar',
            'keluar' => $this->keluarModel->getData()
        ];

        return view('user/barang_keluar', $data);
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

        return redirect()->to('/user/masuk');
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

        return redirect()->to('/user/keluar');
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

        return redirect()->to('/user/keluar');
    }

    public function laporan_masuk(){
        return view('user/laporan_masuk');
    }

    public function laporan_keluar(){
        return view('user/laporan_keluar');
    }

    public function logout(){
        session() -> destroy();
        return redirect() -> to('home');
    }
}
