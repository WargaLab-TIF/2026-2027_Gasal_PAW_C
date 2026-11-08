CREATE DATABASE db_penjualan_06;
USE db_penjualan_06;

-- 1. Tabel Supplier
CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

-- 2. Tabel Barang
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) UNIQUE NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE RESTRICT
);

-- 3. Tabel Pelanggan
CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P'),
    telp VARCHAR(12),
    alamat TEXT
);

-- 4. Tabel User
CREATE TABLE user (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
);

-- 5. Tabel Transaksi (Master)
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT DEFAULT 0,
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT
);

-- 6. Tabel Transaksi Detail (Detail)
CREATE TABLE transaksi_detail (
    transaksi_id INT,
    barang_id INT,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
);

-- 7. Tabel Pembayaran
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
    transaksi_id INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE
);

-- Insert Supplier (5 data)
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Makmur', '0315551234', 'Jl. Rajawali No. 10, Surabaya'),
('CV Jaya Elektronik', '0315555678', 'Jl. Tunjungan No. 45, Surabaya'),
('UD Berkah Jaya', '0315559012', 'Jl. Kamal Raya No. 12, Bangkalan'),
('PT Mitra Abadi', '0215553456', 'Jl. Sudirman No. 88, Jakarta'),
('CV Sejahtera Mandiri', '0315557890', 'Jl. Kembang Jepun No. 22, Surabaya');

-- Insert Barang (6 data; BRG006 sengaja belum dipakai di transaksi agar fitur hapus bisa didemokan)
INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Laptop ASUS Vivobook', 7500000, 15, 1),
('BRG002', 'Mouse Wireless Logitech', 150000, 40, 2),
('BRG003', 'Keyboard Mechanical', 450000, 25, 2),
('BRG004', 'Monitor LG 24 Inch', 1850000, 10, 3),
('BRG005', 'Flashdisk SanDisk 64GB', 95000, 50, 4),
('BRG006', 'Headset Gaming Rexus', 275000, 30, 5);

-- Insert Pelanggan (5 data)
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Ahmad Fauzi', 'L', '081234567890', 'Jl. Telang Indah No. 5, Bangkalan'),
('PLG002', 'Siti Aminah', 'P', '081345678901', 'Jl. Demangan No. 14, Bangkalan'),
('PLG003', 'Budi Santoso', 'L', '081567890123', 'Jl. Kamal Asri No. 8, Madura'),
('PLG004', 'Dewi Lestari', 'P', '081789012345', 'Jl. Trunojoyo No. 20, Bangkalan'),
('PLG005', 'Eko Prasetyo', 'L', '081901234567', 'Jl. Raya Socah No. 3, Bangkalan');

-- Insert User (5 data)
INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator', 'Surabaya', '081111222233', 1),
('kasir1', MD5('kasir123'), 'Rina Marlina', 'Bangkalan', '081222333444', 2),
('kasir2', MD5('kasir123'), 'Joko Anwar', 'Bangkalan', '081333444555', 2),
('gudang1', MD5('gudang123'), 'Doni Setiawan', 'Kamal', '081444555666', 3),
('owner', MD5('owner123'), 'H. Mahmud', 'Surabaya', '081555666777', 1);

-- Insert Transaksi (10 data master transaksi)
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Penjualan reguler toko', 7650000, 'PLG001'),
('2026-10-02', 'Pembelian aksesoris komputer', 600000, 'PLG002'),
('2026-10-03', 'Keperluan kantor kampus', 1850000, 'PLG003'),
('2026-10-04', 'Grosir flashdisk', 475000, 'PLG004'),
('2026-10-05', 'Promo weekend', 7500000, 'PLG005'),
('2026-10-06', 'Pembelian satuan', 150000, 'PLG001'),
('2026-10-07', 'Keperluan lab', 2325000, 'PLG002'),
('2026-10-08', 'Upgrade perangkat', 1875000, 'PLG003'),
('2026-10-09', 'Pesanan khusus', 1850000, 'PLG004'),
('2026-10-10', 'Transaksi akhir pekan', 450000, 'PLG005');

-- Insert Transaksi Detail (Data detail item untuk transaksi)
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 7500000, 1),
(1, 2, 150000, 1),
(2, 2, 150000, 1),
(2, 3, 450000, 1),
(3, 4, 1850000, 1),
(4, 5, 95000, 5),
(5, 1, 7500000, 1),
(6, 2, 150000, 1),
(7, 4, 1850000, 1),
(7, 5, 95000, 5),
(8, 3, 450000, 1),
(8, 5, 95000, 15),
(9, 4, 1850000, 1),
(10, 3, 450000, 1);