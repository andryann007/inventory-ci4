<?php 

namespace App\Models;
use CodeIgniter\Model;

class AkunModel extends Model{
    protected $table = 'data_user';
    protected $primaryKey = 'id_user';

    public function getData(){
        return $this->db->table('data_user');
    }

    public function saveData($data){
        $query = $this->db->table('data_user')->insert($data);
        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_user')->update($data, array('id_user' => $id));
        return $query;
    }

    public function deleteData($id){
        $query = $this->db->table('data_user')->delete(array('id_user' => $id));
        return $query;
    }

    public function qty_akun(){
        return $this->db->table('data_user')->get()->getNumRows();
    }
}