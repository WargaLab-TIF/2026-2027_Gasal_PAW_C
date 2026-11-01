CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;

DROP TABLE IF EXISTS pembayaran;
DROP TABLE IF EXISTS transaksi_detail;
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS pelanggan;
DROP TABLE IF EXISTS user;

CREATE TABLE supplier (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE barang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT(11) NOT NULL,
    stok INT(11) NOT NULL,
    supplier_id INT(11),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE pelanggan (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE transaksi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT(11) NOT NULL DEFAULT 0,
    pelanggan_id INT(11),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE transaksi_detail (
    transaksi_id INT(11),
    barang_id INT(11),
    harga INT(11) NOT NULL,
    qty INT(11) NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pembayaran (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT(11) NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT(11),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE user (
    id_user TINYINT(2) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL
);

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama', '08123456', 'Surabaya'),
('PT. Senang Sekali', '081515563', 'Bangkalan'),
('PT. Segar Segar', '0845454663', 'Surabaya'),
('CV. Elektronik Jaya', '0812998877', 'Jakarta'),
('UD. Sumber Pangan', '0856112233', 'Malang'),
('PT. Global Tech', '0813445566', 'Bandung'),
('CV. Gemilang Abadi', '0878556677', 'Sidoarjo'),
('PT. Makmur Sentosa', '0899001122', 'Semarang'),
('UD. Berkah Selalu', '0821334455', 'Gresik'),
('PT. Indofood Jaya', '0811223344', 'Bekasi');

-- Data Barang
INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Laptop Asus Vivobook', 8500000, 15, 4),
('BRG002', 'Mouse Logitech Wireless', 150000, 50, 4),
('BRG003', 'Keyboard Mechanical', 450000, 20, 6),
('BRG004', 'Monitor Samsung 24 Inch', 1800000, 10, 6),
('BRG005', 'Beras Premium 5kg', 75000, 100, 5),
('BRG006', 'Minyak Goreng 2L', 38000, 80, 5),
('BRG007', 'Kopi Bubuk 250gr', 25000, 120, 9),
('BRG008', 'Gula Pasir 1kg', 16000, 150, 9),
('BRG009', 'Mie Instan Dus', 115000, 40, 10),
('BRG010', 'Susu UHT 1L', 18000, 60, 10);

-- Data Pelanggan
INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES
('Ahmad Fauzi', 'L', '081234567801', 'Surabaya'),
('Siti Aminah', 'P', '081234567802', 'Bangkalan'),
('Budi Santoso', 'L', '081234567803', 'Sidoarjo'),
('Dewi Lestari', 'P', '081234567804', 'Malang'),
('Eko Prasetyo', 'L', '081234567805', 'Gresik'),
('Fitriani', 'P', '081234567806', 'Bandung'),
('Guntur Wibowo', 'L', '081234567807', 'Jakarta'),
('Hesti Purwanti', 'P', '081234567808', 'Semarang'),
('Iwan Fals', 'L', '081234567809', 'Yogyakarta'),
('Joko Widodo', 'L', '081234567810', 'Solo');

-- Data Transaksi
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Pembelian peralatan kantor', 8650000, 1),
('2026-10-02', 'Belanja bulanan sembako', 150000, 2),
('2026-10-03', 'Pembelian komponen PC', 450000, 3),
('2026-10-04', 'Pembelian monitor', 1800000, 4),
('2026-10-05', 'Restock dapur', 113000, 5),
('2026-10-06', 'Pembelian laptop operasional', 8500000, 6),
('2026-10-07', 'Belanja rutin', 54000, 7),
('2026-10-08', 'Kebutuhan konsumsi event', 230000, 8),
('2026-10-09', 'Pembelian mouse dan keyboard', 600000, 9),
('2026-10-10', 'Pembelian sembako lengkap', 201000, 10);

-- Data Transaksi Detail
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 8500000, 1),
(1, 2, 150000, 1),
(2, 5, 75000, 2),
(3, 3, 450000, 1),
(4, 4, 1800000, 1),
(5, 6, 38000, 2),
(5, 7, 25000, 1),
(6, 1, 8500000, 1),
(7, 8, 16000, 1),
(7, 10, 18000, 2),
(8, 9, 115000, 2),
(9, 2, 150000, 1),
(9, 3, 450000, 1),
(10, 5, 75000, 1),
(10, 6, 38000, 2),
(10, 10, 18000, 2);

-- Data Pembayaran
INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:00:00', 8650000, 'TRANSFER', 1),
('2026-10-02 11:30:00', 150000, 'TUNAI', 2),
('2026-10-03 14:15:00', 450000, 'EDC', 3),
('2026-10-04 09:00:00', 1800000, 'TRANSFER', 4),
('2026-10-05 16:45:00', 113000, 'TUNAI', 5),
('2026-10-06 13:00:00', 8500000, 'TRANSFER', 6),
('2026-10-07 10:20:00', 54000, 'TUNAI', 7),
('2026-10-08 11:00:00', 230000, 'EDC', 8),
('2026-10-09 15:30:00', 600000, 'TRANSFER', 9),
('2026-10-10 17:00:00', 201000, 'TUNAI', 10);

-- Data User
INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator Utama', 'Surabaya', '0811111111', 1),
('manager', MD5('mgr456'), 'Hendra Wijaya', 'Bangkalan', '0822222222', 2),
('kasir1', MD5('kasir789'), 'Rina Amelia', 'Sidoarjo', '0833333333', 3),
('kasir2', MD5('kasirabc'), 'Diki Wahyudi', 'Gresik', '0844444444', 3),
('staff1', MD5('staff1'), 'Bambang', 'Malang', '0855555555', 3),
('staff2', MD5('staff2'), 'Susi', 'Surabaya', '0866666666', 3),
('user7', MD5('pwd7'), 'Andi', 'Bandung', '0877777777', 3),
('user8', MD5('pwd8'), 'Rani', 'Jakarta', '0888888888', 3),
('user9', MD5('pwd9'), 'Dodi', 'Semarang', '0899999999', 3),
('user10', MD5('pwd10'), 'Toni', 'Yogyakarta', '0810101010', 3);