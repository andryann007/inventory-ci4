<?php 

namespace App\Models;
use CodeIgniter\Model;

class ReturModel extends Model{
    protected $table = 'data_retur_barang';
    protected $primaryKey = 'id_retur';

    public function getData(){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> get()->getResultArray();

        return $query;
    }

    public function getDetailData($id){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> where('data_retur_barang.id_retur =', $id)
        -> get()->getResultArray();

        return $query;
    }

    public function getReportData(){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> join('detail_retur_barang', 'detail_retur_barang.id_retur = data_retur_barang.id_retur')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> get()->getResultArray();

        return $query;
    }

    public function getMasukQty($idRetur){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> select('*')
        -> where('id_retur', $idRetur)
        -> get()->getRowArray();

        return $query;
    }

    public function getStockQty($idBarang){
        $query = $this->db->table('data_stock')
        -> select('*')
        -> where('id_barang =', $idBarang)
        -> get()-> getRowArray();

        return $query;
    }

    public function saveData($data){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supllier')
        -> insert($data);
        
        return $query;
    }

    public function saveDetailData($data){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> insert($data);

        return $query;
    }

    public function updateData($data, $idRetur){
        $query = $this->db->table('data_retur_barang') 
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> update($data, array('id_retur' => $idRetur));

        return $query;
    }

    public function updateDetailData($data, $idRetur, $idBarang){
        $query = $this->db->table('detail_retur_barang')
        -> update($data, array('id_retur' => $idRetur, 'id_barang' => $idBarang));
        
        return $query;
    }

    public function filterRangeOfDate($tglMulai, $tglSelesai){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> get()->getResultArray();

        return $query;
    }

    public function filterPetugas($idUser){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('data_retur_barang.id_user', $idUser)
        -> get() -> getResultArray();

        return $query;
    }

    public function filterSupplier($idSupplier){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get() -> getResultArray();

        return $query;
    }

    public function filterTanggalPetugas($tglMulai, $tglSelesai, $idUser){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('data_retur_barang.id_user', $idUser)
        -> get()->getResultArray();

        return $query;
    }

    public function filterTanggalSupplier($tglMulai, $tglSelesai, $idSupplier){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get()->getResultArray();

        return $query;
    }

    public function filterAll($tglMulai, $tglSelesai, $idUser, $idSupplier){
        $query = $this->db->table('data_retur_barang')
        -> join('data_user', 'data_user.id_user = data_retur_barang.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('data_retur_barang.id_user', $idUser)
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get()->getResultArray();

        return $query;
    }

    public function totalQTYMasuk($idRetur){ 
        $query = $this->db->table('data_retur_barang')
        -> join('detail_retur_barang', 'detail_retur_barang.id_retur = data_retur_barang.id_retur')
        -> select('SUM(qty_retur) AS total_qty_retur')
        -> where('data_retur_barang.id_retur =', $idRetur)
        -> get() -> getRow() -> total_qty_retur;

        return $query;
    }

    public function qty_retur(){
        return $this->db->table('data_retur_barang')->get()->getNumRows();
    }
    
    public function grandTotalPerRangeOfDate($tglMulai, $tglSelesai){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerBarang($idBarang){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('data_retur_barang.id_barang', $idBarang);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerKategori($kategori){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('kategori', $kategori);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerSupplier($idSupplier){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('data_retur_barang.id_supplier', $idSupplier);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerDateBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai);
        $query->where('data_retur_barang.id_barang', $idBarang);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerDateKategori($tglMulai, $tglSelesai, $kategori){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai);
        $query->where('kategori', $kategori);
        return $query->get()->getRow()->grand_total;
    }
    
    public function grandTotalPerDateSupplier($tglMulai, $tglSelesai, $idSupplier){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai);
        $query->where('data_retur_barang.id_supplier', $idSupplier);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerBarangSupplier($idBarang, $idSupplier){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('data_retur_barang.id_barang', $idBarang);
        $query->where('data_retur_barang.id_supplier', $idSupplier);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerKategoriSupplier($kategori, $idSupplier){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('kategori', $kategori);
        $query->where('data_retur_barang.id_supplier', $idSupplier);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai);
        $query->where('data_retur_barang.id_barang', $idBarang);
        $query->where('data_retur_barang.id_supplier', $idSupplier);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier){
        $query = $this->db->table('data_retur_barang');
        $query -> join('data_stock', 'data_stock.id_barang = data_retur_barang.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier');
        $query->select('SUM(total_harga_retur) AS grand_total');
        $query->where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai);
        $query->where('kategori', $kategori);
        $query->where('data_retur_barang.id_supplier', $idSupplier);
        return $query->get()->getRow()->grand_total;
    }


    public function grandTotalAll(){
        $query = $this->db->query('SELECT SUM(total_harga_retur) AS grand_total FROM data_retur_barang');
        return $query->getRow()->grand_total;
    }
}