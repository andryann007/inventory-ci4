<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\CustomerModel;
use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class Owner extends BaseController
{
    protected $akunModel;
    protected $supplierModel;
    protected $customerModel;
    protected $stockModel;
    protected $masukModel;
    protected $keluarModel;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
        $this->supplierModel = new SupplierModel();
        $this->customerModel = new CustomerModel();
        $this->stockModel = new StockModel();
        $this->masukModel = new MasukModel();
        $this->keluarModel = new KeluarModel();
    }

    public function index(){
        return view('owner/index');
    }

    public function akun(){
        helper(['form']);
        $akun = $this->akunModel->findAll();

        $data = [
            'title' => 'Daftar Akun',
            'akun' => $akun
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

        $akun->saveData($data);

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
        $akun->updateData($data, $id);
        return redirect()->to('/owner/akun');
    }

    public function delete_akun(){
        $akun = $this->akunModel;
        $id = $this->request->getPost('idUser');
        $akun->deleteData($id);
        return redirect()->to('/owner/akun');
    }

    public function supplier(){
        $supplier = $this->supplierModel->findAll();
        $data = [
            'title' => 'Daftar Supplier',
            'supplier' => $supplier
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
        $supplier->saveData($data);
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
        $supplier->updateData($data, $id);
        return redirect()->to('/owner/supplier');
    }

    public function delete_supplier(){
        $supplier = $this->supplierModel;
        $id = $this->request->getPost('idSupplier');
        $supplier->deleteData($id);
        return redirect()->to('/owner/supplier');
    }

    public function customer(){
        $customer = $this->customerModel->findAll();
        $data = [
            'title' => 'Daftar Customer',
            'customer' => $customer
        ];

        return view('owner/customer', $data);
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
        return redirect()->to('/owner/customer');
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
        return redirect()->to('/owner/customer');
    }

    public function delete_customer(){
        $customer = $this->customerModel;
        $id = $this->request->getPost('idCustomer');
        $customer->deleteData($id);
        return redirect()->to('/owner/customer');
    }

    public function stock(){
        $stock = $this->stockModel->findAll();
        $data = [
            'title' => 'Daftar Stock Barang',
            'stock' => $stock
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
        $stock->saveData($data);
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
        $stock->updateData($data, $id);
        return redirect()->to('/owner/stock');
    }

    public function delete_stock(){
        $stock = $this->stockModel;
        $id = $this->request->getPost('idBarang');
        $stock->deleteData($id);
        return redirect()->to('/owner/stock');
    }

    public function masuk(){
        $masuk = $this->masukModel->findAll();
        $data = [
            'title' => 'Daftar Barang Masuk',
            'masuk' => $masuk
        ];

        return view('owner/barang_masuk', $data);
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
        return redirect()->to('/owner/masuk');
    }

    public function update_masuk(){
        $masuk = $this->masukModel;
        $id = $this->request->getPost('idBarang');
        $data = array(
            'nama_barang' => $this->request->getPost('namaBarang'),
            'kategori'=> $this->request->getPost('kategoriBarang'),
            'qty_stock' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'status' => $this->request->getPost('status')
        );
        $masuk->updateData($data, $id);
        return redirect()->to('/owner/masuk');
    }

    public function delete_masuk(){
        $masuk = $this->masukModel;
        $id = $this->request->getPost('idBarang');
        $masuk->deleteData($id);
        return redirect()->to('/owner/masuk');
    }

    public function keluar(){
        return view('owner/barang_keluar');
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
