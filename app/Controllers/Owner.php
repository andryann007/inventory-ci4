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
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            }

            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Supplier) !!!');
            }

            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Barang) !!!');
            }

            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Kategori) !!!');
            }

            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Supplier) !!!');
            }

            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Barang) !!!');
            }

            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal & Kategori) !!!');
            }

            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Barang & Supplier) !!!');
            }

            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Kategori & Supplier) !!!');
            }

            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal, Barang, & Supplier) !!!');
            }

            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_message', 'Berhasil di Filter (Filter Tanggal, Kategori, & Supplier) !!!');
            }

            // Jika tidak terdapat filter
            else {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/barang_masuk', $filterData);
        }
    }

    public function tambah_barang_masuk(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $data = [
                'title' => 'Tambah Data Barang Keluar',
                'stock' => $this->stockModel->getData(),
                'supplier' => $this->supplierModel->getData()
            ];

            return view('owner/tambah_barang_masuk', $data);
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
                    'status' => "tersedia"
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

                $this->session->setFlashdata('incoming_message', "$jumlahData Data Berhasil di Tambah !!!");
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
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id barang
            else if($tglMulai == null && $tglSelesai == null && $idBarang != null && $kategori == null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Barang) !!!');
            } 

            //Jika hanya terdapat filter terhadap kategori
            else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Kategori) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id barang
            else if($tglMulai != null && $tglSelesai != null && $idBarang != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Tanggal & Barang) !!!');
            }

            //Jika hanya terdapat filter tanggal & filter kategori
            else if($tglMulai != null && $tglSelesai != null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_message', 'Berhasil di Filter (Filter Tanggal & Kategori) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/barang_keluar', $filterData);
        }
    }

    public function tambah_barang_keluar(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $data = [
                'title' => 'Tambah Data Barang Keluar',
                'stock' => $this->stockModel->getData()
            ];

            return view('owner/tambah_barang_keluar', $data);
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
                        'status' => "habis"
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
            $successUpdate = $keluar->updateData($dataKeluar, $idKeluar);
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
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Tanggal) !!!');
            }

            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Supplier) !!!');
            }

            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Barang) !!!');
            }

            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Kategori) !!!');
            }

            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Tanggal & Supplier) !!!');
            }

            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Tanggal & Barang) !!!');
            }

            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Tanggal & Kategori) !!!');
            }

            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Barang & Supplier) !!!');
            }

            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Kategori & Supplier) !!!');
            }

            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Tanggal, Barang, & Supplier) !!!');
            }

            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_message', 'Berhasil di Filter (Filter Tanggal, Kategori, & Supplier) !!!');
            }

            // Jika tidak terdapat filter
            else {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
            }

            $filterData = $data;

            return view('owner/retur_barang', $filterData);
        }
    }

    public function tambah_retur_barang(){
        if(!session()->has("logged_in")){
            return redirect()->to('home');
        } else if(session()->get('tipe_akun') == "admin"){
            return redirect()->to('admin');
        } else if(session()->get('tipe_akun') == "user"){
            return redirect()->to('user');
        } else {
            $data = [
                'title' => 'Tambah Data Barang Keluar',
                'stock' => $this->stockModel->getData(),
                'supplier' => $this->supplierModel->getData()
            ];

            return view('owner/tambah_retur_barang', $data);
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
                    'status' => "tersedia"
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

                    $this->session->setFlashdata('returning_message', "$jumlahData Data Berhasil di Tambah !!!");
                } else if($rowStock[$i] < $qtyRetur[$i]){
                    $this->session->setFlashdata('error', "Gagal di Tambah !!!");
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

        $stockBaru = ($rowStock['qty_stock'] + $rowRetur['qty_retur']) - $stockReturBarangBaru;
        $totalHargaBaru = (($rowStock['qty_stock'] + $rowRetur['qty_retur']) - $stockReturBarangBaru) * $rowStock['harga_satuan'];

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

        if($rowStock['qty_stock'] >= $stockReturBarangBaru){
            $successUpdate = $retur->updateData($dataRetur, $idRetur);
            $updateStock = $stock->updateData($dataStock, $idBarang);
            
            if($successUpdate & $updateStock){
                $this->session->setFlashdata('returning_message', 'Berhasil di Update !!!');
            }
        } else if($rowStock['qty_stock'] < $stockReturBarangBaru) {
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
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Tanggal) !!!');
            }

            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Supplier) !!!');
            }

            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Barang) !!!');
            }

            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Kategori) !!!');
            }

            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Tanggal & Supplier) !!!');
            }

            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Tanggal & Barang) !!!');
            }

            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Tanggal & Kategori) !!!');
            }

            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Barang & Supplier) !!!');
            }

            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Kategori & Supplier) !!!');
            }

            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Tanggal, Barang, & Supplier) !!!');
            }

            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_incoming_report', 'Berhasil di Filter (Filter Tanggal, Kategori, & Supplier) !!!');
            }

            // Jika tidak terdapat filter
            else {
                $data = [
                    'title' => 'Laporan Barang Masuk',
                    'masuk' => $this->masukModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('all_incoming_report', 'Berhasil Menampilkan Semua Laporan Barang Masuk !!!');
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
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');

            //Jika hanya terdapat filter terhadap tanggal
            if($tglMulai != null && $tglSelesai != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_report', 'Berhasil di Filter (Filter Tanggal) !!!');
            } 
            
            //Jika hanya terdapat filter terhadap id barang
            else if($tglMulai == null && $tglSelesai == null && $idBarang != null && $kategori == null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_report', 'Berhasil di Filter (Filter Barang) !!!');
            } 

            //Jika hanya terdapat filter terhadap kategori
            else if($tglMulai == null && $tglSelesai == null && $idBarang == null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_report', 'Berhasil di Filter (Filter Kategori) !!!');
            } 
            
            //Jika hanya terdapat filter tanggal & filter id barang
            else if($tglMulai != null && $tglSelesai != null && $idBarang != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_report', 'Berhasil di Filter (Filter Tanggal & Barang) !!!');
            }

            //Jika hanya terdapat filter tanggal & filter kategori
            else if($tglMulai != null && $tglSelesai != null && $kategori != null){
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('filter_outcoming_report', 'Berhasil di Filter (Filter Tanggal & Kategori) !!!');
            }

            //Jika tidak terdapat filter, maka data yang ditampilkan semua
            else {
                $data = [
                    'title' => 'Daftar Barang Keluar',
                    'keluar' => $this->keluarModel->getData(),
                    'stock' => $this->stockModel->getData()
                ];
                $this->session->setFlashdata('all_outcoming_report', 'Berhasil Menampilkan Semua Laporan Barang Keluar !!!');
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
            $idSupplier = $this->request->getPost('idSupplier');
            $idBarang = $this->request->getPost('idBarang');
            $kategori = $this->request->getPost('kategoriBarang');
    
            // Jika hanya terdapat filter di rentang tanggal
            if($tglMulai !=null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterRangeOfDate($tglMulai, $tglSelesai),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Tanggal) !!!');
            }
    
            // Jika hanya terdapat filter di nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterSupplier($idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Supplier) !!!');
            }
    
            // Jika hanya terdapat filter di nama barang
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarang($idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Barang) !!!');
            }
    
            // Jika hanya terdapat filter di kategori
            else if($tglMulai == null && $tglSelesai == null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategori($kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Kategori) !!!');
            }
    
            // Jika hanya terdapat filter di nama supplier & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateSupplier($tglMulai, $tglSelesai, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Tanggal & Supplier) !!!');
            }
    
            // Jika hanya terdapat filter di nama barang & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarang($tglMulai, $tglSelesai, $idBarang),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Tanggal & Barang) !!!');
            }
    
            // Jika hanya terdapat filter di kategori & rentang tanggal
            else if($tglMulai != null && $tglSelesai != null && $idSupplier == null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategori($tglMulai, $tglSelesai, $kategori),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Tanggal & Kategori) !!!');
            }
    
            // Jika hanya terdapat filter di nama barang & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterBarangSupplier($idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Barang & Supplier) !!!');
            }
    
            // Jika hanya terdapat filter di kategori & nama supplier
            else if($tglMulai == null && $tglSelesai == null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterKategoriSupplier($kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Kategori & Supplier) !!!');
            }
    
            // Jika terdapat semua filter (tidak termasuk filter kategori)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang != null && $kategori == null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Tanggal, Barang, & Supplier) !!!');
            }
    
            // Jika terdapat semua filter (tidak termasuk filter nama barang)
            else if($tglMulai != null && $tglSelesai != null && $idSupplier != null && $idBarang == null && $kategori != null) {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('filter_returning_report', 'Berhasil di Filter (Filter Tanggal, Kategori, & Supplier) !!!');
            }
    
            // Jika tidak terdapat filter
            else {
                $data = [
                    'title' => 'Laporan Retur Barang',
                    'retur' => $this->returModel->getData(),
                    'stock' => $this->stockModel->getData(),
                    'supplier' => $this->supplierModel->getData()
                ];
                $this->session->setFlashdata('all_returning_report', 'Berhasil Menampilkan Semua Laporan Retur Barang !!!');
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
