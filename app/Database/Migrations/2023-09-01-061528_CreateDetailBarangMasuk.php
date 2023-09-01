<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailBarangMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_masuk' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'id_barang' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'qty_masuk' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'harga_satuan_masuk' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'total_harga_masuk' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'keterangan' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
                'null'              => true
            ],
        ]);

        $this->forge->addForeignKey('id_masuk', 'data_barang_masuk', 'id_masuk');
        $this->forge->addForeignKey('id_barang', 'data_stock', 'id_barang');
        $this->forge->createTable('detail_barang_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('detail_barang_masuk');
    }
}
