<?php 

namespace App\Models;
use CodeIgniter\Model;

class AkunModel extends Model{
    protected $table = 'data_user';
    protected $primaryKey = 'id_user';

    public function getData(){
        $query = $this -> db -> table('data_user')
        -> get()->getResultArray();

        return $query;
    }

    public function getUsername(){
        $query = $this -> db -> table('data_user')
        -> get('username');

        return $query;
    }

    public function saveData($data){
        $query = $this -> db -> table('data_user')
        -> insert($data);
        
        return $query;
    }

    public function updateData($data, $id){
        $query = $this -> db -> table('data_user')
        -> update($data, array('id_user' => $id));
        
        return $query;
    }

    public function updateProfile($id, $data){
        $query = $this -> db -> table('data_user');
        $query -> where('id_user', $id);
        $query -> update($data);
        
        return $query;
    }

    public function qty_akun(){
        $query = $this -> db -> table('data_user')
        -> get() -> getNumRows();

        return $query;
    }
}