-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 10:12 AM
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
  `id_user` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `no_faktur` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang_keluar`
--

INSERT INTO `data_barang_keluar` (`id_keluar`, `id_user`, `tgl_keluar`, `no_faktur`) VALUES
(1, 1, '2023-08-07', 'IDK_00001'),
(2, 1, '2023-08-07', 'IDK_00002'),
(3, 1, '2023-08-07', 'IDK_00003'),
(4, 1, '2023-08-07', 'IDK_00004'),
(5, 1, '2023-08-07', 'IDK_00005');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_faktur` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`id_masuk`, `id_user`, `id_supplier`, `tgl_masuk`, `no_faktur`) VALUES
(1, 1, 1, '2023-08-08', 'IDM_00001'),
(2, 2, 2, '2023-08-08', 'IDM_00002');

-- --------------------------------------------------------

--
-- Table structure for table `data_retur_barang`
--

CREATE TABLE `data_retur_barang` (
  `id_retur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl_retur` date NOT NULL,
  `no_faktur` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_retur_barang`
--

INSERT INTO `data_retur_barang` (`id_retur`, `id_user`, `id_supplier`, `tgl_retur`, `no_faktur`) VALUES
(1, 1, 1, '2023-08-08', 'IDR_00001');

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
(1, 'Royco Ayam & Sapi (12 Sachet)', 'bumbu', 22, 6500, 143000, 'tersedia'),
(2, 'Masako Ayam & Sapi (12 sachet)', 'bumbu', 10, 5500, 55000, 'tersedia'),
(3, 'Mamasuka Kentucky (210 gr)', 'bumbu', 15, 5000, 75000, 'tersedia'),
(4, 'Mamasuka Tepung Goreng Tempe 100gr', 'bumbu', 15, 2000, 30000, 'tersedia'),
(5, 'Aqua Air Mineral 1 Dus (600 ml)', 'minuman', 15, 50000, 750000, 'tersedia'),
(6, 'Le Minerale 600 ml (1 Dus)', 'minuman', 18, 50000, 900000, 'tersedia'),
(7, 'Coca Cola 390 ml (1 Dus)', 'minuman', 11, 65000, 715000, 'tersedia'),
(8, 'Indomie Goreng 1 Dus (40 pcs)', 'makanan_instan', 19, 125000, 2375000, 'tersedia'),
(9, 'Indomie Soto Ayam 1 Dus (40 pcs)', 'makanan_instan', 19, 125000, 2375000, 'tersedia'),
(10, 'Indomie Kari Ayam 1 Dus (40 pcs)', 'makanan_instan', 19, 125000, 2375000, 'tersedia'),
(11, 'Sedaap Mie Goreng 1 Dus (40 Pcs)', 'sembako', 14, 122000, 1708000, 'tersedia'),
(12, 'Sedaap Mie Soto 1 Dus (40 Pcs)', 'sembako', 10, 122000, 1220000, 'tersedia'),
(13, 'Better Sandwich Biscuit (20 pcs)', 'makanan_ringan', 14, 18000, 252000, 'tersedia'),
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
  `tipe_akun` enum('owner','admin','user') NOT NULL,
  `reset_token` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_lengkap`, `email`, `username`, `password`, `telp`, `alamat`, `tipe_akun`, `reset_token`) VALUES
(1, 'Andryan', 's31190080@student.ubm.ac.id', 'andryan', '12345678', '085675xxxx8', 'Jln Hidup Baru gg L no 65', 'owner', 'OTdEiFWvqdzo'),
(2, 'Admin', 'admin@gmail.com', 'admin', '12345678', '-', 'Jln. H', 'admin', ''),
(3, 'User', 'user@gmail.com', 'user', '12345678', '-', '', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang_keluar`
--

CREATE TABLE `detail_barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_keluar` int(11) NOT NULL,
  `harga_satuan_keluar` double NOT NULL,
  `total_harga_keluar` double NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barang_keluar`
--

INSERT INTO `detail_barang_keluar` (`id_keluar`, `id_barang`, `qty_keluar`, `harga_satuan_keluar`, `total_harga_keluar`, `keterangan`) VALUES
(1, 5, 1, 24000, 24000, '-'),
(1, 14, 1, 50000, 50000, '-'),
(1, 1, 2, 2500, 5000, '-'),
(1, 4, 2, 6000, 12000, '-'),
(1, 8, 1, 20000, 20000, '-'),
(1, 1, 5, 2500, 12500, '-'),
(2, 1, 2, 2500, 5000, '-'),
(2, 13, 1, 60000, 60000, '-'),
(3, 1, 2, 2000, 4000, '-'),
(3, 11, 1, 20000, 20000, '-'),
(3, 5, 1, 20000, 20000, '-'),
(1, 1, 2, 12000, 24000, '-'),
(4, 1, 2, 2000, 4000, '-'),
(4, 2, 1, 10000, 10000, '-'),
(4, 1, 2, 12000, 24000, '-'),
(4, 1, 2, 2000, 4000, '-'),
(4, 1, 2, 2000, 4000, '-'),
(4, 4, 2, 5000, 10000, '-'),
(5, 4, 2, 2500, 5000, '-'),
(5, 9, 1, 50000, 50000, '-'),
(5, 10, 2, 45000, 90000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang_masuk`
--

CREATE TABLE `detail_barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_masuk` int(11) NOT NULL,
  `harga_satuan_masuk` double NOT NULL,
  `total_harga_masuk` double NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barang_masuk`
--

INSERT INTO `detail_barang_masuk` (`id_masuk`, `id_barang`, `qty_masuk`, `harga_satuan_masuk`, `total_harga_masuk`, `keterangan`) VALUES
(1, 1, 12, 12000, 144000, '-'),
(1, 5, 1, 55000, 55000, '-'),
(1, 7, 10, 50000, 500000, '-'),
(1, 6, 1, 45000, 45000, '-'),
(2, 1, 2, 12000, 24000, '-'),
(2, 8, 1, 100000, 100000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_barang`
--

CREATE TABLE `detail_retur_barang` (
  `id_retur` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_retur` int(11) NOT NULL,
  `harga_satuan_retur` double NOT NULL,
  `total_harga_retur` double NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_retur_barang`
--

INSERT INTO `detail_retur_barang` (`id_retur`, `id_barang`, `qty_retur`, `harga_satuan_retur`, `total_harga_retur`, `keterangan`) VALUES
(1, 1, 2, 2000, 4000, 'Expired');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD UNIQUE KEY `UNIQUE_FAKTUR_KELUAR` (`no_faktur`) USING BTREE,
  ADD KEY `FK_BARANG_KELUAR` (`id_user`) USING BTREE;

--
-- Indexes for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD UNIQUE KEY `UNIQUE_FAKTUR_MASUK` (`no_faktur`) USING BTREE,
  ADD KEY `FK1_BARANG_MASUK` (`id_user`) USING BTREE,
  ADD KEY `FK2_BARANG_MASUK` (`id_supplier`);

--
-- Indexes for table `data_retur_barang`
--
ALTER TABLE `data_retur_barang`
  ADD PRIMARY KEY (`id_retur`),
  ADD UNIQUE KEY `UNIQUE_FAKTUR_RETUR` (`no_faktur`) USING BTREE,
  ADD KEY `FK1_RETUR_BARANG` (`id_user`),
  ADD KEY `FK2_RETUR_BARANG` (`id_supplier`);

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
-- Indexes for table `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  ADD KEY `FK1_DETAIL_KELUAR` (`id_keluar`) USING BTREE,
  ADD KEY `FK2_DETAIL_KELUAR` (`id_barang`) USING BTREE;

--
-- Indexes for table `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  ADD KEY `FK1_DETAIL_MASUK` (`id_masuk`),
  ADD KEY `FK2_DETAIL_MASUK` (`id_barang`);

--
-- Indexes for table `detail_retur_barang`
--
ALTER TABLE `detail_retur_barang`
  ADD KEY `FK1_DETAIL_RETUR` (`id_retur`),
  ADD KEY `FK2_DETAIL_RETUR` (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_retur_barang`
--
ALTER TABLE `data_retur_barang`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  ADD CONSTRAINT `FK` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`);

--
-- Constraints for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD CONSTRAINT `FK1_MASUK` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`),
  ADD CONSTRAINT `FK2_BARANG_MASUK` FOREIGN KEY (`id_supplier`) REFERENCES `data_supplier` (`id_supplier`);

--
-- Constraints for table `data_retur_barang`
--
ALTER TABLE `data_retur_barang`
  ADD CONSTRAINT `FK1_RETUR_BARANG` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`),
  ADD CONSTRAINT `FK2_RETUR_BARANG` FOREIGN KEY (`id_supplier`) REFERENCES `data_supplier` (`id_supplier`);

--
-- Constraints for table `detail_barang_keluar`
--
ALTER TABLE `detail_barang_keluar`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`id_keluar`) REFERENCES `data_barang_keluar` (`id_keluar`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`id_barang`) REFERENCES `data_stock` (`id_barang`);

--
-- Constraints for table `detail_barang_masuk`
--
ALTER TABLE `detail_barang_masuk`
  ADD CONSTRAINT `FK1_DETAIL_MASUK` FOREIGN KEY (`id_masuk`) REFERENCES `data_barang_masuk` (`id_masuk`),
  ADD CONSTRAINT `FK2_DETAIL_MASUK` FOREIGN KEY (`id_barang`) REFERENCES `data_stock` (`id_barang`);

--
-- Constraints for table `detail_retur_barang`
--
ALTER TABLE `detail_retur_barang`
  ADD CONSTRAINT `FK1_DETAIL_RETUR` FOREIGN KEY (`id_retur`) REFERENCES `data_retur_barang` (`id_retur`),
  ADD CONSTRAINT `FK2_DETAIL_RETUR` FOREIGN KEY (`id_barang`) REFERENCES `data_stock` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
