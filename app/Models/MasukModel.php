<?php 

namespace App\Models;
use CodeIgniter\Model;

class MasukModel extends Model{
    protected $table = 'data_barang_masuk';
    protected $primaryKey = 'id_masuk';

    public function getData(){
        $query = $this -> db -> table('data_barang_masuk')
        -> join('data_user', 'data_user.id_user = data_barang_masuk.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> get()->getResultArray();

        return $query;
    }

    public function getDetailData($id){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> where('data_barang_masuk.id_masuk =', $id)
        -> get()->getResultArray();

        return $query;
    }

    public function getDetailTotalHarga($id){
        $query = $this -> db -> table('detail_barang_masuk')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> where('data_barang_masuk.id_masuk =', $id)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function getReportData(){
        $query = $this -> db -> table('data_barang_masuk')
        -> join('data_user', 'data_user.id_user = data_barang_masuk.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> join('detail_barang_masuk', 'detail_barang_masuk.id_masuk = data_barang_masuk.id_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> get()->getResultArray();

        return $query;
    }

    public function getMasukQty($idMasuk){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> select('*')
        -> where('id_masuk', $idMasuk)
        -> get()->getRowArray();

        return $query;
    }

    public function getStockQty($idBarang){
        $query = $this -> db -> table('data_stock')
        -> select('*')
        -> where('id_barang =', $idBarang)
        -> get()-> getRowArray();

        return $query;
    }

    public function saveData($data){
        $query = $this -> db -> table('data_barang_masuk')
        -> join('data_user', 'data_user.id_user = data_barang_masuk.id_user')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supllier')
        -> insert($data);
        
        return $query;
    }

    public function saveDetailData($data){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> insert($data);

        return $query;
    }

    public function updateData($data, $idMasuk){
        $query = $this -> db -> table('data_barang_masuk') 
        -> join('data_user', 'data_user.id_user = data_barang_masuk.id_user')
        -> update($data, array('id_masuk' => $idMasuk));

        return $query;
    }

    public function updateDetailData($data, $idMasuk, $idBarang){
        $query = $this -> db -> table('detail_barang_masuk')
        -> update($data, array('id_masuk' => $idMasuk, 'id_barang' => $idBarang));
        
        return $query;
    }

    public function filterTanggalMasuk($tglMulai, $tglSelesai){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> select('*')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> get()->getResultArray();

        return $query;
    }

    public function filterBarang($idBarang){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> select('*')
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function filterSupplier($idSupplier){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> select('*')
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> get()->getResultArray();

        return $query;
    }

    public function filterTanggalBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> select('*')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function filterTanggalSupplier($tglMulai, $tglSelesai, $idSupplier){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> select('*')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> get()->getResultArray();

        return $query;
    }

    public function filterBarangSupplier($idBarang, $idSupplier){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> select('*')
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function filterAll($tglMulai, $tglSelesai, $idSupplier, $idBarang){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> select('*')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> get()->getResultArray();

        return $query;
    }

    public function totalQTYMasuk($idMasuk){ 
        $query = $this -> db -> table('data_barang_masuk')
        -> join('detail_barang_masuk', 'detail_barang_masuk.id_masuk = data_barang_masuk.id_masuk')
        -> select('SUM(qty_masuk) AS total_qty_masuk')
        -> where('data_barang_masuk.id_masuk =', $idMasuk)
        -> get() -> getRow() -> total_qty_masuk;

        return $query;
    }

    public function qty_masuk(){
        $query = $this -> db -> table('data_barang_masuk')
        -> get()->getNumRows();

        return $query;
    }

    public function grandTotalPerTanggal($tglMulai, $tglSelesai){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> get() -> getRow() -> grand_total;
        
        return $query;
    }

    public function grandTotalPerBarang($idBarang){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalPerSupplier($idSupplier){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalPerTanggalBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> get() -> getRow() -> grand_total;

        return $query;
    }
    
    public function grandTotalPerTanggalSupplier($tglMulai, $tglSelesai, $idSupplier){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalPerBarangSupplier($idBarang, $idSupplier){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalAllFilter($tglMulai, $tglSelesai, $idSupplier, $idBarang){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai)
        -> where('detail_barang_masuk.id_barang', $idBarang)
        -> where('data_barang_masuk.id_supplier', $idSupplier)
        -> get() -> getRow() -> grand_total;

        return $query;
    }

    public function grandTotalAll(){
        $query = $this -> db -> table('detail_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
        -> join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> selectSum('total_harga_masuk', 'grand_total')
        -> get() -> getRow() -> grand_total;

        return $query;
    }
}