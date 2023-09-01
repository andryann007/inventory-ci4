<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_lengkap'  => 'Andryan',
                'email'         => 'andryanace@gmail.com',
                'username'      => 'andryan007',
                'password'      => '12345678',
                'telp'          => '0856xxxx148',
                'alamat'        => 'Jln Hidup Baru gg L no 65',
                'tipe_akun'     => 'owner',
                'reset_token'   => ''
            ],
            [
                'nama_lengkap'  => 'Admin Website',
                'email'         => 'admin@gmail.com',
                'username'      => 'admin',
                'password'      => '12345678',
                'telp'          => '0856xxxx148',
                'alamat'        => 'Jln Jati Waringin gg Keramat no 15',
                'tipe_akun'     => 'admin',
                'reset_token'   => ''
            ],
            [
                'nama_lengkap'  => 'User Website',
                'email'         => 'user@gmail.com',
                'username'      => 'user',
                'password'      => '12345678',
                'telp'          => '0856xxxx148',
                'alamat'        => 'Jln Padjajaran Tenggara no 21',
                'tipe_akun'     => 'user',
                'reset_token'   => ''
            ],
        ];

        $this->db->table('data_user')->insertBatch($data);
    }
}
