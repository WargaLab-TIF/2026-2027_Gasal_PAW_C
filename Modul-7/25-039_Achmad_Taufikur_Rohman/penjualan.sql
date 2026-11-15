-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2026 pada 23.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `barang`
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
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Laptop Asus', 7500000, 15, 1),
(2, 'BRG002', 'Mouse Logitech', 150000, 50, 2),
(3, 'BRG003', 'Keyboard Mechanical', 350000, 30, 3),
(4, 'BRG004', 'Monitor Samsung', 1800000, 20, 4),
(5, 'BRG005', 'Flashdisk 32GB', 75000, 100, 5),
(6, 'BRG006', 'Harddisk 1TB', 850000, 25, 6),
(7, 'BRG007', 'Printer Epson', 2200000, 12, 7),
(8, 'BRG008', 'Headset Gaming', 275000, 40, 8),
(9, 'BRG009', 'Webcam Logitech', 450000, 18, 9),
(10, 'BRG011', 'Keyboard Wireless', 250000, 20, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Dimas Saputra', 'L', '081234567811', 'Bangkalan'),
(2, 'Siti Aminah', 'P', '081234567802', 'Surabaya'),
(3, 'Budi Santoso', 'L', '081234567803', 'Madura'),
(4, 'Dewi Lestari', 'P', '081234567804', 'Sampang'),
(5, 'Rizky Pratama', 'L', '081234567805', 'Pamekasan'),
(6, 'Nur Aisyah', 'P', '081234567806', 'Sumenep'),
(7, 'Andi Wijaya', 'L', '081234567807', 'Gresik'),
(8, 'Putri Maharani', 'P', '081234567808', 'Lamongan'),
(9, 'Fajar Ramadhan', 'L', '081234567809', 'Sidoarjo'),
(10, 'Rina Kartika', 'P', '081234567810', 'Mojokerto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(2, '2026-10-02 10:00:00', 300000, 'TRANSFER', 2),
(3, '2026-10-03 11:00:00', 700000, 'EDC', 3),
(4, '2026-10-04 12:00:00', 3600000, 'TUNAI', 4),
(5, '2026-10-05 13:00:00', 225000, 'TRANSFER', 5),
(6, '2026-10-06 14:00:00', 1700000, 'EDC', 6),
(7, '2026-10-07 15:00:00', 4400000, 'TUNAI', 7),
(8, '2026-10-08 16:00:00', 550000, 'TRANSFER', 8),
(9, '2026-10-09 17:00:00', 900000, 'EDC', 9),
(10, '2026-10-10 18:00:00', 600000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Makmur', '081111111101', 'Surabaya'),
(2, 'CV Jaya Abadi', '081111111102', 'Bangkalan'),
(3, 'PT Elektronik Sejahtera', '081111111103', 'Gresik'),
(4, 'CV Mitra Usaha', '081111111104', 'Sidoarjo'),
(5, 'PT Berkah Jaya', '081111111105', 'Malang'),
(6, 'CV Sinar Terang', '081111111106', 'Madura'),
(7, 'PT Maju Bersama', '081111111107', 'Surabaya'),
(8, 'CV Karya Mandiri', '081111111108', 'Pamekasan'),
(9, 'PT Sentosa Abadi', '081111111109', 'Lamongan'),
(10, 'PT Sumber Rezeki', '081234567812', 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pelanggan_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-08', 'Pembelian keyboard wireless', 500000, 1),
(2, '2026-10-02', 'Pembelian mouse', 300000, 2),
(3, '2026-10-03', 'Pembelian keyboard', 700000, 3),
(4, '2026-10-04', 'Pembelian monitor', 3600000, 4),
(5, '2026-10-05', 'Pembelian flashdisk', 225000, 5),
(6, '2026-10-06', 'Pembelian harddisk', 1700000, 6),
(7, '2026-10-07', 'Pembelian printer', 4400000, 7),
(8, '2026-10-08', 'Pembelian headset', 550000, 8),
(9, '2026-10-09', 'Pembelian webcam', 900000, 9),
(10, '2026-10-10', 'Pembelian speaker', 600000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(2, 2, 150000, 2),
(3, 3, 350000, 2),
(4, 4, 1800000, 2),
(5, 5, 75000, 3),
(6, 6, 850000, 2),
(7, 7, 2200000, 2),
(8, 8, 275000, 2),
(9, 9, 450000, 2),
(1, 1, 250000, 2),
(10, 1, 250000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'Administrator', 'Surabaya', '082111111101', 1),
(2, 'kasir01', 'kasir123', 'Ahmad Fauzi', 'Bangkalan', '082111111102', 2),
(3, 'kasir02', 'kasir123', 'Siti Aminah', 'Surabaya', '082111111103', 2),
(4, 'kasir03', 'kasir123', 'Budi Santoso', 'Madura', '082111111104', 2),
(5, 'operator01', 'oper123', 'Dewi Lestari', 'Sampang', '082111111105', 3),
(6, 'operator02', 'oper123', 'Rizky Pratama', 'Pamekasan', '082111111106', 3),
(7, 'staff01', 'staff123', 'Nur Aisyah', 'Sumenep', '082111111107', 3),
(8, 'staff02', 'staff123', 'Andi Wijaya', 'Gresik', '082111111108', 3),
(9, 'staff03', 'staff123', 'Putri Maharani', 'Lamongan', '082111111109', 3),
(10, 'staff04', 'staff123', 'Fajar Ramadhan', 'Sidoarjo', '082111111110', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
