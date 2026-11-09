CREATE DATABASE IF NOT EXISTS db_penjualan;
USE db_penjualan;

CREATE TABLE IF NOT EXISTS pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE IF NOT EXISTS `user` (
    id_user TINYINT(2) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
);

CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT NOT NULL,
    CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id) REFERENCES supplier(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT NOT NULL DEFAULT 0,
    pelanggan_id VARCHAR(20) NOT NULL,
    CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id) REFERENCES barang(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC'),
    transaksi_id INT NOT NULL,
    CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Bunga Makmur', '085200000001', 'Bangkalan'),
('PT Jalan Jaya', '085200000002', 'Surabaya'),
('PT Mamer', '085200000003', 'Pamekasan'),
('PT Semen Demo', '085200000004', 'Sampang'),
('PT Main Main', '085200000005', 'Sumenep');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P01', 'Adi', 'L', '08130000101', 'Bangkalan'),
('P02', 'Budi', 'L', '08130000102', 'Surabaya'),
('P03', 'Caca', 'P', '08130000103', 'Pamekasan'),
('P04', 'Dedi', 'L', '08130000104', 'Sampang'),
('P05', 'Erlang', 'L', '08130000105', 'Sumenep');


INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES
('feri', 'demo123', 'Feri', 'Bangkalan', '08210000101', 1),
('gery', 'demo123', 'Gery', 'Surabaya', '08210000102', 1),
('henry', 'demo123', 'Henry', 'Pamekasan', '08210000103', 2),
('intan', 'demo123', 'Intan', 'Sampang', '08210000104', 2),
('jery', 'demo123', 'Jery', 'Sumenep', '08210000105', 2);

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('B001', 'Keyboard USB', 25000, 100, 1),
('B002', 'Mouse Wireless', 35000, 100, 2),
('B003', 'Headset', 150000, 50, 3),
('B004', 'Flashdisk 32GB', 125000, 60, 4),
('B005', 'Kabel USB', 45000, 80, 5),
('B006', 'Stand Laptop Demo', 85000, 25, 1);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Transaksi Beli Barang 1', 0, 'P01'),
('2026-10-02', 'Transaksi Beli Barang 2', 0, 'P02'),
('2026-10-03', 'Transaksi Beli Barang 3', 0, 'P03'),
('2026-10-04', 'Transaksi Beli Barang 4', 0, 'P04'),
('2026-10-05', 'Transaksi Beli Barang 5', 0, 'P05'),
('2026-10-06', 'Transaksi Beli Barang 6', 0, 'P01'),
('2026-10-07', 'Transaksi Beli Barang 7', 0, 'P02'),
('2026-10-08', 'Transaksi Beli Barang 8', 0, 'P03'),
('2026-10-09', 'Transaksi Beli Barang 9', 0, 'P04'),
('2026-10-10', 'Transaksi Beli Barang 10', 0, 'P05');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 25000, 2),
(2, 2, 35000, 1),
(3, 3, 150000, 1),
(4, 4, 125000, 2),
(5, 5, 45000, 1),
(6, 1, 25000, 1),
(7, 2, 35000, 2),
(8, 3, 150000, 1),
(9, 4, 125000, 1),
(10, 5, 45000, 3);

UPDATE transaksi
SET total = (
    SELECT COALESCE(SUM(td.harga * td.qty), 0)
    FROM transaksi_detail td
    WHERE td.transaksi_id = transaksi.id
)
WHERE id BETWEEN 1 AND 10;

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:00:00', 50000, 'TUNAI', 1),
('2026-10-02 10:00:00', 35000, 'TRANSFER', 2),
('2026-10-03 10:00:00', 150000, 'EDC', 3),
('2026-10-04 10:00:00', 250000, 'TUNAI', 4),
('2026-10-05 10:00:00', 45000, 'TRANSFER', 5),
('2026-10-06 10:00:00', 25000, 'EDC', 6),
('2026-10-07 10:00:00', 70000, 'TUNAI', 7),
('2026-10-08 10:00:00', 150000, 'TRANSFER', 8),
('2026-10-09 10:00:00', 125000, 'EDC', 9),
('2026-10-10 10:00:00', 135000, 'TUNAI', 10);

SELECT 'supplier' AS tabel, COUNT(*) AS jumlah FROM supplier
UNION ALL SELECT 'pelanggan', COUNT(*) FROM pelanggan
UNION ALL SELECT 'user', COUNT(*) FROM `user`
UNION ALL SELECT 'barang', COUNT(*) FROM barang
UNION ALL SELECT 'transaksi', COUNT(*) FROM transaksi
UNION ALL SELECT 'transaksi_detail', COUNT(*) FROM transaksi_detail
UNION ALL SELECT 'pembayaran', COUNT(*) FROM pembayaran;