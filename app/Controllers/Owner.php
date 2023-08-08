<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\KeluarModel;
use App\Models\MasukModel;
use App\Models\ReturModel;
use App\Models\StockModel;
use App\Models\SupplierModel;

class Owner extends BaseController
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
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
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
    
            return view('owner/index', $data);
        }
    }

    public function akun(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $data = [
                'title' => 'Daftar Akun',
                'akun' => $this->akunModel->getData(),
                'stock' => $this->stockModel->getData()
            ];
            return view('owner/akun', $data);
        }
    }

    public function save_akun(){
        $akun = $this->akunModel;

        $data = array(
            'nama_lengkap' => $this->request->getPost('namaUser'),
            'email' => $this->request->getPost('emailUser'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('passUser'),
            'alamat'=> $this->request->getPost('alamatUser'),
            'telp' => $this->request->getPost('telpUser'),
            'tipe_akun' => $this->request->getPost('tipeAkunUser')
        );

        $success = $akun->saveData($data);

        if($success){
            $this->session->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Tambah !!!');
        }

        return redirect()->to('/owner/akun');
    }

    public function update_akun(){
        $akun = $this->akunModel;
        $id = $this->request->getPost('idUser');
        $data = array(
            'nama_lengkap' => $this->request->getPost('namaUser'),
            'email' => $this->request->getPost('emailUser'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('passUser'),
            'alamat'=> $this->request->getPost('alamatUser'),
            'telp' => $this->request->getPost('telpUser'),
            'tipe_akun' => $this->request->getPost('tipeAkunUser')
        );
        
        $success = $akun->updateData($data, $id);

        if($success){
            $this->session->setFlashdata('message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/akun');
    }

    public function supplier(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $data = [
                'title' => 'Daftar Supplier',
                'supplier' => $this->supplierModel->getData(),
                'stock' => $this->stockModel->getData()
            ];
            return view('owner/supplier', $data);
        }
    }

    public function save_supplier(){
        $supplier = $this->supplierModel;
        
        $data = array(
            'nama_supplier' => $this->request->getPost('namaSupplier'),
            'alamat'=> $this->request->getPost('alamatSupplier'),
            'email' => $this->request->getPost('emailSupplier'),
            'telp' => $this->request->getPost('telpSupplier')
        );
        
        $success = $supplier->saveData($data);

        if($success){
            $this->session->setFlashdata('message', 'Berhasil di Tambah !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Tambah !!!');
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
            $this->session->setFlashdata('message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/supplier');
    }

    public function stock(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
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
            else if ($status == null && $kategori != null){
                $data = [
                    'title' => 'Daftar Stock Barang',
                    'stock' => $this->stockModel->filterCategory($kategori)
                ];
                $this->session->setFlashdata('filter_stock_message', 'Berhasil di Filter (Filter Kategori) !!!');
            }
            
            //Jika input filter dari kategori tidak ada / kategori = semua, maka data akan di filter berdasarkan status
            else if($kategori == null && $status != null){
                $data = [
                    'title' => 'Daftar Stock Barang',
                    'stock' => $this->stockModel->filterStatus($status)
                ];
                $this->session->setFlashdata('filter_stock_message', 'Berhasil di Filter (Filter Status) !!!');
            }
            
            //Jika semua input filter ada, maka data akan di filter berdasarkan kategori & status
            else {
                $data = [
                    'title' => 'Daftar Stock Barang',
                    'stock' => $this->stockModel->filterCategoryStatus($kategori, $status)
                ];
                $this->session->setFlashdata('filter_stock_message', 'Berhasil di Filter (Filter Kategori & Status) !!!');
            }

            //Mendapatkan data sesuai kondisi filter
            $filterData = $data;

            return view('owner/stock', $filterData);
        }
    }

    public function save_stock(){
        $stock = $this->stockModel;
        $data = array(
            'nama_barang' => $this->request->getPost('namaBarang'),
            'kategori'=> $this->request->getPost('kategoriBarang'),
            'qty_stock' => $this->request->getPost('jumlahBarang'),
            'harga_satuan' => $this->request->getPost('hargaSatuan'),
            'total_harga' => $this->request->getPost('hargaSatuan') * $this->request->getPost('jumlahBarang'),
            'status' => $this->request->getPost('status')
        );
        
        $success = $stock->saveData($data);

        if($success){
            $this->session->setFlashdata('stock_message', 'Berhasil di Tambah !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Tambah !!!');
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
            $this->session->setFlashdata('stock_message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/stock');
    }

    public function masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idUser = $this->request->getPost('idUser');
            $idSupplier = $this->request->getPost('idSupplier');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'masuk' => $this->masukModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id petugas
            else if($tglMulai == null && $tglSelesai == null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterPetugas($idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 

            //Jika hanya terdapat filter terhadap id supplier
            else if($tglMulai == null && $tglSelesai == null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterSupplier($idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id petugas
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterTanggalPetugas($tglMulai, $tglSelesai, $idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat filter tanggal & filter id supplier
            else if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterTanggalSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat semua filter
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterAll($tglMulai, $tglSelesai, $idUser, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->getData(),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/barang_masuk', $filterData);
        }
    }

    public function save_masuk(){
        $masuk = $this->masukModel;
        $data = array(
            'id_user' => $this->request->getPost('idUser'),
            'id_supplier' => $this->request->getPost('idSupplier'),
            'tgl_masuk'=> $this->request->getPost('tglIncoming'),
            'no_faktur' => $this->request->getPost('noFaktur')
        );
        
        $success = $masuk->saveData($data);

        if($success){
            $this->session->setFlashdata('incoming_message', 'Berhasil di Tambah !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Tambah !!!');
        }
        return redirect()->to('/owner/masuk');
    }

    public function update_masuk(){
        $masuk = $this->masukModel;
        $id = $this->request->getPost('idMasuk');
        $data = array(
            'id_user' => $this->request->getPost('idUser'),
            'id_supplier' => $this->request->getPost('idSupplier'),
            'tgl_masuk'=> $this->request->getPost('tglIncoming'),
            'no_faktur' => $this->request->getPost('noFaktur')
        );
        $success = $masuk->updateData($data, $id);
        
        if($success){
            $this->session->setFlashdata('incoming_message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/masuk');
    }

    public function detail_masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $idMasuk = $this->request->getPost('idMasuk');
            $noFaktur = $this->request->getPost('noFaktur');
            $namaSupplier = $this->request->getPost('namaSupplier');
            $namaUser = $this->request->getPost('namaUser');
            $tglMasuk = $this->request->getPost('tglMasuk');

            $data = [
                'title' => 'Detail Barang Keluar',
                'masuk' => $this->masukModel->getDetailData($idMasuk),
                'user' => $this->akunModel->getData(),
                'supplier' => $this->supplierModel->getData(),
                'stock' => $this->stockModel->getData(),
                'id_masuk' => $idMasuk,
                'no_faktur' => $noFaktur,
                'nama_supplier' => $namaSupplier,
                'nama_lengkap' => $namaUser,
                'tgl_masuk' => $tglMasuk
            ];

            $filterData = $data;

            return view('owner/detail_barang_masuk', $filterData);
        }
    }

    public function save_detail_masuk(){
        $stock = $this->stockModel;
        $masuk = $this->masukModel;

        if($this->request->isAJAX()){
            $idMasuk = $this->request->getVar('idMasuk');
            $idBarang = $this->request->getVar('namaBarang');
            $qtyMasuk = $this->request->getVar('jumlahBarang');
            $hargaSatuan = $this->request->getVar('hargaSatuan');
            $keterangan = $this->request->getVar("keterangan");

            $jumlahData = count($idBarang);

            for($i=0; $i<$jumlahData; $i++){
                $row[$i] = $masuk->getStockQty($idBarang[$i]);
                $rowStock[$i] = $row[$i]['qty_stock'];
                $rowHargaSatuan[$i] = $row[$i]['harga_satuan'];

                $stockBaru[$i] = $rowStock[$i] + $qtyMasuk[$i];
                $totalHargaBaru[$i] = ($rowStock[$i] + $qtyMasuk[$i]) * $rowHargaSatuan[$i];
                
                $dataStock[$i] = array(
                    'qty_stock' => $stockBaru[$i],
                    'total_harga' => $totalHargaBaru[$i],
                    'status' => "tersedia"
                );

                $dataMasuk = array(
                    'id_masuk' => $idMasuk,
                    'id_barang' => $idBarang[$i],
                    'qty_masuk' => $qtyMasuk[$i],
                    'harga_satuan_masuk' => $hargaSatuan[$i],
                    'total_harga_masuk' => $qtyMasuk[$i] * $hargaSatuan[$i],
                    'keterangan' => $keterangan[$i]
                );

                $stock->updateData($dataStock[$i], $idBarang[$i]);
                $masuk->saveDetailData($dataMasuk);

                $this->session->setFlashdata('incoming_message', "$jumlahData Data Berhasil di Tambah !!!");
            }
        }

        $msg = [
            'success' => 'Data Barang Masuk Berhasil di Proses'
        ];

        echo json_encode($msg);
    }

    public function update_detail_masuk(){
        $masuk = $this->masukModel;
        $stock = $this->stockModel;

        $idMasuk = $this->request->getPost('idMasuk');
        $idBarang = $this->request->getPost('idBarang');

        $stockBarangMasukBaru = $this->request->getPost('qtyMasuk');
        
        $rowMasuk = $masuk->getMasukQty($idMasuk);
        
        $rowStock = $masuk->getStockQty($idBarang);

        $dataMasuk = array(
            'id_barang' => $this->request->getPost('idBarang'),
            'qty_masuk' => $this->request->getPost('qtyMasuk'),
            'harga_satuan_masuk' => $this->request->getPost('hargaSatuan'),
            'total_harga_masuk' => $this->request->getPost('hargaSatuan') * $this->request->getPost('qtyMasuk'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $dataStock = array(
            'qty_stock' => ((int)$rowStock['qty_stock'] - (int)$rowMasuk['qty_masuk']) + (int)$stockBarangMasukBaru,
            'total_harga' => (((int)$rowStock['qty_stock'] - (int)$rowMasuk['qty_masuk']) + (int)$stockBarangMasukBaru) * (int)$rowStock['harga_satuan']
        );
        
        $successUpdate = $masuk->updateData($dataMasuk, $idMasuk);
        $updateStock = $stock->updateData($dataStock, $idBarang);

        if($successUpdate & $updateStock){
            $this->session->setFlashdata('incoming_message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/masuk');
    }

    public function keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idUser = $this->request->getPost('idUser');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idUser == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id petugas
            else if($tglMulai == null && $tglSelesai == null && $idUser != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterBarang($idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id petugas
            else if($tglMulai != null && $tglSelesai != null && $idUser != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateBarang($tglMulai, $tglSelesai, $idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->getData(),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/barang_keluar', $filterData);
        }
    }

    public function save_keluar(){
        $keluar = $this->keluarModel;
        $data = array(
            'id_user' => $this->request->getPost('idUser'),
            'tgl_keluar'=> $this->request->getPost('tglOutcoming'),
            'no_faktur' => $this->request->getPost('noFaktur')
        );
        
        $success = $keluar->saveData($data);

        if($success){
            $this->session->setFlashdata('outcoming_message', 'Berhasil di Tambah !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Tambah !!!');
        }
        return redirect()->to('/owner/keluar');
    }

    public function update_keluar(){
        $keluar = $this->keluarModel;
        $id = $this->request->getPost('idKeluar');
        $data = array(
            'id_user' => $this->request->getPost('idUser'),
            'tgl_keluar'=> $this->request->getPost('tglOutcoming'),
            'no_faktur' => $this->request->getPost('noFaktur')
        );
        $success = $keluar->updateData($data, $id);
        
        if($success){
            $this->session->setFlashdata('outcoming_message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/keluar');
    }

    public function detail_keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $idKeluar = $this->request->getPost('idKeluar');
            $noFaktur = $this->request->getPost('noFaktur');
            $namaUser = $this->request->getPost('namaUser');
            $tglKeluar = $this->request->getPost('tglKeluar');

            $data = [
                'title' => 'Detail Barang Keluar',
                'keluar' => $this->keluarModel->getDetailData($idKeluar),
                'user' => $this->akunModel->getData(),
                'stock' => $this->stockModel->getData(),
                'id_keluar' => $idKeluar,
                'no_faktur' => $noFaktur,
                'nama_lengkap' => $namaUser,
                'tgl_keluar' => $tglKeluar
            ];

            $filterData = $data;

            return view('owner/detail_barang_keluar', $filterData);
        }
    }

    public function save_detail_keluar(){
        $stock = $this->stockModel;
        $keluar = $this->keluarModel;

        if($this->request->isAJAX()){
            $idKeluar = $this->request->getVar('idKeluar');
            $idBarang = $this->request->getVar('namaBarang');
            $qtyKeluar = $this->request->getVar('jumlahBarang');
            $hargaSatuan = $this->request->getVar('hargaSatuan');
            $keterangan = $this->request->getVar("keterangan");

            $jumlahData = count($idBarang);

            for($i=0; $i<$jumlahData; $i++){
                $row[$i] = $keluar->getStockQty($idBarang[$i]);
                $rowStock[$i] = $row[$i]['qty_stock'];
                $rowHargaSatuan[$i] = $row[$i]['harga_satuan'];

                $stockBaru[$i] = $rowStock[$i] - $qtyKeluar[$i];
                $totalHargaBaru[$i] = ($rowStock[$i] - $qtyKeluar[$i]) * $rowHargaSatuan[$i];
                
                if($stockBaru[$i] == 0){
                    $dataStock[$i] = array(
                        'qty_stock' => 0,
                        'total_harga' => $totalHargaBaru[$i],
                        'status' => "habis"
                    );
                } else {
                    $dataStock[$i] = array(
                        'qty_stock' => $stockBaru[$i],
                        'total_harga' => $totalHargaBaru[$i]
                    );   
                }

                if($rowStock[$i] >= $qtyKeluar[$i]){
                    $dataKeluar = array(
                        'id_keluar' => $idKeluar,
                        'id_barang' => $idBarang[$i],
                        'qty_keluar' => $qtyKeluar[$i],
                        'harga_satuan_keluar' => $hargaSatuan[$i],
                        'total_harga_keluar' => $qtyKeluar[$i] * $hargaSatuan[$i],
                        'keterangan' => $keterangan[$i]
                    );

                    $stock->updateData($dataStock[$i], $idBarang[$i]);
                    $keluar->saveDetailData($dataKeluar);

                    $this->session->setFlashdata('outcoming_message', "$jumlahData Data Berhasil di Tambah !!!");
                } else if($rowStock[$i] < $qtyKeluar[$i]){
                    $this->session->setFlashdata('error', "Gagal di Tambah !!!");
                }
            }

            $msg = [
                'success' => 'Data Barang Keluar Berhasil di Proses'
            ];

            echo json_encode($msg);
        }
    }

    public function update_detail_keluar(){
        $keluar = $this->keluarModel;
        $stock = $this->stockModel;

        $idKeluar = $this->request->getPost('idKeluar');
        $idBarang = $this->request->getPost('idBarang');

        $stockBarangKeluarBaru = $this->request->getPost('qtyKeluar');
        
        $rowKeluar = $keluar->getKeluarQty($idKeluar);

        $rowStock = $keluar->getStockQty($idBarang);

        $dataKeluar = array(
            'id_barang' => $this->request->getPost('idBarang'),
            'qty_keluar' => $this->request->getPost('qtyKeluar'),
            'harga_satuan_keluar' => $this->request->getPost('hargaSatuan'),
            'total_harga_keluar' => $this->request->getPost('hargaSatuan') * $this->request->getPost('qtyKeluar'),
            'keterangan' => $this->request->getPost('keterangan')
        );
        
        $stockBaru = ($rowStock['qty_stock'] + $rowKeluar['qty_keluar']) - $stockBarangKeluarBaru;
        $totalHargaBaru =(($rowStock['qty_stock'] + $rowKeluar['qty_keluar']) - $stockBarangKeluarBaru) * $rowStock['harga_satuan'];

        if($stockBaru == 0){
            $dataStock = array(
                'qty_stock' => "0",
                'total_harga' => $totalHargaBaru,
                'status' => "habis"
            );
        } else {
            $dataStock = array(
                'qty_stock' => $stockBaru,
                'total_harga' => $totalHargaBaru
            );
        }
        
        if($rowStock['qty_stock'] >= $stockBarangKeluarBaru){
            $successUpdate = $keluar->updateDetailData($dataKeluar, $idKeluar, $idBarang);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successUpdate & $updateStock){
                $this->session->setFlashdata('outcoming_message', 'Berhasil di Update !!!');
            }
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/keluar');
    }

    public function retur(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idUser = $this->request->getPost('idUser');
            $idSupplier = $this->request->getPost('idSupplier');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'retur' => $this->returModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id petugas
            else if($tglMulai == null && $tglSelesai == null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterPetugas($idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 

            //Jika hanya terdapat filter terhadap id supplier
            else if($tglMulai == null && $tglSelesai == null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterSupplier($idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id petugas
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterTanggalPetugas($tglMulai, $tglSelesai, $idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat filter tanggal & filter id supplier
            else if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterTanggalSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat semua filter
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterAll($tglMulai, $tglSelesai, $idUser, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->getData(),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/retur_barang', $filterData);
        }
    }

    public function save_retur(){
        $retur = $this->returModel;
        $data = array(
            'id_user' => $this->request->getPost('idUser'),
            'id_supplier' => $this->request->getPost('idSupplier'),
            'tgl_retur'=> $this->request->getPost('tglReturning'),
            'no_faktur' => $this->request->getPost('noFaktur')
        );
        
        $success = $retur->saveData($data);

        if($success){
            $this->session->setFlashdata('returning_message', 'Berhasil di Tambah !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Tambah !!!');
        }
        return redirect()->to('/owner/retur');
    }

    public function update_retur(){
        $retur = $this->returModel;
        $id = $this->request->getPost('idRetur');
        $data = array(
            'id_user' => $this->request->getPost('idUser'),
            'id_supplier' => $this->request->getPost('idSupplier'),
            'tgl_retur'=> $this->request->getPost('tglReturning'),
            'no_faktur' => $this->request->getPost('noFaktur')
        );
        $success = $retur->updateData($data, $id);
        
        if($success){
            $this->session->setFlashdata('returning_message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/retur');
    }

    public function detail_retur(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $idRetur = $this->request->getPost('idRetur');
            $noFaktur = $this->request->getPost('noFaktur');
            $namaSupplier = $this->request->getPost('namaSupplier');
            $namaUser = $this->request->getPost('namaUser');
            $tglRetur = $this->request->getPost('tglRetur');

            $data = [
                'title' => 'Detail Retur Barang',
                'retur' => $this->returModel->getDetailData($idRetur),
                'user' => $this->akunModel->getData(),
                'supplier' => $this->supplierModel->getData(),
                'stock' => $this->stockModel->getData(),
                'id_retur' => $idRetur,
                'no_faktur' => $noFaktur,
                'nama_supplier' => $namaSupplier,
                'nama_lengkap' => $namaUser,
                'tgl_retur' => $tglRetur
            ];

            $filterData = $data;

            return view('owner/detail_retur', $filterData);
        }
    }

    public function save_detail_retur(){
        $stock = $this->stockModel;
        $retur = $this->returModel;

        if($this->request->isAJAX()){
            $idRetur = $this->request->getVar('idRetur');
            $idBarang = $this->request->getVar('namaBarang');
            $qtyRetur = $this->request->getVar('jumlahBarang');
            $hargaSatuan = $this->request->getVar('hargaSatuan');
            $keterangan = $this->request->getVar("keterangan");

            $jumlahData = count($idBarang);

            for($i=0; $i<$jumlahData; $i++){
                $row[$i] = $retur->getStockQty($idBarang[$i]);
                $rowStock[$i] = $row[$i]['qty_stock'];
                $rowHargaSatuan[$i] = $row[$i]['harga_satuan'];

                $stockBaru[$i] = $rowStock[$i] + $qtyRetur[$i];
                $totalHargaBaru[$i] = ($rowStock[$i] + $qtyRetur[$i]) * $rowHargaSatuan[$i];
                
                if($stockBaru[$i] == 0){
                    $dataStock[$i] = array(
                        'qty_stock' => 0,
                        'total_harga' => $totalHargaBaru[$i],
                        'status' => "habis"
                    );
                } else {
                    $dataStock[$i] = array(
                        'qty_stock' => $stockBaru[$i],
                        'total_harga' => $totalHargaBaru[$i]
                    );   
                }

                if($rowStock[$i] >= $qtyRetur[$i]){
                    $dataRetur = array(
                        'id_retur' => $idRetur,
                        'id_barang' => $idBarang[$i],
                        'qty_retur' => $qtyRetur[$i],
                        'harga_satuan_retur' => $hargaSatuan[$i],
                        'total_harga_retur' => $qtyRetur[$i] * $hargaSatuan[$i],
                        'keterangan' => $keterangan[$i]
                    );

                    $stock->updateData($dataStock[$i], $idBarang[$i]);
                    $retur->saveDetailData($dataRetur);

                    $this->session->setFlashdata('returning_message', "$jumlahData Data Berhasil di Tambah !!!");
                } else if($rowStock[$i] < $qtyRetur[$i]){
                    $this->session->setFlashdata('error', "Gagal di Tambah !!!");
                }
            }
        }

        $msg = [
            'success' => 'Data Barang Retur Berhasil di Proses'
        ];

        echo json_encode($msg);
    }

    public function update_detail_retur(){
        $retur = $this->returModel;
        $stock = $this->stockModel;

        $idRetur = $this->request->getPost('idRetur');
        $idBarang = $this->request->getPost('idBarang');

        $stockBarangReturBaru = $this->request->getPost('qtyRetur');
        
        $rowRetur = $retur->getReturQty($idRetur);
        
        $rowStock = $retur->getStockQty($idBarang);

        $dataRetur = array(
            'id_barang' => $this->request->getPost('idBarang'),
            'qty_retur' => $this->request->getPost('qtyRetur'),
            'harga_satuan_retur' => $this->request->getPost('hargaSatuan'),
            'total_harga_retur' => $this->request->getPost('hargaSatuan') * $this->request->getPost('qtyRetur'),
            'keterangan' => $this->request->getPost('keterangan')
        );

        $dataStock = array(
            'qty_stock' => ((int)$rowStock['qty_stock'] - (int)$rowRetur['qty_retur']) + (int)$stockBarangReturBaru,
            'total_harga' => (((int)$rowStock['qty_stock'] - (int)$rowRetur['qty_retur']) + (int)$stockBarangReturBaru) * (int)$rowStock['harga_satuan']
        );
        
        $successUpdate = $retur->updateData($dataRetur, $idRetur);
        $updateStock = $stock->updateData($dataStock, $idBarang);

        if($successUpdate & $updateStock){
            $this->session->setFlashdata('returning_message', 'Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Gagal di Update !!!');
        }

        return redirect()->to('/owner/retur');
    }

    public function laporan_masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idUser = $this->request->getPost('idUser');
            $idSupplier = $this->request->getPost('idSupplier');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'masuk' => $this->masukModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id petugas
            else if($tglMulai == null && $tglSelesai == null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterPetugas($idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 

            //Jika hanya terdapat filter terhadap id supplier
            else if($tglMulai == null && $tglSelesai == null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterSupplier($idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id petugas
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterTanggalPetugas($tglMulai, $tglSelesai, $idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat filter tanggal & filter id supplier
            else if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterTanggalSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat semua filter
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->filterAll($tglMulai, $tglSelesai, $idUser, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Masuk',
                    'masuk' => $this->masukModel->getReportData(),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/laporan_masuk', $filterData);
        }
    }

    public function laporan_keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idUser = $this->request->getPost('idUser');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idUser == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id petugas
            else if($tglMulai == null && $tglSelesai == null && $idUser != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterBarang($idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id petugas
            else if($tglMulai != null && $tglSelesai != null && $idUser != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateBarang($tglMulai, $tglSelesai, $idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->getReportData(),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/laporan_keluar', $filterData);
        }
    }

    public function laporan_retur(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $tglMulai = $this->request->getPost('tglMulai');
            $tglSelesai = $this->request->getPost('tglSelesai');
            $idUser = $this->request->getPost('idUser');
            $idSupplier = $this->request->getPost('idSupplier');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'retur' => $this->returModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id petugas
            else if($tglMulai == null && $tglSelesai == null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterPetugas($idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 

            //Jika hanya terdapat filter terhadap id supplier
            else if($tglMulai == null && $tglSelesai == null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterSupplier($idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Petugas) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id petugas
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier == null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterTanggalPetugas($tglMulai, $tglSelesai, $idUser),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat filter tanggal & filter id supplier
            else if($tglMulai != null && $tglSelesai != null && $idUser == null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterTanggalSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika hanya terdapat semua filter
            else if($tglMulai != null && $tglSelesai != null && $idUser != null && $idSupplier != null){
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->filterAll($tglMulai, $tglSelesai, $idUser, $idSupplier),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Petugas) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Retur',
                    'retur' => $this->returModel->getReportData(),
                    'user' => $this->akunModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/laporan_retur', $filterData);
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
        else {
            $data = [
                'title' => 'Laporan Barang Masuk',
                'masuk' => $this->masukModel->getData(),
                'grand_total' => $this->masukModel->grandTotalAll()
            ];
        }

        $filterData = $data;

        return view('owner/print_masuk', $filterData);
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

        return view('owner/print_keluar', $filterData);
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
        else {
            $data = [
                'title' => 'Laporan Retur Barang',
                'retur' => $this->returModel->getData(),
                'grand_total' => $this->returModel->grandTotalAll()
            ];
        }

        $filterData = $data;

        return view('owner/print_retur', $filterData);
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
            'telp' => $this->request->getPost('telpUser'),
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
            
            $this->session->setFlashdata('message', 'Profil Berhasil di Update !!!');
        } else {
            $this->session->setFlashdata('error', 'Profil Gagal di Update !!!');
        }

        return redirect()->to('/owner');
    }
    
    public function logout(){
        session() -> remove('logged_in');
        session() -> destroy();
        
        $this->session->setFlashdata('message', 'Ada Berhasil Logout !!!');
        return redirect() -> to('/home');
    }
}
