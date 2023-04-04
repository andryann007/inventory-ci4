<?php 

namespace App\Models;
use CodeIgniter\Model;

class CustomerModel extends Model{
    protected $table = 'data_customer';
    protected $primaryKey = 'id_customer';

    public function saveData($data){
        $query = $this->db->table('data_customer')->insert($data);
        return $query;
    }

    public function updateData($data, $id){
        $query = $this->db->table('data_customer')->update($data, array('id_customer' => $id));
        return $query;
    }

    public function deleteData($id){
        $query = $this->db->table('data_customer')->delete(array('id_customer' => $id));
        return $query;
    }
}