<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_supplier' => 'PT. Sayap Mas Abadi',
                'alamat'        => 'Jl. Pembangunan 1 no 6, Cikarang',
                'email'         => 'sayapmas@abadi.com',
                'telp'          => '0812xxxx2123'
            ],
            [
                'nama_supplier' => 'PT. Cipta Naga Semesta',
                'alamat'        => 'Jl. Diponegoro km38, no 09, Cikarang',
                'email'         => 'ciptanaga@semesta.com',
                'telp'          => '0821xxxx2231'
            ],
            [
                'nama_supplier' => 'PT. Pinus Merah Abadi',
                'alamat'        => 'Jl. Arief Rahman Hakim no 18, Cikarang',
                'email'         => 'pinusmerah@abadi.com',
                'telp'          => '0812xxxx2321'
            ],
        ];

        $this->db->table('data_supplier')->insertBatch($data);
    }
}
