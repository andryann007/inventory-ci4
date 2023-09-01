<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keluar' => [
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
            'tgl_keluar' => [
                'type'              => 'DATE',
            ],
            'no_faktur' => [
                'type'              => 'VARCHAR',
                'constraint'        => '16',
            ],
        ]);
        $this->forge->addPrimaryKey('id_keluar');
        $this->forge->addForeignKey('id_user', 'data_user', 'id_user');
        $this->forge->addUniqueKey('no_faktur');
        $this->forge->createTable('data_barang_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('data_barang_keluar');
    }
}
