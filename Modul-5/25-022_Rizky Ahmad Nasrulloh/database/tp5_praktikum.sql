-- =====================================================================
-- Modul 5 : Database
-- Nama    : Rizky Ahmad Nasrulloh
-- NIM     : 25-022
-- File    : database/tp5_praktikum.sql
-- Catatan : Import lewat phpMyAdmin (tab Import) atau:
--           mysql -u root < tp5_praktikum.sql
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `tp5_praktikum`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE `tp5_praktikum`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `pembayaran`;
DROP TABLE IF EXISTS `transaksi_detail`;
DROP TABLE IF EXISTS `transaksi`;
DROP TABLE IF EXISTS `barang`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `pelanggan`;
DROP TABLE IF EXISTS `supplier`;
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------------------
-- 1. supplier
-- ---------------------------------------------------------------------
CREATE TABLE `supplier` (
    `id`     int(11)      NOT NULL AUTO_INCREMENT,
    `nama`   varchar(100) NOT NULL,
    `telp`   varchar(12)  NOT NULL,
    `alamat` text         DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1,  'PT. Maju Bersama',   '081234567890', 'Jl. Rungkut Industri No. 12, Surabaya'),
(2,  'PT. Senang Sekali',  '081515563',    'Jl. Raya Bangkalan No. 45, Bangkalan'),
(3,  'PT. Segar Segar',    '0845454663',   'Jl. Diponegoro No. 88, Surabaya'),
(4,  'CV. Sumber Rejeki',  '081333444555', 'Jl. Ahmad Yani No. 21, Sidoarjo'),
(5,  'PT. Cahaya Abadi',   '082112223333', 'Jl. Basuki Rahmat No. 7, Surabaya'),
(6,  'UD. Berkah Jaya',    '085733334444', 'Jl. Trunojoyo No. 3, Bangkalan'),
(7,  'PT. Karya Mandiri',  '081255556666', 'Jl. Gajah Mada No. 56, Gresik'),
(8,  'CV. Mitra Sejahtera', '081777778888', 'Jl. Veteran No. 9, Sidoarjo'),
(9,  'PT. Indo Makmur',    '081399990000', 'Jl. Mayjen Sungkono No. 101, Surabaya'),
(10, 'UD. Tiga Putra',     '085611112222', 'Jl. Kartini No. 14, Mojokerto');

-- ---------------------------------------------------------------------
-- 2. pelanggan
-- ---------------------------------------------------------------------
CREATE TABLE `pelanggan` (
    `id`            varchar(20)  NOT NULL,
    `nama`          varchar(100) NOT NULL,
    `jenis_kelamin` enum('L','P') NOT NULL,
    `telp`          varchar(12)  NOT NULL,
    `alamat`        text         DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Andi Wijaya',      'L', '081234000001', 'Jl. Ngagel Jaya No. 5, Surabaya'),
('PLG002', 'Siti Aminah',      'P', '081234000002', 'Jl. Pucang Anom No. 12, Surabaya'),
('PLG003', 'Budi Santoso',     'L', '081234000003', 'Jl. Raya Kenjeran No. 88, Surabaya'),
('PLG004', 'Dewi Lestari',     'P', '081234000004', 'Jl. Perak Timur No. 40, Surabaya'),
('PLG005', 'Eko Prasetyo',     'L', '081234000005', 'Jl. Raya Darmo No. 17, Surabaya'),
('PLG006', 'Fitri Handayani',  'P', '081234000006', 'Jl. Manyar Kertoarjo No. 6, Surabaya'),
('PLG007', 'Gunawan Setiawan', 'L', '081234000007', 'Jl. Wonokromo No. 33, Surabaya'),
('PLG008', 'Hesti Rahayu',     'P', '081234000008', 'Jl. Bratang Gede No. 2, Surabaya'),
('PLG009', 'Irfan Maulana',    'L', '081234000009', 'Jl. Kedungdoro No. 55, Surabaya'),
('PLG010', 'Jihan Safira',     'P', '081234000010', 'Jl. Gubeng Kertajaya No. 9, Surabaya');

-- ---------------------------------------------------------------------
-- 3. user
-- ---------------------------------------------------------------------
CREATE TABLE `user` (
    `id_user`  tinyint(2)   NOT NULL AUTO_INCREMENT,
    `username` varchar(30)  NOT NULL,
    `password` varchar(35)  NOT NULL,
    `nama`     varchar(50)  NOT NULL,
    `alamat`   varchar(150) DEFAULT NULL,
    `hp`       varchar(20)  DEFAULT NULL,
    `level`    tinyint(1)   NOT NULL DEFAULT 2,
    PRIMARY KEY (`id_user`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- password admin123 / kasir123 (md5)
INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1,  'admin',   '0192023a7bbd73250516f069df18b500', 'Rizky Ahmad Nasrulloh', 'Jl. Rungkut Asri No. 8, Surabaya',  '081234567001', 1),
(2,  'kasir1',  'de28f8f7998f23ab4194b51a6029416f', 'Andi Wijaya',           'Jl. Ngagel Jaya No. 5, Surabaya',    '081234567002', 2),
(3,  'kasir2',  'de28f8f7998f23ab4194b51a6029416f', 'Siti Aminah',           'Jl. Pucang Anom No. 12, Surabaya',   '081234567003', 2),
(4,  'kasir3',  'de28f8f7998f23ab4194b51a6029416f', 'Budi Santoso',          'Jl. Raya Kenjeran No. 88, Surabaya', '081234567004', 2),
(5,  'kasir4',  'de28f8f7998f23ab4194b51a6029416f', 'Dewi Lestari',         'Jl. Perak Timur No. 40, Surabaya',   '081234567005', 2),
(6,  'kasir5',  'de28f8f7998f23ab4194b51a6029416f', 'Eko Prasetyo',         'Jl. Raya Darmo No. 17, Surabaya',    '081234567006', 2),
(7,  'kasir6',  'de28f8f7998f23ab4194b51a6029416f', 'Fitri Handayani',      'Jl. Manyar Kertoarjo No. 6, Surabaya', '081234567007', 2),
(8,  'kasir7',  'de28f8f7998f23ab4194b51a6029416f', 'Gunawan Setiawan',     'Jl. Wonokromo No. 33, Surabaya',     '081234567008', 2),
(9,  'kasir8',  'de28f8f7998f23ab4194b51a6029416f', 'Hesti Rahayu',         'Jl. Bratang Gede No. 2, Surabaya',   '081234567009', 2),
(10, 'kasir9',  'de28f8f7998f23ab4194b51a6029416f', 'Irfan Maulana',        'Jl. Kedungdoro No. 55, Surabaya',    '081234567010', 2);

-- ---------------------------------------------------------------------
-- 4. barang
-- ---------------------------------------------------------------------
CREATE TABLE `barang` (
    `id`          int(11)      NOT NULL AUTO_INCREMENT,
    `kode_barang` varchar(10)  NOT NULL,
    `nama_barang` varchar(100) NOT NULL,
    `harga`       int(11)      NOT NULL,
    `stok`        int(11)      NOT NULL DEFAULT 0,
    `supplier_id` int(11)      DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `kode_barang` (`kode_barang`),
    KEY `fk_barang_supplier` (`supplier_id`),
    CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`supplier_id`)
        REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1,  'BRG001', 'Kopi Kapal Api 250g',       12500, 40,  1),
(2,  'BRG002', 'Gula Pasir 1kg',            15000, 25,  2),
(3,  'BRG003', 'Teh Sariwangi 25s',          8500, 30,  3),
(4,  'BRG004', 'Air Mineral Aqua 600ml',     3500, 120, 4),
(5,  'BRG005', 'Minyak Goreng Sania 1L',    18500, 18,  5),
(6,  'BRG006', 'Beras Ramos 5kg',           68000, 12,  6),
(7,  'BRG007', 'Mie Instan Indomie Goreng',  3100, 200, 7),
(8,  'BRG008', 'Sabun Lifebuoy Batang',      4500, 60,  8),
(9,  'BRG009', 'Susu Ultra 250ml',           6000, 45,  9),
(10, 'BRG010', 'Telur Ayam 1kg',            29000, 20,  10);

-- ---------------------------------------------------------------------
-- 5. transaksi
-- ---------------------------------------------------------------------
CREATE TABLE `transaksi` (
    `id`              int(11)     NOT NULL AUTO_INCREMENT,
    `waktu_transaksi` date        NOT NULL,
    `keterangan`      text        DEFAULT NULL,
    `total`           int(11)     NOT NULL DEFAULT 0,
    `pelanggan_id`    varchar(20) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_transaksi_pelanggan` (`pelanggan_id`),
    CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`pelanggan_id`)
        REFERENCES `pelanggan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1,  '2026-10-01', 'Belanja harian',             35500,  'PLG001'),
(2,  '2026-10-03', 'Belanja kebutuhan dapur',    30500,  'PLG002'),
(3,  '2026-10-05', 'Pembelian minuman',          29000,  'PLG003'),
(4,  '2026-10-08', 'Belanja bulanan',            97000,  'PLG004'),
(5,  '2026-10-12', 'Belanja harian',             39500,  'PLG005'),
(6,  '2026-10-15', 'Belanja snack dan mie',      49000,  'PLG006'),
(7,  '2026-10-19', 'Belanja kebutuhan pokok',    42500,  'PLG007'),
(8,  '2026-10-22', 'Pembelian susu dan teh',     44500,  'PLG008'),
(9,  '2026-10-26', 'Belanja bulanan',            173000, 'PLG009'),
(10, '2026-10-30', 'Belanja harian',             80300,  'PLG010');

-- ---------------------------------------------------------------------
-- 6. transaksi_detail
-- ---------------------------------------------------------------------
CREATE TABLE `transaksi_detail` (
    `transaksi_id` int(11) NOT NULL,
    `barang_id`    int(11) NOT NULL,
    `harga`        int(11) NOT NULL,
    `qty`          int(11) NOT NULL,
    PRIMARY KEY (`transaksi_id`, `barang_id`),
    KEY `fk_detail_barang` (`barang_id`),
    CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`transaksi_id`)
        REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_detail_barang` FOREIGN KEY (`barang_id`)
        REFERENCES `barang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1,  1,  12500, 2),
(1,  4,  3500,  3),
(2,  2,  15000, 1),
(2,  7,  3100,  5),
(3,  3,  8500,  2),
(3,  9,  6000,  2),
(4,  6,  68000, 1),
(4,  10, 29000, 1),
(5,  5,  18500, 1),
(5,  4,  3500,  6),
(6,  8,  4500,  4),
(6,  7,  3100,  10),
(7,  1,  12500, 1),
(7,  2,  15000, 2),
(8,  9,  6000,  6),
(8,  3,  8500,  1),
(9,  6,  68000, 2),
(9,  5,  18500, 2),
(10, 4,  3500,  12),
(10, 10, 29000, 1),
(10, 7,  3100,  3);

-- ---------------------------------------------------------------------
-- 7. pembayaran
-- ---------------------------------------------------------------------
CREATE TABLE `pembayaran` (
    `id`           int(11)  NOT NULL AUTO_INCREMENT,
    `waktu_bayar`  datetime NOT NULL,
    `total`        int(11)  NOT NULL,
    `metode`       enum('TUNAI','TRANSFER','EDC') NOT NULL DEFAULT 'TUNAI',
    `transaksi_id` int(11)  NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_pembayaran_transaksi` (`transaksi_id`),
    CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`transaksi_id`)
        REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1,  '2026-10-01 10:15:00', 35500,  'TUNAI',    1),
(2,  '2026-10-03 11:20:00', 30500,  'TRANSFER', 2),
(3,  '2026-10-05 09:05:00', 29000,  'EDC',      3),
(4,  '2026-10-08 14:30:00', 97000,  'TRANSFER', 4),
(5,  '2026-10-12 16:45:00', 39500,  'TUNAI',    5),
(6,  '2026-10-15 08:50:00', 49000,  'EDC',      6),
(7,  '2026-10-19 13:10:00', 42500,  'TUNAI',    7),
(8,  '2026-10-22 15:25:00', 44500,  'TRANSFER', 8),
(9,  '2026-10-26 10:40:00', 173000, 'EDC',      9),
(10, '2026-10-30 17:15:00', 80300,  'TUNAI',    10);
