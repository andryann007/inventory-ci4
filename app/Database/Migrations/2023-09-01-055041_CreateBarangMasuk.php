<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_masuk' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_user' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'id_supplier' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'tgl_masuk' => [
                'type'              => 'DATE',
            ],
            'no_faktur' => [
                'type'              => 'VARCHAR',
                'constraint'        => '16',
            ],
        ]);
        $this->forge->addPrimaryKey('id_masuk');
        $this->forge->addForeignKey('id_user', 'data_user', 'id_user');
        $this->forge->addForeignKey('id_supplier', 'data_supplier', 'id_supplier');
        $this->forge->addUniqueKey('no_faktur');
        $this->forge->createTable('data_barang_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('data_barang_masuk');
    }
}
