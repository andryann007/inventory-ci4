<?php 

namespace App\Models;
use CodeIgniter\Model;

class SupplierModel extends Model{
    protected $table = 'data_supplier';
    protected $primaryKey = 'id_supplier';

    public function getData(){
        $query = $this -> db -> table('data_supplier')
        -> get() -> getResultArray();

        return $query;
    }

    public function saveData($data){
        $query = $this -> db -> table('data_supplier')
        -> insert($data);

        return $query;
    }

    public function updateData($data, $id){
        $query = $this -> db -> table('data_supplier')
        -> update($data, array('id_supplier' => $id));

        return $query;
    }

    public function qty_supplier(){
        $query = $this -> db -> table('data_supplier')
        -> get() -> getNumRows();

        return $query;
    }
}