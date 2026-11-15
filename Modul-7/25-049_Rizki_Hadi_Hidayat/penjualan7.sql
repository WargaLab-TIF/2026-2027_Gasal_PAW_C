SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan7`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'ACC001', 'Mouse Gaming RGB Wireless', 175000, 25, 1),
(2, 'ACC002', 'Keyboard Mechanical Blue Switch', 350000, 15, 2),
(3, 'ACC003', 'Headset Gaming 7.1 Surround', 280000, 20, 3),
(4, 'ACC004', 'Mousepad Gaming Extended XL', 65000, 40, 4),
(5, 'ACC005', 'Cooling Pad Laptop 5 Fan', 120000, 30, 5),
(6, 'ACC006', 'Flashdisk 32GB USB 3.0', 55000, 50, 6),
(7, 'ACC007', 'Kabel HDMI 2 Meter', 45000, 35, 7),
(8, 'ACC008', 'SSD External 512GB', 750000, 10, 8),
(9, 'ACC009', 'Webcam HD 1080p', 220000, 18, 9),
(10, 'ACC010', 'Flashdisk 64GB USB 3.1', 95000, 45, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Rizki Hidayat', 'L', '085233110001', 'Bangkalan'),
('PLG002', 'Ahmad Fauzi', 'L', '085233110002', 'Surabaya'),
('PLG003', 'Siti Rahmawati', 'P', '085233110003', 'Sidoarjo'),
('PLG004', 'Dwi Cahyono', 'L', '085233110004', 'Gresik'),
('PLG005', 'Putri Ananda', 'P', '085233110005', 'Malang'),
('PLG006', 'Reza Pahlevi', 'L', '085233110006', 'Madura'),
('PLG007', 'Fitri Handayani', 'P', '085233110007', 'Surabaya'),
('PLG008', 'Bayu Pratama', 'L', '085233110008', 'Mojokerto'),
('PLG009', 'Mega Lestari', 'P', '085233110009', 'Lamongan'),
('PLG010', 'Yoga Mahendra', 'L', '085233110010', 'Bangkalan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-11-01 10:20:00', 350000, 'TRANSFER', 1),
(2, '2026-11-01 13:15:00', 175000, 'TUNAI', 2),
(3, '2026-11-02 14:10:00', 610000, 'EDC', 3),
(4, '2026-11-03 09:45:00', 285000, 'TUNAI', 4),
(5, '2026-11-04 16:30:00', 750000, 'TRANSFER', 5),
(6, '2026-11-05 11:15:00', 255000, 'TUNAI', 6),
(7, '2026-11-06 13:50:00', 350000, 'EDC', 7),
(8, '2026-11-08 15:20:00', 390000, 'TRANSFER', 8),
(9, '2026-11-10 10:05:00', 145000, 'TUNAI', 9),
(10, '2026-11-12 12:40:00', 220000, 'TRANSFER', 10),
(11, '2026-11-14 16:00:00', 525000, 'EDC', 11),
(12, '2026-11-14 17:30:00', 190000, 'TUNAI', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Techno Jaya Abadi', '031560001', 'Jl. Tunjungan No. 25, Surabaya'),
(2, 'CV Aksesoris Komputer Indo', '031560002', 'Jl. Darmo Permai No. 10, Surabaya'),
(3, 'UD Maju Hardware', '031560003', 'Jl. Basuki Rahmat No. 50, Surabaya'),
(4, 'PT Global Periferal', '031560004', 'Jl. Jemursari No. 12, Surabaya'),
(5, 'CV Sentosa Gadget', '031560005', 'Jl. Raya Gubeng No. 88, Surabaya'),
(6, 'PT Mitra Solusi Digital', '031560006', 'Jl. HR Muhammad No. 45, Surabaya'),
(7, 'UD Sumber Berkat Elektronik', '031560007', 'Jl. A. Yani No. 100, Sidoarjo'),
(8, 'CV Nusantara Computindo', '031560008', 'Jl. Panglima Sudirman No. 14, Gresik'),
(9, 'PT Cyber Sukses Mandiri', '031560009', 'Jl. Kertajaya Indah No. 7, Surabaya'),
(10, 'UD Inovasi Teknologi', '031560010', 'Jl. Raya Madura No. 18, Bangkalan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-01', 'Pembelian aksesoris laptop', 350000, 'PLG001'),
(2, '2026-11-01', 'Beli mouse wireless', 175000, 'PLG002'),
(3, '2026-11-02', 'Upgrade perangkat gaming', 610000, 'PLG003'),
(4, '2026-11-03', 'Keperluan kuliah online', 285000, 'PLG001'),
(5, '2026-11-04', 'Pembelian media penyimpanan', 750000, 'PLG004'),
(6, '2026-11-05', 'Perlengkapan kerja harian', 255000, 'PLG005'),
(7, '2026-11-06', 'Pesanan kilat periferi', 350000, 'PLG006'),
(8, '2026-11-08', 'Ganti perangkat rusak', 390000, 'PLG007'),
(9, '2026-11-10', 'Pembelian flashdisk & kabel', 145000, 'PLG008'),
(10, '2026-11-12', 'Keperluan lab jaringan', 220000, 'PLG009'),
(11, '2026-11-14', 'Belanja bulanan toko IT', 525000, 'PLG010'),
(12, '2026-11-14', 'Tambah stok flashdisk', 190000, 'PLG002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 175000, 2),
(2, 1, 175000, 1),
(3, 2, 350000, 1),
(3, 4, 65000, 4),
(4, 1, 175000, 1),
(4, 4, 65000, 1),
(4, 7, 45000, 1),
(5, 8, 750000, 1),
(6, 5, 120000, 1),
(6, 7, 45000, 3),
(7, 2, 350000, 1),
(8, 3, 280000, 1),
(8, 6, 55000, 2),
(9, 6, 55000, 1),
(9, 7, 45000, 2),
(10, 9, 220000, 1),
(11, 5, 120000, 2),
(11, 10, 95000, 3),
(12, 10, 95000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'superadmin', '0192023a7bbd73250516f069df18b500', 'Nero Admin', 'Bangkalan, Madura', '081299887701', 1),
(2, 'kasir_store1', 'de28f8f7998f23ab4194b51a6029416f', 'Angga Kasir', 'Jl. Telang Indah, Bangkalan', '081299887702', 0),
(3, 'kasir_store2', 'de28f8f7998f23ab4194b51a6029416f', 'Siska Kasir', 'Jl. Demangan, Bangkalan', '081299887703', 0),
(4, 'gudang_utama', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Doni Gudang', 'Jl. Raya Kamal, Bangkalan', '081299887704', 0),
(5, 'kepala_gudang', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Eko Gudang', 'Jl. Sembilangan, Bangkalan', '081299887705', 0),
(6, 'manajer_pusat', '0795151defba7a4b5dfa89170de46277', 'Rahmat Manajer', 'Jl. Ahmad Yani, Surabaya', '081299887706', 1),
(7, 'owner_store', '5be057accb25758101fa5eadbbd79503', 'Direktur Utama', 'Jl. Darmo, Surabaya', '081299887707', 1),
(8, 'staff_IT', 'de9bf5643eabf80f4a56fda3bbb84483', 'Nero Support', 'Perum UTM, Bangkalan', '081299887708', 0),
(9, 'staff_keuangan', 'de9bf5643eabf80f4a56fda3bbb84483', 'Nadia Keuangan', 'Jl. Simpang Dukuh, Surabaya', '081299887709', 0),
(10, 'operator_sistem', 'de9bf5643eabf80f4a56fda3bbb84483', 'Fahri Operator', 'Jl. Mawar, Surabaya', '081299887710', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `fk_barang_supplier` (`supplier_id`);

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
  ADD KEY `fk_pembayaran_transaksi` (`transaksi_id`);

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
  ADD KEY `fk_transaksi_pelanggan` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `fk_detail_barang` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_detail_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
