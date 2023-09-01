<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_lengkap' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'username' => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'password' => [
                'type'              => 'VARCHAR',
                'constraint'        => '12',
            ],
            'telp' => [
                'type'              => 'VARCHAR',
                'constraint'        => '16',
            ],
            'alamat' => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
            ],
            'tipe_akun' => [
                'type'              => 'ENUM',
                'constraint'        => ['owner', 'admin', 'user'],
                'default'           => 'admin',
            ],
            'reset_token' => [
                'type'              => 'VARCHAR',
                'constraint'        => '12',
                'null'              => true
            ],
        ]);
        $this->forge->addPrimaryKey('id_user');
        $this->forge->createTable('data_user');
    }

    public function down()
    {
        $this->forge->dropTable('data_user');
    }
}
