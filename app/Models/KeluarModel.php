<?php 

namespace App\Models;
use CodeIgniter\Model;

class KeluarModel extends Model{
    protected $table = 'data_barang_keluar';
    protected $primaryKey = 'id_keluar';

    public function getData(){
        $query = $this->db->table('data_barang_keluar')
        -> join('data_user', 'data_user.id_user = data_barang_keluar.id_user', 'inner')
        -> get()->getResultArray();

        return $query;
    }

    public function getDetailData($id){
        $query = $this->db->table('detail_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
        -> join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
        -> where('data_barang_keluar.id_keluar =', $id)
        -> get()->getResultArray();

        return $query;
    }

    public function getReportData(){
        $query = $this->db->table('data_barang_keluar')
        -> join('data_user', 'data_user.id_user = data_barang_keluar.id_user', 'inner')
        -> join('detail_barang_keluar', 'detail_barang_keluar.id_keluar = data_barang_keluar.id_keluar')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
        -> get()->getResultArray();

        return $query;
    }

    public function getKeluarQty($idKeluar){
        $query = $this->db->table('detail_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
        -> select('*')
        -> where('id_keluar', $idKeluar)
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
        $query = $this->db->table('data_barang_keluar')
        -> join('data_user', 'data_user.id_user = data_barang_keluar.id_user')
        -> insert($data);

        return $query;
    }

    public function saveDetailData($data){
        $query = $this->db->table('detail_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
        -> join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
        -> insert($data);

        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_barang_keluar') 
        -> join('data_user', 'data_user.id_user = data_barang_keluar.id_user')
        -> update($data, array('id_keluar' => $id));

        return $query;
    }

    public function updateDetailData($data, $idKeluar, $idBarang){
        $query = $this->db->table('detail_barang_keluar')
        -> update($data, array('id_keluar' => $idKeluar, 'id_barang' => $idBarang));

        return $query;
    }

    public function filterRangeOfDate($tglMulai, $tglSelesai){
        $query = $this->db->table('data_barang_keluar')
        -> join('data_user', 'data_user.id_user = data_barang_keluar.id_user')
        -> select('*')
        -> where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai)
        -> get()->getResultArray();

        return $query;
    }

    public function filterPetugas($idUser){
        $query = $this->db->table('data_barang_keluar')
        -> join('data_user', 'data_user.id_user = data_barang_keluar.id_user')
        -> select('*')
        -> where('data_barang_keluar.id_user', $idUser)
        -> get()->getResultArray();

        return $query;
    }

    public function filterAll($tglMulai, $tglSelesai, $idUser){
        $query = $this->db->table('data_barang_keluar')
        -> join('data_user', 'data_user.id_user = data_barang_keluar.id_user')
        -> select('*')
        -> where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai)
        -> where('data_barang_keluar.id_user', $idUser)
        -> get()->getResultArray();

        return $query;
    }

    public function totalQTYKeluar($idKeluar){ 
        $query = $this->db->table('data_barang_keluar')
        -> join('detail_barang_keluar', 'detail_barang_keluar.id_keluar = data_barang_keluar.id_keluar')
        -> select('SUM(qty_keluar) AS total_qty_keluar')
        -> where('data_barang_keluar.id_keluar =', $idKeluar)
        -> get() -> getRow() -> total_qty_keluar;

        return $query;
    }

    public function qty_keluar(){
        return $this->db->table('data_barang_keluar')->get()->getNumRows();
    }

    public function grandTotalPerDate($tglMulai, $tglSelesai){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('SUM(total_harga_keluar) AS grand_total');
        $query->where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerBarang($idBarang){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('SUM(total_harga_keluar) AS grand_total');
        $query->where('data_barang_keluar.id_barang', $idBarang);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerKategori($kategori){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('SUM(total_harga_keluar) AS grand_total');
        $query->where('kategori', $kategori);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerDateBarang($tglMulai, $tglSelesai, $idBarang){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('SUM(total_harga_keluar) AS grand_total');
        $query->where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai);
        $query->where('data_barang_keluar.id_barang', $idBarang);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalPerDateKategori($tglMulai, $tglSelesai, $kategori){
        $query = $this->db->table('data_barang_keluar');
        $query -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang');
        $query->select('SUM(total_harga_keluar) AS grand_total');
        $query->where('tgl_keluar >=', $tglMulai) -> where('tgl_keluar <=', $tglSelesai);
        $query->where('kategori', $kategori);
        return $query->get()->getRow()->grand_total;
    }

    public function grandTotalAll(){
        $query = $this->db->query('SELECT SUM(total_harga_keluar) AS grand_total FROM data_barang_keluar');
        return $query->getRow()->grand_total;
    }
}