<?php 

namespace App\Models;
use CodeIgniter\Model;

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

    public function qty_masuk(){
        return $this->db->table('data_barang_masuk')->get()->getNumRows();
    }

    public function grand_total(){
        $query = $this->db->query('SELECT SUM(total_harga_masuk) AS grand_total FROM data_barang_masuk');
        return $query->getRow()->grand_total;
    }
}