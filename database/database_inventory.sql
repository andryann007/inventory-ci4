-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2023 at 10:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_keluar`
--

CREATE TABLE `data_barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `qty_keluar` int(11) NOT NULL,
  `harga_satuan_keluar` double NOT NULL,
  `total_harga_keluar` double NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang_keluar`
--

INSERT INTO `data_barang_keluar` (`id_keluar`, `id_barang`, `tgl_keluar`, `qty_keluar`, `harga_satuan_keluar`, `total_harga_keluar`, `keterangan`) VALUES
(1, 20, '2023-04-06', 3, 12000, 36000, 'Penjualan'),
(2, 19, '2023-03-15', 100, 15000, 1500000, 'Beli Beras'),
(3, 11, '2023-04-15', 3, 100000, 300000, 'Kadaluarsa'),
(4, 1, '2023-04-15', 15, 7000, 105000, 'Penjualan'),
(5, 1, '2023-04-12', 15, 7000, 105000, '-'),
(6, 2, '2023-04-01', 10, 5000, 50000, '-'),
(7, 3, '2023-04-05', 10, 10000, 100000, '-'),
(8, 1, '2023-05-23', 3, 10000, 30000, '-'),
(9, 3, '2023-08-03', 1, 5000, 5000, '-'),
(10, 3, '2023-08-03', 1, 5000, 5000, '-'),
(11, 3, '2023-08-03', 1, 5000, 5000, '-'),
(12, 4, '2023-08-03', 2, 2500, 5000, '-'),
(13, 3, '2023-08-03', 4, 5000, 20000, '-'),
(14, 4, '2023-08-03', 5, 2500, 12500, '-'),
(15, 3, '2023-08-03', 10, 5000, 50000, '-'),
(16, 1, '2023-08-02', 1, 10000, 10000, '-'),
(17, 3, '2023-08-03', 10, 4500, 45000, '-'),
(18, 1, '2023-08-03', 10, 10000, 100000, '-'),
(19, 5, '2023-08-03', 2, 24000, 48000, '-'),
(20, 5, '2023-08-03', 10, 25000, 250000, '-'),
(21, 3, '2023-08-03', 10, 5000, 50000, '-'),
(22, 1, '2023-08-03', 10, 12000, 120000, '-'),
(23, 1, '2023-08-03', 6, 2000, 12000, 'a'),
(24, 1, '2023-08-03', 6, 2500, 15000, '-'),
(25, 1, '2023-08-03', 6, 6000, 36000, '-'),
(26, 1, '2023-08-03', 1, 5000, 5000, '-'),
(27, 3, '2023-08-03', 5, 5000, 25000, '-'),
(28, 1, '2023-08-03', 5, 2000, 10000, '-'),
(29, 7, '2023-08-03', 10, 30000, 300000, '-'),
(30, 1, '2023-08-03', 1, 2000, 2000, '-'),
(31, 5, '2023-08-03', 2, 24000, 48000, '-'),
(32, 3, '2023-08-03', 2, 2500, 5000, '2'),
(33, 4, '2023-08-03', 2, 5000, 10000, '1'),
(34, 5, '2023-08-03', 1, 24000, 24000, '-'),
(35, 5, '2023-08-03', 1, 20000, 20000, '-'),
(36, 7, '2023-08-03', 5, 60000, 300000, '-'),
(37, 6, '2023-08-03', 5, 24000, 120000, '-'),
(38, 6, '2023-08-03', 1, 24000, 24000, '-'),
(39, 5, '2023-08-03', 1, 24000, 24000, '-'),
(40, 6, '2023-08-03', 1, 24000, 24000, '-'),
(41, 5, '2023-08-03', 1, 24000, 24000, '-'),
(42, 6, '2023-08-03', 1, 24000, 24000, '-'),
(43, 7, '2023-08-03', 1, 24000, 24000, '-'),
(44, 5, '2023-08-03', 1, 24000, 24000, '-'),
(45, 7, '2023-08-03', 1, 20000, 20000, '-'),
(46, 5, '2023-08-03', 1, 24000, 24000, '-'),
(47, 7, '2023-08-03', 1, 60000, 60000, '-'),
(48, 5, '2023-08-03', 1, 24000, 24000, '-'),
(49, 7, '2023-08-03', 1, 60000, 60000, '-'),
(50, 1, '2023-08-04', 1, 2500, 2500, '-'),
(51, 1, '2023-08-04', 1, 2500, 2500, '-'),
(52, 5, '2023-08-04', 1, 24000, 24000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `qty_masuk` int(11) NOT NULL,
  `harga_satuan_masuk` double NOT NULL,
  `total_harga_masuk` double NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`id_masuk`, `id_barang`, `id_supplier`, `tgl_masuk`, `qty_masuk`, `harga_satuan_masuk`, `total_harga_masuk`, `keterangan`) VALUES
(2, 1, 1, '2023-04-11', 3, 12000, 36000, '-'),
(3, 19, 1, '2023-03-12', 110, 12000, 1320000, 'Stock Beras'),
(4, 20, 1, '2023-04-06', 20, 15000, 300000, 'Stock Beras Merah'),
(5, 19, 1, '2023-03-12', 10, 12000, 120000, 'Stock Beras'),
(6, 1, 1, '2023-05-23', 5, 12000, 60000, 'Stock Micin'),
(7, 1, 1, '2023-08-03', 10, 12000, 120000, '-'),
(8, 5, 2, '2023-08-03', 5, 24000, 120000, '-'),
(9, 1, 1, '2023-08-03', 10, 12000, 120000, '-'),
(10, 6, 3, '2023-08-03', 5, 24000, 120000, '-'),
(11, 1, 1, '2023-08-04', 2, 2500, 5000, '-'),
(12, 1, 1, '2023-08-04', 12, 2500, 30000, '-'),
(13, 1, 1, '2023-08-04', 2, 2500, 5000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `data_retur_barang`
--

CREATE TABLE `data_retur_barang` (
  `id_retur` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl_retur` date NOT NULL,
  `qty_retur` int(11) NOT NULL,
  `harga_satuan_retur` double NOT NULL,
  `total_harga_retur` double NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_retur_barang`
--

INSERT INTO `data_retur_barang` (`id_retur`, `id_barang`, `id_supplier`, `tgl_retur`, `qty_retur`, `harga_satuan_retur`, `total_harga_retur`, `keterangan`) VALUES
(1, 1, 1, '2023-04-06', 10, 6500, 65000, 'Expired'),
(2, 2, 3, '2023-03-01', 5, 6500, 32500, 'Salah Beli'),
(3, 3, 3, '2023-04-12', 5, 10000, 50000, 'Expired'),
(4, 1, 1, '2023-04-06', 1, 6500, 6500, 'Expired'),
(5, 1, 1, '2023-08-03', 1, 5000, 5000, 'Expired'),
(6, 5, 2, '2023-08-03', 1, 24000, 24000, 'SalahMerek');

-- --------------------------------------------------------

--
-- Table structure for table `data_stock`
--

CREATE TABLE `data_stock` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `kategori` enum('bumbu','makanan_instan','makanan_ringan','minuman','obat','perlengkapan_mandi','perlengkapan_rumah','sembako','lain_lain') NOT NULL,
  `qty_stock` int(11) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `status` enum('tersedia','habis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_stock`
--

INSERT INTO `data_stock` (`id_barang`, `nama_barang`, `kategori`, `qty_stock`, `harga_satuan`, `total_harga`, `status`) VALUES
(1, 'Royco Ayam & Sapi (12 Sachet)', 'bumbu', 31, 6500, 201500, 'tersedia'),
(2, 'Masako Ayam & Sapi (12 sachet)', 'bumbu', 10, 5500, 55000, 'habis'),
(3, 'Mamasuka Kentucky (210 gr)', 'bumbu', 5, 5000, 25000, 'tersedia'),
(4, 'Mamasuka Tepung Goreng Tempe 100gr', 'bumbu', 20, 2000, 40000, 'tersedia'),
(5, 'Aqua Air Mineral 1 Dus (600 ml)', 'minuman', 10, 50000, 500000, 'tersedia'),
(6, 'Le Minerale 600 ml (1 Dus)', 'minuman', 7, 50000, 350000, 'tersedia'),
(7, 'Coca Cola 390 ml (1 Dus)', 'minuman', 1, 65000, 65000, 'tersedia'),
(8, 'Indomie Goreng 1 Dus (40 pcs)', 'makanan_instan', 10, 125000, 1250000, 'tersedia'),
(9, 'Indomie Soto Ayam 1 Dus (40 pcs)', 'makanan_instan', 10, 125000, 1250000, 'tersedia'),
(10, 'Indomie Kari Ayam 1 Dus (40 pcs)', 'makanan_instan', 10, 125000, 1250000, 'tersedia'),
(11, 'Sedaap Mie Goreng 1 Dus (40 Pcs)', 'sembako', 15, 122000, 1830000, 'tersedia'),
(12, 'Sedaap Mie Soto 1 Dus (40 Pcs)', 'sembako', 10, 122000, 1220000, 'tersedia'),
(13, 'Better Sandwich Biscuit (20 pcs)', 'makanan_ringan', 15, 18000, 270000, 'tersedia'),
(14, 'Beng Beng Wafer 1 Box (20 pcs)', 'makanan_ringan', 20, 19000, 380000, 'tersedia'),
(15, 'Roma Malkist Original (125gr)', 'makanan_ringan', 50, 8600, 430000, 'tersedia'),
(16, 'Oreo Original (133gr)', 'makanan_ringan', 30, 8500, 255000, 'tersedia'),
(17, 'Choki Choki Original (20 pcs)', 'makanan_ringan', 15, 20000, 300000, 'tersedia'),
(18, 'Sabun Dettol Original (100 gr)', 'perlengkapan_mandi', 20, 5000, 100000, 'tersedia'),
(19, 'Beras Putih 1 Kg', 'sembako', 49, 12000, 588000, 'tersedia'),
(20, 'Beras Merah 1 Kg', 'sembako', 56, 15000, 840000, 'tersedia'),
(21, 'Telur Ayam Negeri 1 Kg', 'sembako', 50, 24000, 1200000, 'tersedia'),
(22, 'Minyak Goreng Bimoli 1 Liter', 'sembako', 20, 22000, 440000, 'tersedia'),
(23, 'Kopi Kapal Api (165gr)', 'sembako', 20, 15000, 300000, 'tersedia'),
(25, 'Choki Choki', 'makanan_ringan', 10, 1000, 10000, 'tersedia'),
(26, 'Indomie Bulgogi', 'makanan_instan', 20, 3500, 70000, 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `data_supplier`
--

CREATE TABLE `data_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_supplier`
--

INSERT INTO `data_supplier` (`id_supplier`, `nama_supplier`, `alamat`, `email`, `telp`) VALUES
(1, 'PT. Sayap Mas Abadi', 'Jl. Pembangunan 1 no 6, Cikarang', '', '-'),
(2, 'PT. Cipta Naga Semesta', 'Jl. Diponegoro km38, no 09, rt 02', '-', '-'),
(3, 'PT. Pinus Merah Abadi', 'Jl. Arief Rahman Hakim no 18', '-', '-'),
(4, 'PT. Abdi Cipta', 'Jln. Yos Sudarso no 15', '', '-'),
(5, 'PT. Semesta Abadi', 'Jl. Pembangunan 2 no 6, Cikarang Utara', '', '-');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tipe_akun` enum('owner','admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_lengkap`, `email`, `username`, `password`, `telp`, `alamat`, `tipe_akun`) VALUES
(1, 'Andryan', 's31190080@student.ubm.ac.id', 'andryan', '12345678', '085675xxxx8', 'Jln Hidup Baru gg L no 65', 'owner'),
(2, 'Admin', 'admin@gmail.com', 'admin', '12345678', '-', 'Jln. H', 'admin'),
(3, 'User', 'user@gmail.com', 'user', '12345678', '-', '', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `data_retur_barang`
--
ALTER TABLE `data_retur_barang`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `data_stock`
--
ALTER TABLE `data_stock`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `data_supplier`
--
ALTER TABLE `data_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `data_retur_barang`
--
ALTER TABLE `data_retur_barang`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_stock`
--
ALTER TABLE `data_stock`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `data_supplier`
--
ALTER TABLE `data_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
