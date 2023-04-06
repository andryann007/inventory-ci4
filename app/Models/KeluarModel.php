<?php 

namespace App\Models;
use CodeIgniter\Model;

class KeluarModel extends Model{
    protected $table = 'data_barang_keluar';
    protected $primaryKey = 'id_keluar';

    public function getData(){
        return $this->db->table('data_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang')
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

    public function filterData($id){
        return $this->db->table('data_barang_keluar')
        -> join('data_stock', 'data_stock.id_barang = data_barang_keluar.id_barang')
        -> get()->getResultArray();
    }

    public function qty_keluar(){
        return $this->db->table('data_barang_keluar')->get()->getNumRows();
    }
}