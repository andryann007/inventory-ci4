<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailReturBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_retur' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'id_barang' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'qty_retur' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'harga_satuan_retur' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'total_harga_retur' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'keterangan' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => true
            ],
        ]);
        $this->forge->addForeignKey('id_retur', 'data_retur_barang', 'id_retur');
        $this->forge->addForeignKey('id_barang', 'data_stock', 'id_barang');
        $this->forge->createTable('detail_retur_barang');
    }

    public function down()
    {
        $this->forge->dropTable('detail_retur_barang');
    }
}
