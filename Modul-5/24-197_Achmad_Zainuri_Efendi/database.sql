CREATE DATABASE IF NOT EXISTS db_zainuri_197;
USE db_zainuri_197;

-- 1. Table Pelanggan[cite: 1]
CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);

-- 2. Table Supplier[cite: 1, 2]
CREATE TABLE supplier (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    telp VARCHAR(12),
    alamat TEXT
);

-- 3. Table User[cite: 1, 2]
CREATE TABLE user (
    id_user TINYINT(2) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(35),
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
);

-- 4. Table Barang[cite: 1, 2]
CREATE TABLE barang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10),
    nama_barang VARCHAR(100),
    harga INT(11),
    stok INT(11),
    supplier_id INT(11),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE CASCADE
);

-- 5. Table Transaksi[cite: 1]
CREATE TABLE transaksi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE,
    keterangan TEXT,
    total INT(11),
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE CASCADE
);

-- 6. Table Transaksi Detail (Composite Key)[cite: 1, 2]
CREATE TABLE transaksi_detail (
    transaksi_id INT(11),
    barang_id INT(11),
    harga INT(11),
    qty INT(11),
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE
);

-- 7. Table Pembayaran[cite: 1, 3]
CREATE TABLE pembayaran (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME,
    total INT(11),
    metode ENUM('TUNAI', 'TRANSFER', 'EDC'),
    transaksi_id INT(11),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE
);

-- INSERT 10 DATA DUMMY
INSERT INTO pelanggan VALUES 
('P001', 'Achmad Zainuri Efendi', 'L', '081111', 'Bangkalan'),
('P002', 'Aisyah Salsabilah', 'P', '082222', 'Surabaya'),
('P003', 'Ani Nur Kumalasari', 'P', '083333', 'Sidoarjo'),
('P004', 'Adam', 'L', '084444', 'Gresik'),
('P005', 'M. Hendrik Purwanto', 'L', '085555', 'Bangkalan'),
('P006', 'Rafli Khiyanuran', 'L', '086666', 'Bangkalan'),
('P007', 'Budi Santoso', 'L', '087777', 'Malang'),
('P008', 'Siti Aminah', 'P', '088888', 'Surabaya'),
('P009', 'Joko Widodo', 'L', '089999', 'Solo'),
('P010', 'Sri Mulyani', 'P', '081010', 'Jakarta');

INSERT INTO supplier (nama, telp, alamat) VALUES 
('PT. Maju Bersama', '08123456', 'Surabaya'),
('PT. Senang Sekali', '081515563', 'Bangkalan'),
('PT. Segar Segar', '0845454663', 'Surabaya'),
('CV. Elektronik Kuat', '08123123', 'Sidoarjo'),
('PT. TrackFlow ID', '08998877', 'Jakarta'),
('UD. Berkah Jaya', '08112233', 'Malang'),
('PT. Sentosa', '08223344', 'Gresik'),
('CV. Makmur', '08334455', 'Bangkalan'),
('PT. Karya Bangsa', '08445566', 'Surabaya'),
('UD. Rejeki Nomplok', '08556677', 'Mojokerto');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES 
('zainuri197', 'md5pass1', 'Achmad Zainuri', 'Bangkalan', '08111', 1),
('admin2', 'md5pass2', 'Admin Dua', 'Surabaya', '08222', 1),
('kasir1', 'md5pass3', 'Kasir Satu', 'Sidoarjo', '08333', 2),
('kasir2', 'md5pass4', 'Kasir Dua', 'Gresik', '08444', 2),
('gudang1', 'md5pass5', 'Orang Gudang', 'Malang', '08555', 3),
('gudang2', 'md5pass6', 'Gudang Dua', 'Surabaya', '08666', 3),
('manager1', 'md5pass7', 'Manager Ops', 'Jakarta', '08777', 4),
('manager2', 'md5pass8', 'Manager Keu', 'Bandung', '08888', 4),
('audit1', 'md5pass9', 'Auditor 1', 'Bali', '08999', 5),
('audit2', 'md5pass10', 'Auditor 2', 'Lombok', '08101', 5);

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES 
('BRG01', 'Laptop Lenovo', 8000000, 10, 1),
('BRG02', 'Mouse Wireless', 150000, 50, 2),
('BRG03', 'Keyboard Mekanik', 450000, 30, 3),
('BRG04', 'Monitor IPS', 2000000, 15, 4),
('BRG05', 'Kabel LAN', 50000, 100, 5),
('BRG06', 'Router Cisco', 1500000, 20, 6),
('BRG07', 'Flashdisk 64GB', 80000, 40, 7),
('BRG08', 'RAM 16GB', 600000, 25, 8),
('BRG09', 'SSD 512GB', 750000, 35, 9),
('BRG10', 'Webcam 1080p', 350000, 12, 10);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES 
('2026-11-01', 'Pembelian Laptop', 8000000, 'P001'),
('2026-11-02', 'Beli Aksesoris', 600000, 'P002'),
('2026-11-03', 'Upgrade PC', 1350000, 'P003'),
('2026-11-04', 'Keperluan Kantor', 2000000, 'P004'),
('2026-11-05', 'Jaringan', 1550000, 'P005'),
('2026-11-06', 'Penyimpanan', 830000, 'P006'),
('2026-11-07', 'Komponen', 600000, 'P007'),
('2026-11-08', 'Lainnya', 350000, 'P008'),
('2026-11-09', 'Lainnya', 150000, 'P009'),
('2026-11-10', 'Lainnya', 450000, 'P010');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES 
(1, 1, 8000000, 1),
(2, 2, 150000, 1),
(2, 3, 450000, 1),
(3, 8, 600000, 1),
(3, 9, 750000, 1),
(4, 4, 2000000, 1),
(5, 5, 50000, 1),
(5, 6, 1500000, 1),
(6, 7, 80000, 1),
(6, 9, 750000, 1);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES 
('2026-11-01 10:00:00', 8000000, 'TRANSFER', 1),
('2026-11-02 11:30:00', 600000, 'TUNAI', 2),
('2026-11-03 14:15:00', 1350000, 'EDC', 3),
('2026-11-04 09:20:00', 2000000, 'TRANSFER', 4),
('2026-11-05 16:45:00', 1550000, 'TUNAI', 5),
('2026-11-06 13:10:00', 830000, 'EDC', 6),
('2026-11-07 10:05:00', 600000, 'TRANSFER', 7),
('2026-11-08 12:00:00', 350000, 'TUNAI', 8),
('2026-11-09 15:30:00', 150000, 'EDC', 9),
('2026-11-10 08:45:00', 450000, 'TRANSFER', 10);
