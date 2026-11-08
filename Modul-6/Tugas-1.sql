CREATE DATABASE penjualan;
USE penjualan;

CREATE TABLE supplier (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  telp VARCHAR(12),
  alamat TEXT
);

CREATE TABLE barang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10),
  nama_barang VARCHAR(100),
  harga INT,
  stok INT,
  supplier_id INT,
  FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE pelanggan (
  id VARCHAR(20) PRIMARY KEY,
  nama VARCHAR(100),
  jenis_kelamin ENUM('L','P'),
  telp VARCHAR(12),
  alamat TEXT
);

CREATE TABLE transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi DATE,
  keterangan TEXT,
  total INT,
  pelanggan_id VARCHAR(20),
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
  transaksi_id INT,
  barang_id INT,
  harga INT,
  qty INT,
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
  FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE pembayaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar DATETIME,
  total INT,
  metode ENUM('TUNAI','TRANSFER','EDC'),
  transaksi_id INT,
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE user (
  id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30),
  password VARCHAR(35),
  nama VARCHAR(50),
  alamat VARCHAR(150),
  hp VARCHAR(20),
  level TINYINT(1)
);

-- Input Isi Tabel

-- Data Master
INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin',  MD5('admin123'),  'Administrator', 'Surabaya', '081200000001', 1),
('kasir1', MD5('kasir123'),  'Kasir Satu',    'Surabaya', '081200000002', 2),
('kasir2', MD5('kasir123'),  'Kasir Dua',     'Surabaya', '081200000003', 2),
('gudang', MD5('gudang123'), 'Staf Gudang',   'Surabaya', '081200000004', 3),
('owner',  MD5('owner123'),  'Pemilik Toko',  'Surabaya', '081200000005', 1);

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Pangan',   '031555001', 'Surabaya'),
('CV Makmur Jaya',     '031555002', 'Surabaya'),
('UD Berkah Abadi',    '031555003', 'Surabaya'),
('PT Nusantara Segar', '031555004', 'Surabaya'),
('CV Sinar Harapan',   '031555005', 'Surabaya');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras 5 kg',        65000,  50, 1),
('BRG002', 'Minyak Goreng 2 L', 38000,  40, 1),
('BRG003', 'Gula Pasir 1 kg',   16000, 100, 2),
('BRG004', 'Telur Ayam 1 kg',   28000,  60, 2),
('BRG005', 'Mie Instan 1 Dus', 115000,  30, 3),
('BRG006', 'Sabun Mandi',        4500, 200, 4),
('BRG007', 'Deterjen 1 kg',     22000,  80, 5);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Budi Santoso',   'L', '081234560001', 'Surabaya'),
('PLG002', 'Siti Aminah',    'P', '081234560002', 'Surabaya'),
('PLG003', 'Agus Pratama',   'L', '081234560003', 'Surabaya'),
('PLG004', 'Dewi Lestari',   'P', '081234560004', 'Surabaya'),
('PLG005', 'Rina Wulandari', 'P', '081234560005', 'Surabaya');

-- Data Transaksi
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Belanja bulanan',        178000, 'PLG001'),
('2026-10-03', 'Kebutuhan dapur',         94000, 'PLG002'),
('2026-10-05', 'Stok warung',            115000, 'PLG003'),
('2026-10-08', 'Belanja mingguan',        77000, 'PLG004'),
('2026-10-10', 'Belanja bulanan',        169000, 'PLG005'),
('2026-10-12', 'Pembelian gula',          80000, 'PLG001'),
('2026-10-15', 'Stok toko kelontong',    248000, 'PLG002'),
('2026-10-18', 'Pembelian minyak',       114000, 'PLG003'),
('2026-10-21', 'Kebutuhan rumah tangga', 149000, 'PLG004'),
('2026-10-25', 'Belanja akhir bulan',    158000, 'PLG005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1,1,65000,2),(1,3,16000,3),
(2,2,38000,1),(2,4,28000,2),
(3,5,115000,1),
(4,6,4500,10),(4,3,16000,2),
(5,1,65000,1),(5,2,38000,2),(5,4,28000,1),
(6,3,16000,5),
(7,5,115000,2),(7,6,4500,4),
(8,2,38000,3),
(9,4,28000,3),(9,1,65000,1),
(10,6,4500,6),(10,5,115000,1),(10,3,16000,1);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:00:00', 178000, 'TUNAI',    1),
('2026-10-03 11:00:00',  94000, 'TRANSFER', 2),
('2026-10-05 09:30:00', 115000, 'EDC',      3),
('2026-10-08 14:00:00',  77000, 'TUNAI',    4),
('2026-10-10 13:15:00', 169000, 'TRANSFER', 5),
('2026-10-12 16:00:00',  80000, 'TUNAI',    6),
('2026-10-15 10:45:00', 248000, 'EDC',      7),
('2026-10-18 15:20:00', 114000, 'TRANSFER', 8),
('2026-10-21 12:00:00', 149000, 'TUNAI',    9),
('2026-10-25 17:00:00', 158000, 'EDC',     10);