<?php 

namespace App\Models;
use CodeIgniter\Model;

class StockModel extends Model{
    protected $table = 'data_stock';
    protected $primaryKey = 'id_barang';

    public function getData(){
        return $this->db->table('data_stock');
    }

    public function saveData($data){
        $query = $this->db->table('data_stock')->insert($data);
        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_stock')->update($data, array('id_barang' => $id));
        return $query;
    }

    public function deleteData($id){
        $query = $this->db->table('data_stock')->delete(array('id_barang' => $id));
        return $query;
    }

    public function qty_stock(){
        return $this->db->table('data_stock')->get()->getNumRows();
    }
}