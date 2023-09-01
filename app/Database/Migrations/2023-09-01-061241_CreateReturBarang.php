<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReturBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_retur' => [
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
            'tgl_retur' => [
                'type'              => 'DATE',
            ],
            'no_faktur' => [
                'type'              => 'VARCHAR',
                'constraint'        => '16',
            ],
        ]);
        $this->forge->addPrimaryKey('id_retur');
        $this->forge->addForeignKey('id_user', 'data_user', 'id_user');
        $this->forge->addForeignKey('id_supplier', 'data_supplier', 'id_supplier');
        $this->forge->addUniqueKey('no_faktur');
        $this->forge->createTable('data_retur_barang');
    }

    public function down()
    {
        $this->forge->dropTable('data_retur_barang');
    }
}
