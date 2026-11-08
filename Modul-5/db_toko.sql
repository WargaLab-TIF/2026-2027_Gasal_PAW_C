-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2026 at 04:40 AM
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
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'B01', 'Mouse Wireless', 55000, 30, 1),
(2, 'B02', 'Tang Crimping', 30000, 15, 2),
(3, 'B03', 'Monitor LED', 1500000, 10, 3),
(4, 'B04', 'Flashdisk', 70000, 30, 4),
(5, 'B05', 'Tas Laptop', 95000, 45, 5),
(6, 'B06', 'Tinta Printer', 100000, 12, 6),
(7, 'B07', 'Printer', 2000000, 8, 7),
(8, 'B08', 'Speaker', 200000, 18, 8),
(9, 'B09', 'Harddisk 1TB', 850000, 9, 9),
(10, 'B10', 'Kabel Type C', 25000, 40, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Enzo Pratama Bustomi', 'L', '081234567811', 'Bojonegoro'),
(2, 'Rizal Maulana', 'L', '081234567812', 'Bojonegoro'),
(3, 'Roro Wijeng Prawesti', 'P', '081234567813', 'Surabaya'),
(4, 'Nisa', 'P', '081234567814', 'Sampang'),
(5, 'Yazid Bustomi', 'L', '081234567815', 'Banjarmasin'),
(6, 'Farida', 'P', '081234567816', 'Semarang'),
(7, 'Abdul Basith Farhan Al-Azhar', 'L', '081234567817', 'Jakarta'),
(8, 'Noer Hidayah', 'P', '081234567818', 'Gresik'),
(9, 'Ali Wajib Subagio', 'L', '081234567819', 'Tuban'),
(10, 'Dimas', 'L', '081234567820', 'Bali');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('Tunai','Transfer','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 09:10:00', 55000, 'Tunai', 1),
(2, '2026-10-02 10:25:00', 30000, 'Transfer', 2),
(3, '2026-10-03 11:40:00', 1500000, 'EDC', 3),
(4, '2026-10-04 13:10:00', 70000, 'Tunai', 4),
(5, '2026-10-05 14:30:00', 95000, 'Transfer', 5),
(6, '2026-10-06 09:55:00', 100000, 'EDC', 6),
(7, '2026-10-07 15:20:00', 200000, 'Tunai', 7),
(8, '2026-10-08 10:10:00', 200000, 'Transfer', 8),
(9, '2026-10-09 12:40:00', 850000, 'EDC', 9),
(10, '2026-10-10 16:10:00', 25000, 'Tunai', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Kurnia ', '08123458888', 'Bojonegoro'),
(2, 'CV ciuhuahua', '081234567802', 'Semarang'),
(3, 'PT Salemba', '081234567803', 'Madura'),
(4, 'CV Berkah Jaya', '081234567804', 'Pamekasan'),
(5, 'PT Sinar Terang', '081234567805', 'Sampang'),
(6, 'CV Cahaya Bintang', '081234567806', 'Sumenep'),
(7, 'PT Maju jaya', '081234567807', 'Lamongan'),
(8, 'CV Karya Mandiri', '081234567808', 'Gresik'),
(9, 'PT Sentosa Abadi', '081234567809', 'Surabaya'),
(11, 'PT Cinta Sejati', '081234588880', 'Bojonegoro');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pelanggan_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01 09:00:00', 'Pembelian perlengkapan komputer', 55000, 1),
(2, '2026-10-02 10:15:00', 'Pembelian alat jaringan', 30000, 2),
(3, '2026-10-03 11:30:00', 'Pembelian monitor', 1500000, 3),
(4, '2026-10-04 13:00:00', 'Pembelian flashdisk', 70000, 4),
(5, '2026-10-05 14:20:00', 'Pembelian tas laptop', 95000, 5),
(6, '2026-10-06 09:45:00', 'Pembelian tinta printer', 100000, 6),
(7, '2026-10-07 15:10:00', 'Pembelian printer', 200000, 7),
(8, '2026-10-08 10:00:00', 'Pembelian speaker', 200000, 8),
(9, '2026-10-09 12:30:00', 'Pembelian harddisk', 850000, 9),
(10, '2026-10-10 16:00:00', 'Pembelian kabel Type C', 25000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 55000, 1),
(2, 2, 30000, 1),
(3, 3, 1500000, 1),
(4, 4, 70000, 1),
(5, 5, 95000, 1),
(6, 6, 100000, 1),
(7, 7, 200000, 1),
(8, 8, 200000, 1),
(9, 9, 850000, 1),
(10, 10, 25000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'rizal01', 'rizal123', 'Rizal Maulana', 'Bangkalan', '081234567801', 1),
(2, 'budi02', 'budi123', 'Budi Santoso', 'Surabaya', '081234567802', 2),
(3, 'siti03', 'siti123', 'Siti Aminah', 'Pamekasan', '081234567803', 2),
(4, 'dimas04', 'dimas123', 'Dimas Pratama', 'Sampang', '081234567804', 2),
(5, 'nanda05', 'nanda123', 'Nanda Putri', 'Sumenep', '081234567805', 2),
(6, 'fajar06', 'fajar123', 'Fajar Ramadhan', 'Bojonegoro', '081234567806', 2),
(7, 'putri07', 'putri123', 'Putri Amelia', 'Lamongan', '081234567807', 2),
(8, 'wahyu08', 'wahyu123', 'Wahyu Setiawan', 'Gresik', '081234567808', 2),
(9, 'dewi09', 'dewi123', 'Dewi Lestari', 'Surabaya', '081234567809', 2),
(10, 'yoga10', 'yoga123', 'Yoga Firmansyah', 'Bangkalan', '081234567810', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id_user`);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_detail_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
