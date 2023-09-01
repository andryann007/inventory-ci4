<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_barang'   => 'Royco Ayam & Sapi (12 sachet)',
                'kategori'      => 'bumbu',
                'qty_stock'     => 20,
                'harga_satuan'  => 10000,
                'total_harga'   => 200000,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Masako Ayam & Sapi (12 sachet)',
                'kategori'      => 'bumbu',
                'qty_stock'     => 25,
                'harga_satuan'  => 8500,
                'total_harga'   => 212500,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Aqua Air Mineral 600 ml 1 Dus (12 pcs)',
                'kategori'      => 'minuman',
                'qty_stock'     => 15,
                'harga_satuan'  => 24000,
                'total_harga'   => 360000,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Le Minerale 600 ml 1 Dus (12 pcs)',
                'kategori'      => 'minuman',
                'qty_stock'     => 20,
                'harga_satuan'  => 22000,
                'total_harga'   => 440000,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Indomie Goreng 1 Dus (40 pcs)',
                'kategori'      => 'makanan_instan',
                'qty_stock'     => 10,
                'harga_satuan'  => 120000,
                'total_harga'   => 1200000,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Sedaap Mie Goreng 1 Dus (40 Pcs)',
                'kategori'      => 'makanan_instan',
                'qty_stock'     => 5,
                'harga_satuan'  => 115000,
                'total_harga'   => 575000,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Better Sandwich Biscuit (20 pcs)',
                'kategori'      => 'makanan_ringan',
                'qty_stock'     => 15,
                'harga_satuan'  => 90000,
                'total_harga'   => 1350000,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Beng Beng Wafer 1 Box (20 pcs)',
                'kategori'      => 'makanan_ringan',
                'qty_stock'     => 10,
                'harga_satuan'  => 50000,
                'total_harga'   => 500000,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Kopi Kapal Api (165gr)',
                'kategori'      => 'sembako',
                'qty_stock'     => 25,
                'harga_satuan'  => 12500,
                'total_harga'   => 312500,
                'status'        => 'tersedia'
            ],
            [
                'nama_barang'   => 'Minyak Goreng Bimoli (2 liter)',
                'kategori'      => 'sembako',
                'qty_stock'     => 15,
                'harga_satuan'  => 26000,
                'total_harga'   => 390000,
                'status'        => 'tersedia'
            ],
        ];

        $this->db->table('data_stock')->insertBatch($data);
    }
}
