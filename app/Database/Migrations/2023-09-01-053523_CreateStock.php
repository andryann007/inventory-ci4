<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStock extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_barang' => [
                'type'              => 'VARCHAR',
                'constraint'        => '150',
            ],
            'kategori' => [
                'type'              => 'ENUM',
                'constraint'        => ['bumbu', 'makanan_instan', 'makanan_ringan', 'minuman', 'obat', 'perlengkapan_mandi', 'perlengkapan_rumah', 'sembako', 'lain_lain'],
                'default'           => 'sembako',
            ],
            'qty_stock' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'harga_satuan' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'total_harga' => [
                'type'              => 'DOUBLE',
                'unsigned'          => true,
            ],
            'status' => [
                'type'              => 'ENUM',
                'constraint'        => ['tersedia', 'habis'],
                'default'           => 'tersedia',
            ],
        ]);
        $this->forge->addPrimaryKey('id_barang');
        $this->forge->createTable('data_stock');
    }

    public function down()
    {
        $this->forge->dropTable('data_stock');
    }
}
