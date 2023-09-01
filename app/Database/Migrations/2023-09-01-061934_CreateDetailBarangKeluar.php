<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailBarangKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keluar' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'id_barang' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'qty_keluar' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'harga_satuan_keluar' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'total_harga_keluar' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'keterangan' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => true
            ],
        ]);
        $this->forge->addForeignKey('id_keluar', 'data_barang_keluar', 'id_keluar');
        $this->forge->addForeignKey('id_barang', 'data_stock', 'id_barang');
        $this->forge->createTable('detail_barang_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('detail_barang_keluar');
    }
}
