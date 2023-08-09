<?php 

namespace App\Models;
use CodeIgniter\Model;

class StockModel extends Model{
    protected $table = 'data_stock';
    protected $primaryKey = 'id_barang';

    public function getData(){
        $query = $this -> db -> table('data_stock')
        -> get()->getResultArray();

        return $query;
    }

    public function saveData($data){
        $query = $this -> db -> table('data_stock')
        -> insert($data);

        return $query;
    }

    public function updateData($data, $id){
        $query = $this -> db -> table('data_stock')
        -> update($data, array('id_barang' => $id));
        
        return $query;
    }

    public function filterCategory($kategori){
        $query = $this -> db -> table('data_stock')
        -> select('*')
        -> where('kategori', $kategori)
        -> get()->getResultArray();

        return $query;
    }

    public function filterStatus($status){
        $query = $this -> db -> table('data_stock')
        -> select('*')
        -> where('status', $status)
        -> get() -> getResultArray();

        return $query;
    }

    public function filterCategoryStatus($kategori, $status){
        $query = $this -> db -> table('data_stock')
        -> select('*')
        -> where('kategori', $kategori)
        -> where('status', $status)
        -> get() -> getResultArray();

        return $query;
    }

    public function qty_stock(){
        $query = $this -> db -> table('data_stock')
        -> get() -> getNumRows();

        return $query;
    }

    public function stock_habis(){
        $query = $this -> db -> table('data_stock')
        -> where('qty_stock =', 0)
        -> get() -> getResultArray();

        return $query;
    }
    
    public function stock_sedikit(){
        $query = $this -> db -> table('data_stock')
        -> where('qty_stock <', 10)
        -> where('qty_stock >', 0)
        -> get() -> getResultArray();

        return $query;
    }
}