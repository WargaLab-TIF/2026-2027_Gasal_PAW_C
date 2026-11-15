-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2026 at 07:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Beras 5 Kg', 62000, 50, 1),
(2, 'BRG002', 'Minyak Goreng 2 L', 38000, 40, 2),
(3, 'BRG003', 'Gula Pasir 1 Kg', 16000, 60, 3),
(4, 'BRG004', 'Telur Ayam 1 Kg', 28000, 35, 1),
(5, 'BRG005', 'Kopi Bubuk 200 g', 22000, 45, 4),
(6, 'BRG006', 'Teh Celup 25 pcs', 9000, 80, 5),
(7, 'BRG007', 'Susu UHT 1 L', 18000, 55, 6),
(8, 'BRG008', 'Mie Instan', 3500, 200, 7),
(9, 'BRG009', 'Sabun Mandi', 4500, 100, 8),
(10, 'BRG010', 'Detergen 800 g', 21000, 70, 9);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Budi Santoso', 'L', '081211110001', 'Jl. Mawar No. 1, Surabaya'),
('PLG002', 'Siti Aminah', 'P', '081211110002', 'Jl. Melati No. 2, Surabaya'),
('PLG003', 'Agus Prasetyo', 'L', '081211110003', 'Jl. Kenanga No. 3, Sidoarjo'),
('PLG004', 'Dewi Lestari', 'P', '081211110004', 'Jl. Anggrek No. 4, Gresik'),
('PLG005', 'Rudi Hartono', 'L', '081211110005', 'Jl. Dahlia No. 5, Surabaya'),
('PLG006', 'Rina Wulandari', 'P', '081211110006', 'Jl. Teratai No. 6, Bangkalan'),
('PLG007', 'Joko Widodo', 'L', '081211110007', 'Jl. Flamboyan No. 7, Malang'),
('PLG008', 'Ani Rahmawati', 'P', '081211110008', 'Jl. Cempaka No. 8, Surabaya'),
('PLG009', 'Eko Nugroho', 'L', '081211110009', 'Jl. Seruni No. 9, Mojokerto'),
('PLG010', 'Lina Marlina', 'P', '081211110010', 'Jl. Kamboja No. 10, Pasuruan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 10:15:00', 94000, 'TUNAI', 1),
(2, '2026-10-03 11:00:00', 38000, 'TRANSFER', 2),
(3, '2026-10-05 09:30:00', 71000, 'EDC', 3),
(4, '2026-10-08 14:20:00', 44000, 'TUNAI', 4),
(5, '2026-10-10 16:45:00', 55000, 'TRANSFER', 5),
(6, '2026-10-12 13:10:00', 18000, 'TUNAI', 6),
(7, '2026-10-15 17:05:00', 58000, 'EDC', 7),
(8, '2026-10-18 10:50:00', 124000, 'TRANSFER', 8),
(9, '2026-10-20 15:25:00', 54000, 'TUNAI', 9),
(10, '2026-10-25 12:40:00', 108000, 'EDC', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(2, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(3, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(4, 'CV. Sumber Rejeki', '081234567', 'Sidoarjo'),
(5, 'PT. Mitra Jaya', '085612345', 'Gresik'),
(6, 'CV. Berkah Abadi', '081377788', 'Malang'),
(7, 'PT. Indo Sejahtera', '082199900', 'Mojokerto'),
(8, 'CV. Cahaya Baru', '087811122', 'Pasuruan'),
(9, 'PT. Global Makmur', '081933344', 'Lamongan'),
(10, 'CV. Tiga Saudara', '085255566', 'Jombang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01', 'Belanja bulanan', 94000, 'PLG001'),
(2, '2026-10-03', 'Beli minyak goreng', 38000, 'PLG002'),
(3, '2026-10-05', 'Belanja mingguan', 71000, 'PLG003'),
(4, '2026-10-08', 'Beli kopi', 44000, 'PLG004'),
(5, '2026-10-10', 'Belanja dapur', 55000, 'PLG005'),
(6, '2026-10-12', 'Beli sabun', 18000, 'PLG006'),
(7, '2026-10-15', 'Kebutuhan rumah tangga', 58000, 'PLG007'),
(8, '2026-10-18', 'Beli beras 2 sak', 124000, 'PLG008'),
(9, '2026-10-20', 'Beli susu', 54000, 'PLG009'),
(10, '2026-10-25', 'Stok warung', 108000, 'PLG010');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 62000, 1),
(1, 3, 16000, 2),
(2, 2, 38000, 1),
(3, 7, 18000, 2),
(3, 8, 3500, 10),
(4, 5, 22000, 2),
(5, 4, 28000, 1),
(5, 6, 9000, 3),
(6, 9, 4500, 4),
(7, 3, 16000, 1),
(7, 10, 21000, 2),
(8, 1, 62000, 2),
(9, 7, 18000, 3),
(10, 2, 38000, 1),
(10, 8, 3500, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 'Surabaya', '081300000001', 1),
(2, 'kasir1', 'de28f8f7998f23ab4194b51a6029416f', 'Kasir Satu', 'Surabaya', '081300000002', 2),
(3, 'kasir2', 'de28f8f7998f23ab4194b51a6029416f', 'Kasir Dua', 'Sidoarjo', '081300000003', 2),
(4, 'gudang1', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Staf Gudang 1', 'Gresik', '081300000004', 3),
(5, 'gudang2', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Staf Gudang 2', 'Bangkalan', '081300000005', 3),
(6, 'owner', '5be057accb25758101fa5eadbbd79503', 'Pemilik Toko', 'Surabaya', '081300000006', 1),
(7, 'sales1', '0ad80eb119d9bf7775aa23786b05b391', 'Sales Satu', 'Malang', '081300000007', 2),
(8, 'sales2', '0ad80eb119d9bf7775aa23786b05b391', 'Sales Dua', 'Mojokerto', '081300000008', 2),
(9, 'audit', 'd33542b8458db8cabd9843fe7c1e8784', 'Auditor', 'Pasuruan', '081300000009', 3),
(10, 'tamu', '26364ac030f3791242f334bc3749fe36', 'Pengguna Tamu', 'Lamongan', '081300000010', 4);

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
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_detail_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
