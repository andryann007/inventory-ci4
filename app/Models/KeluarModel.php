<?php 

namespace App\Models;
use CodeIgniter\Model;

class KeluarModel extends Model{
    protected $table = 'data_barang_keluar';
    protected $primaryKey = 'id_keluar';

    public function getData(){
        return $this->db->table('data_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang', 'inner')
        -> get()->getResultArray();
    }

    public function saveData($data){
        $query = $this->db->table('data_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang')
        -> insert($data);
        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_barang_keluar') 
        -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang')
        -> update($data, array('id_keluar' => $id));
        return $query;
    }

    public function deleteData($id){
        $query = $this->db->table('data_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang')
        -> delete(array('id_keluar' => $id));
        return $query;
    }

    public function filterRangeOfDate($tglMulai, $tglSelesai){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('*');
        $query->where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai);
        return $query->get()->getResultArray();
    }

    public function filterBarang($idBarang){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('*');
        $query->where('data_barang_keluar.id_barang', $idBarang);
        return $query->get()->getResultArray();
    }

    public function filterKategori($kategori){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('*');
        $query->where('kategori', $kategori);
        return $query->get()->getResultArray();
    }

    public function filterDateBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('*');
        $query->where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai);
        $query->where('data_barang_keluar.id_barang', $idBarang);
        return $query->get()->getResultArray();
    }

    public function filterDateKategori($tglMulai, $tglSelesai, $kategori){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('*');
        $query->where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai);
        $query->where('kategori', $kategori);
        return $query->get()->getResultArray();
    }

    public function qty_keluar(){
        return $this->db->table('data_barang_keluar')->get()->getNumRows();
    }

    public function grand_total(){
        $query = $this->db->query('SELECT SUM(total_harga_keluar) AS grand_total FROM data_barang_keluar');
        return $query->getRow()->grand_total;
    }
}