-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2026 at 12:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'B001', 'Beras Premium 5kg', 65000, 50, 1),
(2, 'B002', 'Minyak Goreng 2L', 34000, 40, 2),
(3, 'B003', 'Gula Pasir 1kg', 15000, 60, 3),
(4, 'B004', 'Tepung Terigu 1kg', 12000, 45, 4),
(5, 'B005', 'Teh Celup 25 kantong', 8500, 80, 5),
(6, 'B006', 'Kopi Bubuk 250g', 28000, 35, 6),
(7, 'B007', 'Susu UHT 1L', 19000, 55, 7),
(8, 'B008', 'Mie Instan 1 Dus', 110000, 25, 8),
(9, 'B009', 'Air Mineral 600ml', 3500, 120, 9),
(10, 'B010', 'Sabun Cuci 800g', 23000, 30, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Budi Santoso', 'L', '081234567890', 'Surabaya'),
(2, 'Siti Aminah', 'P', '081234567891', 'Bangkalan'),
(3, 'Ahmad Fauzi', 'L', '081234567892', 'Sidoarjo'),
(4, 'Dewi Lestari', 'P', '081234567893', 'Malang'),
(5, 'Rudi Hartono', 'L', '081234567894', 'Gresik'),
(6, 'Rina Wati', 'P', '081234567895', 'Surabaya'),
(7, 'Joko Susilo', 'L', '081234567896', 'Pasuruan'),
(8, 'Maya Sari', 'P', '081234567897', 'Mojokerto'),
(9, 'Andi Wijaya', 'L', '081234567898', 'Lamongan'),
(10, 'Lina Marlina', 'P', '081234567899', 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 10:35:00', 164000, 'TUNAI', 1),
(2, '2026-10-02 11:05:00', 62000, 'TRANSFER', 2),
(3, '2026-10-03 12:20:00', 52000, 'EDC', 3),
(4, '2026-10-04 13:05:00', 59000, 'TUNAI', 4),
(5, '2026-10-05 14:25:00', 133000, 'TRANSFER', 5),
(6, '2026-10-06 15:15:00', 95000, 'EDC', 6),
(7, '2026-10-07 16:05:00', 80000, 'TUNAI', 7),
(8, '2026-10-08 17:35:00', 72000, 'TRANSFER', 8),
(9, '2026-10-09 18:05:00', 70000, 'EDC', 9),
(10, '2026-10-10 19:05:00', 156000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(2, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(3, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(4, 'CV. Sumber Makmur', '081333444555', 'Sidoarjo'),
(5, 'PT. Cahaya Abadi', '082111222333', 'Malang'),
(6, 'UD. Berkah Jaya', '081777888999', 'Gresik'),
(7, 'PT. Prima Food', '083888999000', 'Surabaya'),
(8, 'CV. Mitra Sejahtera', '085611122233', 'Pasuruan'),
(9, 'PT. Anugerah Sentosa', '081233344455', 'Mojokerto'),
(10, 'UD. Tiga Bintang', '087855566677', 'Lamongan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01', 'Pembelian sembako bulanan', 164000, 1),
(2, '2026-10-02', 'Pembelian kebutuhan dapur', 62000, 2),
(3, '2026-10-03', 'Pembelian bahan kue', 52000, 3),
(4, '2026-10-04', 'Pembelian minuman dan air mineral', 59000, 4),
(5, '2026-10-05', 'Pembelian stok warung', 133000, 5),
(6, '2026-10-06', 'Pembelian beras dan gula', 95000, 6),
(7, '2026-10-07', 'Pembelian minyak dan tepung', 80000, 7),
(8, '2026-10-08', 'Pembelian teh dan susu', 72000, 8),
(9, '2026-10-09', 'Pembelian kopi dan air mineral', 70000, 9),
(10, '2026-10-10', 'Pembelian grosir mie dan sabun', 156000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 65000, 2),
(1, 2, 34000, 1),
(2, 3, 15000, 3),
(2, 5, 8500, 2),
(3, 4, 12000, 2),
(3, 6, 28000, 1),
(4, 7, 19000, 2),
(4, 9, 3500, 6),
(5, 8, 110000, 1),
(5, 10, 23000, 1),
(6, 1, 65000, 1),
(6, 3, 15000, 2),
(7, 2, 34000, 2),
(7, 4, 12000, 1),
(8, 5, 8500, 4),
(8, 7, 19000, 2),
(9, 6, 28000, 2),
(9, 9, 3500, 4),
(10, 8, 110000, 1),
(10, 10, 23000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '$2y$10$hashpasswordmodul5praktik001', 'Administrator', 'Surabaya', '081200000001', 1),
(2, 'kasir1', '$2y$10$hashpasswordmodul5praktik002', 'Siti Kasir', 'Bangkalan', '081200000002', 0),
(3, 'kasir2', '$2y$10$hashpasswordmodul5praktik003', 'Dewi Kasir', 'Sidoarjo', '081200000003', 0),
(4, 'kasir3', '$2y$10$hashpasswordmodul5praktik004', 'Rina Kasir', 'Malang', '081200000004', 0),
(5, 'gudang1', '$2y$10$hashpasswordmodul5praktik005', 'Joko Gudang', 'Gresik', '081200000005', 0),
(6, 'supervisor', '$2y$10$hashpasswordmodul5praktik006', 'Ahmad Supervisor', 'Surabaya', '081200000006', 1),
(7, 'kasir4', '$2y$10$hashpasswordmodul5praktik007', 'Maya Kasir', 'Pasuruan', '081200000007', 0),
(8, 'kasir5', '$2y$10$hashpasswordmodul5praktik008', 'Andi Kasir', 'Mojokerto', '081200000008', 0),
(9, 'admin2', '$2y$10$hashpasswordmodul5praktik009', 'Lina Admin', 'Lamongan', '081200000009', 1),
(10, 'kasir6', '$2y$10$hashpasswordmodul5praktik010', 'Fajar Kasir', 'Surabaya', '081200000010', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
