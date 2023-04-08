-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 06:40 PM
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
  `id_keluar` varchar(12) NOT NULL,
  `id_barang` varchar(12) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `qty_keluar` int(11) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang_keluar`
--

INSERT INTO `data_barang_keluar` (`id_keluar`, `id_barang`, `tgl_keluar`, `qty_keluar`, `harga_satuan`, `total_harga`, `keterangan`) VALUES
('OUT-03', 'S-02', '2023-04-06', 5, 15000, 75000, 'Penjualan'),
('ROUT-03', 'S-01', '2023-03-15', 100, 15000, 1500000, 'Beli Beras');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id_masuk` varchar(12) NOT NULL,
  `id_barang` varchar(12) NOT NULL,
  `id_supplier` varchar(12) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `qty_masuk` int(11) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`id_masuk`, `id_barang`, `id_supplier`, `tgl_masuk`, `qty_masuk`, `harga_satuan`, `total_harga`, `keterangan`) VALUES
('IN-02', 'S-01', 'SPY-01', '2023-03-12', 110, 12000, 1320000, 'Stock Beras'),
('IN-08', 'S-02', 'SPY-01', '2023-04-06', 26, 15000, 390000, 'Stock Beras Merah'),
('RIN-02', 'S-01', 'SPY-01', '2023-03-12', 10, 12000, 120000, 'Stock Beras');

-- --------------------------------------------------------

--
-- Table structure for table `data_retur_barang`
--

CREATE TABLE `data_retur_barang` (
  `id_retur` varchar(12) NOT NULL,
  `id_barang` varchar(12) NOT NULL,
  `id_supplier` varchar(12) NOT NULL,
  `tgl_retur` date NOT NULL,
  `qty_retur` int(11) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_retur_barang`
--

INSERT INTO `data_retur_barang` (`id_retur`, `id_barang`, `id_supplier`, `tgl_retur`, `qty_retur`, `harga_satuan`, `total_harga`, `keterangan`) VALUES
('RETUR-01', 'B-01', 'SPY-01', '2023-04-06', 5, 6500, 32500, 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `data_stock`
--

CREATE TABLE `data_stock` (
  `id_barang` varchar(12) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `qty_stock` int(11) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_stock`
--

INSERT INTO `data_stock` (`id_barang`, `nama_barang`, `kategori`, `qty_stock`, `harga_satuan`, `total_harga`, `status`) VALUES
('B-01', 'Royco Ayam & Sapi (12 Sachet)', 'Bumbu Dapur', 2, 6500, 78000, 'Tersedia'),
('B-02', 'Masako Ayam & Sapi (12 sachet)', 'Bumbu Dapur', 50, 5500, 275000, 'Tersedia'),
('B-03', 'Mamasuka Kentucky (210 gr)', 'Bumbu Dapur', 20, 5000, 100000, 'Tersedia'),
('B-04', 'Mamasuka Tepung Goreng Tempe 100gr', 'Bumbu Dapur', 20, 2000, 40000, 'Tersedia'),
('M-01', 'Aqua Air Mineral 1 Dus (600 ml)', 'Minuman', 10, 50000, 500000, 'Tersedia'),
('M-02', 'Le Minerale 600 ml (1 Dus)', 'Minuman', 10, 50000, 500000, 'Tersedia'),
('M-03', 'Coca Cola 390 ml (1 Dus)', 'Minuman', 10, 65000, 650000, 'Tersedia'),
('MI-01', 'Indomie Goreng 1 Dus (40 pcs)', 'Makanan Instan', 10, 125000, 1250000, 'Tersedia'),
('MI-02', 'Indomie Soto Ayam 1 Dus (40 pcs)', 'Makanan Instan', 10, 125000, 1250000, 'Tersedia'),
('MI-03', 'Indomie Kari Ayam 1 Dus (40 pcs)', 'Makanan Instan', 10, 125000, 1250000, 'Tersedia'),
('MI-04', 'Sedaap Mie Goreng 1 Dus (40 Pcs)', 'Sembako', 10, 122000, 1220000, 'Tersedia'),
('MI-05', 'Sedaap Mie Soto 1 Dus (40 Pcs)', 'Sembako', 10, 122000, 1220000, 'Tersedia'),
('MR-01', 'Better Sandwich Biscuit (20 pcs)', 'Makanan Ringan', 15, 18000, 270000, 'Tersedia'),
('MR-02', 'Beng Beng Wafer 1 Box (20 pcs)', 'Makanan Ringan', 20, 19000, 380000, 'Tersedia'),
('MR-03', 'Roma Malkist Original (125gr)', 'Makanan Ringan', 50, 8600, 430000, 'Tersedia'),
('MR-04', 'Oreo Original (133gr)', 'Makanan Ringan', 30, 8500, 255000, 'Tersedia'),
('MR-05', 'Choki Choki Original (20 pcs)', 'Makanan Ringan', 15, 20000, 300000, 'Tersedia'),
('PM-01', 'Sabun Dettol Original (100 gr)', 'Perlengkapan Mandi & Mencuci', 20, 5000, 100000, 'Tersedia'),
('S-01', 'Beras Putih 1 Kg', 'Sembako', 49, 12000, 588000, 'Tersedia'),
('S-02', 'Beras Merah 1 Kg', 'Sembako', 60, 15000, 750000, 'Tersedia'),
('S-03', 'Telur Ayam Negeri 1 Kg', 'Sembako', 50, 24000, 1200000, 'Tersedia'),
('S-04', 'Minyak Goreng Bimoli 1 Liter', 'Sembako', 20, 22000, 440000, 'Tersedia'),
('S-05', 'Kopi Kapal Api (165gr)', 'Sembako', 20, 15000, 300000, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `data_supplier`
--

CREATE TABLE `data_supplier` (
  `id_supplier` varchar(8) NOT NULL,
  `nama_supplier` varchar(150) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telp` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_supplier`
--

INSERT INTO `data_supplier` (`id_supplier`, `nama_supplier`, `alamat`, `email`, `telp`) VALUES
('SPY-01', 'PT. Sayap Mas Abadi', 'Jl. Pembangunan 1 no 5, Cikarang', '-', '-'),
('SPY-02', 'PT. Cipta Naga Semesta', 'Jl. Diponegoro km38, no 09, rt 02', '-', '-'),
('SPY-03', 'PT. Pinus Merah Abadi', 'Jl. Arief Rahman Hakim no 18', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` varchar(12) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tipe_akun` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_lengkap`, `email`, `password`, `telp`, `alamat`, `tipe_akun`) VALUES
('admin', 'Admin', 'admin@gmail.com', '12345678', '-', '-', 'Admin'),
('andryan', 'Andryan', 'andryan@gmail.com', '12345678', '0856xxxxxxxx8', 'Jln. Hidup Baru gg L no 65', 'Owner'),
('user', 'User', 'user@gmail.com', '12345678', '-', '-', 'User');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
