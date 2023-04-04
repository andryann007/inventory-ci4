<?php 

namespace App\Models;
use CodeIgniter\Model;

class MasukModel extends Model{
    protected $table = 'data_barang_masuk';
    protected $primaryKey = 'id_masuk';

    public function saveData($data){
        $query = $this->db->table('data_barang_masuk')->insert($data);
        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_barang_masuk')->update($data, array('id_masuk' => $id));
        return $query;
    }

    public function deleteData($id){
        $query = $this->db->table('data_barang_masuk')->delete(array('id_masuk' => $id));
        return $query;
    }
}