<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluarModel extends Model
{
    protected $table = 'data_barang_keluar';
    protected $primaryKey = 'id_keluar';

    public function getData()
    {
        $query = $this->db->table('data_barang_keluar')
            ->join('data_user', 'data_user.id_user = data_barang_keluar.id_user', 'inner')
            ->get()->getResultArray();

        return $query;
    }

    public function getDetailData($id)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->where('data_barang_keluar.id_keluar =', $id)
            ->get()->getResultArray();

        return $query;
    }

    public function getDetailTotalHarga($id)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->selectSum('total_harga_keluar', 'grand_total')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->where('data_barang_keluar.id_keluar =', $id)
            ->get()->getRow()->grand_total;

        return $query;
    }

    public function getReportData()
    {
        $query = $this->db->table('data_barang_keluar')
            ->join('data_user', 'data_user.id_user = data_barang_keluar.id_user', 'inner')
            ->join('detail_barang_keluar', 'detail_barang_keluar.id_keluar = data_barang_keluar.id_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->get()->getResultArray();

        return $query;
    }

    public function getKeluarQty($idKeluar)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->selectSum('qty_keluar', 'total_qty_keluar')
            ->where('id_keluar', $idKeluar)
            ->get()->getRowArray();

        return $query;
    }

    public function getStockQty($idBarang)
    {
        $query = $this->db->table('data_stock')
            ->select('*')
            ->where('id_barang =', $idBarang)
            ->get()->getRowArray();

        return $query;
    }

    public function saveData($data)
    {
        $query = $this->db->table('data_barang_keluar')
            ->join('data_user', 'data_user.id_user = data_barang_keluar.id_user')
            ->insert($data);

        return $query;
    }

    public function saveDetailData($data)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->insert($data);

        return $query;
    }

    public function updateData($data, $id)
    {
        $query = $this->db->table('data_barang_keluar')
            ->join('data_user', 'data_user.id_user = data_barang_keluar.id_user')
            ->update($data, array('id_keluar' => $id));

        return $query;
    }

    public function updateDetailData($data, $idKeluar, $idBarang)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->update($data, array('id_keluar' => $idKeluar, 'id_barang' => $idBarang));

        return $query;
    }

    public function filterTanggalKeluar($tglMulai, $tglSelesai)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->select('*')
            ->where('tgl_keluar >=', $tglMulai)->where('tgl_keluar <=', $tglSelesai)
            ->get()->getResultArray();

        return $query;
    }

    public function filterBarang($idBarang)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->select('*')
            ->where('detail_barang_keluar.id_barang', $idBarang)
            ->get()->getResultArray();

        return $query;
    }

    public function filterAll($tglMulai, $tglSelesai, $idBarang)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->select('*')
            ->where('tgl_keluar >=', $tglMulai)->where('tgl_keluar <=', $tglSelesai)
            ->where('detail_barang_keluar.id_barang', $idBarang)
            ->get()->getResultArray();

        return $query;
    }

    public function totalQTYKeluar($idKeluar)
    {
        $query = $this->db->table('data_barang_keluar')
            ->join('detail_barang_keluar', 'detail_barang_keluar.id_keluar = data_barang_keluar.id_keluar')
            ->select('SUM(qty_keluar) AS total_qty_keluar')
            ->where('data_barang_keluar.id_keluar =', $idKeluar)
            ->get()->getRow()->total_qty_keluar;

        return $query;
    }

    public function qty_keluar()
    {
        $query = $this->db->table('data_barang_keluar')
            ->get()->getNumRows();

        return $query;
    }

    public function grandTotalPerTanggal($tglMulai, $tglSelesai)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->selectSum('total_harga_keluar', 'grand_total')
            ->where('tgl_keluar >=', $tglMulai)->where('tgl_keluar <=', $tglSelesai)
            ->get()->getRow()->grand_total;

        return $query;
    }

    public function grandTotalPerBarang($idBarang)
    {
        $query = $this->db->table('detail_barang_keluar')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_keluar.id_barang')
            ->join('data_barang_keluar', 'data_barang_keluar.id_keluar = detail_barang_keluar.id_keluar', 'inner')
            ->selectSum('total_harga_keluar', 'grand_total')
            ->where('detail_barang_keluar.id_barang', $idBarang)
            ->get()->getRow()->grand_total;

        return $query;
    }

    public function grandTotalAllFilter($tglMulai, $tglSelesai, $idBarang)
    {
        $query = $this->db->table('detail_barang_masuk')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
            ->join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
            ->selectSum('total_harga_masuk', 'grand_total')
            ->where('tgl_masuk >=', $tglMulai)->where('tgl_masuk <=', $tglSelesai)
            ->where('detail_barang_masuk.id_barang', $idBarang)
            ->get()->getRow()->grand_total;

        return $query;
    }

    public function grandTotalAll()
    {
        $query = $this->db->table('detail_barang_masuk')
            ->join('data_stock', 'data_stock.id_barang = detail_barang_masuk.id_barang')
            ->join('data_barang_masuk', 'data_barang_masuk.id_masuk = detail_barang_masuk.id_masuk', 'inner')
            ->selectSum('total_harga_masuk', 'grand_total')
            ->get()->getRow()->grand_total;

        return $query;
    }
}
