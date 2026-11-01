-- Modul 5 : Database "penjualan"
CREATE DATABASE IF NOT EXISTS penjualan CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE penjualan;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS pembayaran, transaksi_detail, transaksi, barang, supplier, pelanggan, `user`;
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------
-- STRUKTUR TABEL
-- ---------------------------------------------------------
CREATE TABLE pelanggan (
  id            VARCHAR(20)  NOT NULL,
  nama          VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12)  NOT NULL,
  alamat        TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE supplier (
  id     INT(11)      NOT NULL AUTO_INCREMENT,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12)  NOT NULL,
  alamat TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE barang (
  id          INT(11)      NOT NULL AUTO_INCREMENT,
  kode_barang VARCHAR(10)  NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT(11)      NOT NULL,
  stok        INT(11)      NOT NULL,
  supplier_id INT(11)      NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id)
    REFERENCES supplier(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id              INT(11)     NOT NULL AUTO_INCREMENT,
  waktu_transaksi DATE        NOT NULL,
  keterangan      TEXT        NOT NULL,
  total           INT(11)     NOT NULL,
  pelanggan_id    VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT(11) NOT NULL,
  barang_id    INT(11) NOT NULL,
  harga        INT(11) NOT NULL,
  qty          INT(11) NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id)
    REFERENCES barang(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id           INT(11)  NOT NULL AUTO_INCREMENT,
  waktu_bayar  DATETIME NOT NULL,
  total        INT(11)  NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT(11)  NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `user` (
  id_user  TINYINT(2)   NOT NULL AUTO_INCREMENT,
  username VARCHAR(30)  NOT NULL,
  password VARCHAR(35)  NOT NULL,
  nama     VARCHAR(50)  NOT NULL,
  alamat   VARCHAR(150) NOT NULL,
  hp       VARCHAR(20)  NOT NULL,
  level    TINYINT(1)   NOT NULL,
  PRIMARY KEY (id_user)
) ENGINE=InnoDB;

-- ---------------------------------------------------------
-- DATA MASTER
-- ---------------------------------------------------------
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama',   '08123456',     'Surabaya'),
('PT. Senang Sekali',  '081515563',    'Bangkalan'),
('PT. Segar Segar',    '0845454663',   'Surabaya'),
('CV. Sumber Rejeki',  '081233445566', 'Sidoarjo'),
('PT. Berkah Jaya',    '081322110099', 'Gresik'),
('CV. Mitra Abadi',    '082144556677', 'Malang'),
('PT. Sinar Makmur',   '085611223344', 'Mojokerto'),
('UD. Tani Subur',     '081900112233', 'Lamongan'),
('PT. Indo Pangan',    '087855667788', 'Surabaya'),
('CV. Cahaya Baru',    '081277889900', 'Pasuruan');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Budi Santoso',   'L', '081234567801', 'Jl. Mawar No. 1, Surabaya'),
('PLG002', 'Siti Aminah',    'P', '081234567802', 'Jl. Melati No. 2, Sidoarjo'),
('PLG003', 'Agus Prasetyo',  'L', '081234567803', 'Jl. Kenanga No. 3, Gresik'),
('PLG004', 'Dewi Lestari',   'P', '081234567804', 'Jl. Anggrek No. 4, Surabaya'),
('PLG005', 'Rizky Ramadhan', 'L', '081234567805', 'Jl. Dahlia No. 5, Malang'),
('PLG006', 'Putri Handayani','P', '081234567806', 'Jl. Flamboyan No. 6, Bangkalan'),
('PLG007', 'Eko Wijaya',     'L', '081234567807', 'Jl. Cempaka No. 7, Mojokerto'),
('PLG008', 'Nur Hidayah',    'P', '081234567808', 'Jl. Teratai No. 8, Surabaya'),
('PLG009', 'Hendra Gunawan', 'L', '081234567809', 'Jl. Kamboja No. 9, Pasuruan'),
('PLG010', 'Rina Marlina',   'P', '081234567810', 'Jl. Seruni No. 10, Lamongan');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras 5 Kg',        65000, 100, 1),
('BRG002', 'Minyak Goreng 2 L', 38000,  80, 2),
('BRG003', 'Gula Pasir 1 Kg',   16000, 120, 3),
('BRG004', 'Telur Ayam 1 Kg',   28000,  60, 4),
('BRG005', 'Kopi Bubuk 200 g',  22000,  75, 5),
('BRG006', 'Teh Celup 25 pcs',   9000, 150, 6),
('BRG007', 'Susu UHT 1 L',      18000,  90, 7),
('BRG008', 'Mie Instan',         3500, 300, 8),
('BRG009', 'Sabun Mandi',        4500, 200, 9),
('BRG010', 'Deterjen 800 g',    21000, 110, 10);

INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES
('admin',   MD5('admin123'),  'Administrator',   'Surabaya',  '081100000001', 1),
('kasir1',  MD5('kasir123'),  'Andi Kasir',      'Sidoarjo',  '081100000002', 2),
('kasir2',  MD5('kasir123'),  'Bella Kasir',     'Gresik',    '081100000003', 2),
('gudang1', MD5('gudang123'), 'Candra Gudang',   'Surabaya',  '081100000004', 3),
('gudang2', MD5('gudang123'), 'Dina Gudang',     'Malang',    '081100000005', 3),
('owner',   MD5('owner123'),  'Pak Owner',       'Surabaya',  '081100000006', 1),
('sales1',  MD5('sales123'),  'Eka Sales',       'Mojokerto', '081100000007', 2),
('sales2',  MD5('sales123'),  'Fajar Sales',     'Pasuruan',  '081100000008', 2),
('staff1',  MD5('staff123'),  'Gita Staff',      'Lamongan',  '081100000009', 3),
('staff2',  MD5('staff123'),  'Hari Staff',      'Bangkalan', '081100000010', 3);

-- ---------------------------------------------------------
-- DATA TRANSAKSI
-- ---------------------------------------------------------
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Belanja bulanan',       97000, 'PLG001'),
('2026-10-02', 'Beli minyak goreng',    38000, 'PLG002'),
('2026-10-04', 'Belanja warung',        91000, 'PLG003'),
('2026-10-06', 'Kopi dan teh',          40000, 'PLG004'),
('2026-10-08', 'Susu untuk anak',       54000, 'PLG005'),
('2026-10-10', 'Sabun mandi',           18000, 'PLG006'),
('2026-10-12', 'Deterjen dan gula',     58000, 'PLG007'),
('2026-10-15', 'Beras 2 karung',       130000, 'PLG008'),
('2026-10-18', 'Mie instan acara',      70000, 'PLG009'),
('2026-10-20', 'Minyak dan telur',     104000, 'PLG010');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 65000,  1),
(1, 3, 16000,  2),
(2, 2, 38000,  1),
(3, 4, 28000,  2),
(3, 8,  3500, 10),
(4, 5, 22000,  1),
(4, 6,  9000,  2),
(5, 7, 18000,  3),
(6, 9,  4500,  4),
(7, 10, 21000, 2),
(7, 3,  16000, 1),
(8, 1,  65000, 2),
(9, 8,   3500, 20),
(10, 2, 38000, 2),
(10, 4, 28000, 1);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:15:00',  97000, 'TUNAI',    1),
('2026-10-02 11:30:00',  38000, 'TRANSFER', 2),
('2026-10-04 09:45:00',  91000, 'EDC',      3),
('2026-10-06 14:20:00',  40000, 'TUNAI',    4),
('2026-10-08 16:05:00',  54000, 'TRANSFER', 5),
('2026-10-10 08:50:00',  18000, 'TUNAI',    6),
('2026-10-12 13:10:00',  58000, 'EDC',      7),
('2026-10-15 15:40:00', 130000, 'TRANSFER', 8),
('2026-10-18 12:00:00',  70000, 'TUNAI',    9),
('2026-10-20 17:25:00', 104000, 'EDC',     10);
