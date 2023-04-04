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
    protected $customerModel;
    protected $stockModel;
    protected $masukModel;
    protected $keluarModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->customerModel = new CustomerModel();
        $this->stockModel = new StockModel();
        $this->masukModel = new MasukModel();
        $this->keluarModel = new KeluarModel();
    }

    public function index(){
        return view('admin/index');
    }

    public function supplier(){
        $supplier = $this->supplierModel->findAll();
        $data = [
            'title' => 'Daftar Supplier',
            'supplier' => $supplier
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
        $supplier->saveData($data);
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
        $supplier->updateData($data, $id);
        return redirect()->to('/admin/supplier');
    }

    public function delete_supplier(){
        $supplier = $this->supplierModel;
        $id = $this->request->getPost('idSupplier');
        $supplier->deleteData($id);
        return redirect()->to('/admin/supplier');
    }

    public function customer(){
        $customer = $this->customerModel->findAll();
        $data = [
            'title' => 'Daftar Customer',
            'customer' => $customer
        ];

        return view('admin/customer', $data);
    }

    public function save_customer(){
        $customer = $this->customerModel;
        $data = array(
            'id_customer' => $this->request->getPost('idCustomer'),
            'nama_customer' => $this->request->getPost('namaCustomer'),
            'alamat'=> $this->request->getPost('alamatCustomer'),
            'email' => $this->request->getPost('emailCustomer'),
            'telp' => $this->request->getPost('telpCustomer')
        );
        $customer->saveData($data);
        return redirect()->to('/admin/customer');
    }

    public function update_customer(){
        $customer = $this->customerModel;
        $id = $this->request->getPost('idCustomer');
        $data = array(
            'nama_customer' => $this->request->getPost('namaCustomer'),
            'alamat'=> $this->request->getPost('alamatCustomer'),
            'email' => $this->request->getPost('emailCustomer'),
            'telp' => $this->request->getPost('telpCustomer')
        );
        $customer->updateData($data, $id);
        return redirect()->to('/admin/customer');
    }

    public function delete_customer(){
        $customer = $this->customerModel;
        $id = $this->request->getPost('idCustomer');
        $customer->deleteData($id);
        return redirect()->to('/admin/customer');
    }

    public function stock(){
        $stock = $this->stockModel->findAll();
        $data = [
            'title' => 'Daftar Stock Barang',
            'stock' => $stock
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
        $stock->saveData($data);
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
        $stock->updateData($data, $id);
        return redirect()->to('/admin/stock');
    }

    public function delete_stock(){
        $stock = $this->stockModel;
        $id = $this->request->getPost('idBarang');
        $stock->deleteData($id);
        return redirect()->to('/admin/stock');
    }

    public function masuk(){
        $masuk = $this->masukModel->findAll();
        $data = [
            'title' => 'Daftar Barang Masuk',
            'masuk' => $masuk
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
            'keterangan' => $this->request->getPost('keterangan'),
            'jenis_transaksi' =>$this->request->getPost('jenisTransaksi')
        );
        $masuk->saveData($data);
        return redirect()->to('/admin/masuk');
    }

    public function update_masuk(){
        $masuk = $this->masukModel;
        $id = $this->request->getPost('idMasuk');
        $data = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_keluar' => $this->request->getPost('tglKeluar'),
            'qty_keluar' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jenis_transaksi' =>$this->request->getPost('jenisTransaksi')
        );
        $masuk->updateData($data, $id);
        return redirect()->to('/admin/masuk');
    }

    public function delete_masuk(){
        $masuk = $this->masukModel;
        $id = $this->request->getPost('idMasuk');
        $masuk->deleteData($id);
        return redirect()->to('/admin/masuk');
    }

    public function keluar(){
        $keluar = $this->keluarModel->findAll();
        $data = [
            'title' => 'Daftar Barang Keluar',
            'keluar' => $keluar
        ];

        return view('admin/barang_keluar', $data);
    }

    public function save_keluar(){
        $masuk = $this->masukModel;
        $data = array(
            'id_masuk' => $this->request->getPost('idMasuk'),
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_keluar' => $this->request->getPost('tglKeluar'),
            'qty_keluar' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jenis_transaksi' =>$this->request->getPost('jenisTransaksi')
        );
        $masuk->saveData($data);
        return redirect()->to('/admin/masuk');
    }

    public function update_keluar(){
        $keluar = $this->keluarModel;
        $id = $this->request->getPost('idKeluar');
        $data = array(
            'id_barang' => $this->request->getPost('namaBarang'),
            'id_supplier'=> $this->request->getPost('namaSupplier'),
            'tgl_keluar' => $this->request->getPost('tglKeluar'),
            'qty_keluar' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jenis_transaksi' =>$this->request->getPost('jenisTransaksi')
        );
        $keluar->updateData($data, $id);
        return redirect()->to('/admin/keluar');
    }

    public function delete_keluar(){
        $keluar = $this->keluarModel;
        $id = $this->request->getPost('idKeluar');
        $keluar->deleteData($id);
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
