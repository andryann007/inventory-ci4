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
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> where('data_retur_barang.id_retur =', $id)
        -> get()->getResultArray();

        return $query;
    }

    public function getDetailTotalHarga($id){
        $query = $this->db->table('detail_retur_barang')
        -> selectSum('total_harga_retur', 'grand_total')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> where('data_retur_barang.id_retur =', $id)
        -> get() -> getRow() -> grand_total;

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

    public function getReturQty($idRetur){
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

    public function filterTanggalRetur($tglMulai, $tglSelesai){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> get()->getResultArray();

        return $query;
    }

    public function filterBarang($idBarang){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function filterSupplier($idSupplier){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get()->getResultArray();

        return $query;
    }

    public function filterTanggalBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function filterTanggalSupplier($tglMulai, $tglSelesai, $idSupplier){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get()->getResultArray();

        return $query;
    }

    public function filterBarangSupplier($idBarang, $idSupplier){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function filterAll($tglMulai, $tglSelesai, $idSupplier, $idBarang){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> select('*')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function totalQTYRetur($idRetur){ 
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
    
    public function grandTotalPerTanggal($tglMulai, $tglSelesai){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> get() -> getRow() -> grand_total;
        
        return $query;
    }

    public function grandTotalPerBarang($idBarang){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalPerSupplier($idSupplier){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalPerTanggalBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> get() -> getRow() -> grand_total;

        return $query;
    }
    
    public function grandTotalPerTanggalSupplier($tglMulai, $tglSelesai, $idSupplier){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalPerBarangSupplier($idBarang, $idSupplier){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalAllFilter($tglMulai, $tglSelesai, $idSupplier, $idBarang){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> where('tgl_retur >=', $tglMulai) -> where('tgl_retur <=', $tglSelesai)
        -> where('detail_retur_barang.id_barang', $idBarang)
        -> where('data_retur_barang.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalAll(){
        $query = $this->db->table('detail_retur_barang')
        -> join('data_stock', 'data_stock.id_barang = detail_retur_barang.id_barang')
        -> join('data_retur_barang', 'data_retur_barang.id_retur = detail_retur_barang.id_retur', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_retur_barang.id_supplier')
        -> selectSum('total_harga_retur', 'grand_total')
        -> get() -> getRow() -> grand_total;

        return $query;
    }
}