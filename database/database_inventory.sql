-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 02:21 PM
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
(7, 3, '2023-04-05', 10, 10000, 100000, '-');

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
(2, 1, 1, '2023-04-11', 5, 12000, 60000, '-'),
(3, 19, 1, '2023-03-12', 110, 12000, 1320000, 'Stock Beras'),
(4, 20, 1, '2023-04-06', 20, 15000, 300000, 'Stock Beras Merah'),
(5, 19, 1, '2023-03-12', 10, 12000, 120000, 'Stock Beras');

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
(3, 3, 3, '2023-04-12', 5, 10000, 50000, 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `data_stock`
--

CREATE TABLE `data_stock` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `qty_stock` int(11) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_stock`
--

INSERT INTO `data_stock` (`id_barang`, `nama_barang`, `kategori`, `qty_stock`, `harga_satuan`, `total_harga`, `status`) VALUES
(1, 'Royco Ayam & Sapi (12 Sachet)', 'Bumbu Dapur', 0, 6500, 97500, 'Habis'),
(2, 'Masako Ayam & Sapi (12 sachet)', 'Bumbu Dapur', 0, 5500, 247500, 'Habis'),
(3, 'Mamasuka Kentucky (210 gr)', 'Bumbu Dapur', 5, 5000, 25000, 'Tersedia'),
(4, 'Mamasuka Tepung Goreng Tempe 100gr', 'Bumbu Dapur', 20, 2000, 40000, 'Tersedia'),
(5, 'Aqua Air Mineral 1 Dus (600 ml)', 'Minuman', 10, 50000, 500000, 'Tersedia'),
(6, 'Le Minerale 600 ml (1 Dus)', 'Minuman', 10, 50000, 500000, 'Tersedia'),
(7, 'Coca Cola 390 ml (1 Dus)', 'Minuman', 10, 65000, 650000, 'Tersedia'),
(8, 'Indomie Goreng 1 Dus (40 pcs)', 'Makanan Instan', 10, 125000, 1250000, 'Tersedia'),
(9, 'Indomie Soto Ayam 1 Dus (40 pcs)', 'Makanan Instan', 10, 125000, 1250000, 'Tersedia'),
(10, 'Indomie Kari Ayam 1 Dus (40 pcs)', 'Makanan Instan', 10, 125000, 1250000, 'Tersedia'),
(11, 'Sedaap Mie Goreng 1 Dus (40 Pcs)', 'Sembako', 15, 122000, 1830000, 'Tersedia'),
(12, 'Sedaap Mie Soto 1 Dus (40 Pcs)', 'Sembako', 10, 122000, 1220000, 'Tersedia'),
(13, 'Better Sandwich Biscuit (20 pcs)', 'Makanan Ringan', 15, 18000, 270000, 'Tersedia'),
(14, 'Beng Beng Wafer 1 Box (20 pcs)', 'Makanan Ringan', 20, 19000, 380000, 'Tersedia'),
(15, 'Roma Malkist Original (125gr)', 'Makanan Ringan', 50, 8600, 430000, 'Tersedia'),
(16, 'Oreo Original (133gr)', 'Makanan Ringan', 30, 8500, 255000, 'Tersedia'),
(17, 'Choki Choki Original (20 pcs)', 'Makanan Ringan', 15, 20000, 300000, 'Tersedia'),
(18, 'Sabun Dettol Original (100 gr)', 'Perlengkapan Mandi & Mencuci', 20, 5000, 100000, 'Tersedia'),
(19, 'Beras Putih 1 Kg', 'Sembako', 49, 12000, 588000, 'Tersedia'),
(20, 'Beras Merah 1 Kg', 'Sembako', 56, 15000, 840000, 'Tersedia'),
(21, 'Telur Ayam Negeri 1 Kg', 'Sembako', 50, 24000, 1200000, 'Tersedia'),
(22, 'Minyak Goreng Bimoli 1 Liter', 'Sembako', 20, 22000, 440000, 'Tersedia'),
(23, 'Kopi Kapal Api (165gr)', 'Sembako', 20, 15000, 300000, 'Tersedia'),
(25, 'Choki Choki', 'Makanan Ringan', 10, 1000, 10000, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `data_supplier`
--

CREATE TABLE `data_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(150) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_supplier`
--

INSERT INTO `data_supplier` (`id_supplier`, `nama_supplier`, `alamat`, `email`, `telp`) VALUES
(1, 'PT. Sayap Mas Abadi', 'Jl. Pembangunan 1 no 5, Cikarang', '-', '-'),
(2, 'PT. Cipta Naga Semesta', 'Jl. Diponegoro km38, no 09, rt 02', '-', '-'),
(3, 'PT. Pinus Merah Abadi', 'Jl. Arief Rahman Hakim no 18', '-', '-'),
(4, 'PT. Abdi Cipta', 'Jln. Yos Sudarso no 15', '', '-');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tipe_akun` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_lengkap`, `email`, `username`, `password`, `telp`, `alamat`, `tipe_akun`) VALUES
(1, 'Andryan', 's31190080@student.ubm.ac.id', 'andryan', '12345678', '085675xxxx8', 'Jln Hidup Baru gg L no 65', 'Owner'),
(2, 'Admin', 'admin@gmail.com', 'admin', '12345678', '-', '', 'Admin'),
(3, 'User', 'user@gmail.com', 'user', '12345678', '-', '', 'User');

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
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_retur_barang`
--
ALTER TABLE `data_retur_barang`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_stock`
--
ALTER TABLE `data_stock`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_supplier`
--
ALTER TABLE `data_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
