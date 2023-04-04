<?php 

namespace App\Models;
use CodeIgniter\Model;

class KeluarModel extends Model{
    protected $table = 'data_barang_keluar';
    protected $primaryKey = 'id_keluar';

    public function saveData($data){
        $query = $this->db->table('data_barang_keluar')->insert($data);
        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_barang_keluar')->update($data, array('id_keluar' => $id));
        return $query;
    }

    public function deleteData($id){
        $query = $this->db->table('data_barang_keluar')->delete(array('id_keluar' => $id));
        return $query;
    }
}