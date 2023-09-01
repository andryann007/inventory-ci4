<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupplier extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_supplier' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_supplier' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'alamat' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'telp' => [
                'type'              => 'VARCHAR',
                'constraint'        => '16',
            ],
        ]);
        $this->forge->addPrimaryKey('id_supplier');
        $this->forge->createTable('data_supplier');
    }

    public function down()
    {
        $this->forge->dropTable('data_supplier');
    }
}
