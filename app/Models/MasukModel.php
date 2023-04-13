<?php 

namespace App\Models;
use CodeIgniter\Model;
use PDO;

class MasukModel extends Model{
    protected $table = 'data_barang_masuk';
    protected $primaryKey = 'id_masuk';

    public function getData(){
        return $this->db->table('data_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang')
        -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier')
        -> get()->getResultArray();
    }

    public function saveData($data){
        $query = $this->db->table('data_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang')
        -> insert($data);
        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang')
        -> update($data, array('id_masuk' => $id));
        return $query;
    }

    public function deleteData($id){
        $query = $this->db->table('data_barang_masuk')
        -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang')
        -> delete(array('id_masuk' => $id));
        return $query;
    }

    public function filterRangeOfDate($tglMulai, $tglSelesai){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai);
        return $query->get()->getResultArray();
    }

    public function filterBarang($idBarang){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('data_barang_masuk.id_barang', $idBarang);
        return $query->get()->getResultArray();
    }

    public function filterKategori($kategori){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('kategori', $kategori);
        return $query->get()->getResultArray();
    }

    public function filterSupplier($idSupplier){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('data_barang_masuk.id_supplier', $idSupplier);
        return $query->get()->getResultArray();
    }

    public function filterDateBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai);
        $query->where('data_barang_masuk.id_barang', $idBarang);
        return $query->get()->getResultArray();
    }

    public function filterDateKategori($tglMulai, $tglSelesai, $kategori){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai);
        $query->where('kategori', $kategori);
        return $query->get()->getResultArray();
    }
    
    public function filterDateSupplier($tglMulai, $tglSelesai, $idSupplier){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai);
        $query->where('data_barang_masuk.id_supplier', $idSupplier);
        return $query->get()->getResultArray();
    }

    public function filterBarangSupplier($idBarang, $idSupplier){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('data_barang_masuk.id_barang', $idBarang);
        $query->where('data_barang_masuk.id_supplier', $idSupplier);
        return $query->get()->getResultArray();
    }

    public function filterKategoriSupplier($kategori, $idSupplier){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('kategori', $kategori);
        $query->where('data_barang_masuk.id_supplier', $idSupplier);
        return $query->get()->getResultArray();
    }

    public function filterDateBarangSupplier($tglMulai, $tglSelesai, $idBarang, $idSupplier){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai);
        $query->where('data_barang_masuk.id_barang', $idBarang);
        $query->where('data_barang_masuk.id_supplier', $idSupplier);
        return $query->get()->getResultArray();
    }

    public function filterDateKategoriSupplier($tglMulai, $tglSelesai, $kategori, $idSupplier){
        $query = $this->db->table('data_barang_masuk');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_masuk.id_barang');
        $query -> join('data_supplier', 'data_supplier.id_supplier = data_barang_masuk.id_supplier');
        $query->select('*');
        $query->where('tgl_masuk >=', $tglMulai) -> where('tgl_masuk <=', $tglSelesai);
        $query->where('kategori', $kategori);
        $query->where('data_barang_masuk.id_supplier', $idSupplier);
        return $query->get()->getResultArray();
    }

    public function qty_masuk(){
        return $this->db->table('data_barang_masuk')->get()->getNumRows();
    }

    public function grand_total(){
        $query = $this->db->query('SELECT SUM(total_harga_masuk) AS grand_total FROM data_barang_masuk');
        return $query->getRow()->grand_total;
    }
}