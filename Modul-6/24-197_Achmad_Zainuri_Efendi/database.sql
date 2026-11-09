CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;


CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L','P'),
    telp VARCHAR(12),
    alamat TEXT
);

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
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE RESTRICT
);

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE,
    keterangan TEXT,
    total INT DEFAULT 0,
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT,
    barang_id INT,
    harga INT,
    qty INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
);

CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME,
    total INT,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC'),
    transaksi_id INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE user (
    id_user TINYINT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30),
    password VARCHAR(35),
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
);

DELIMITER $$
CREATE TRIGGER trg_update_total_transaksi
AFTER INSERT ON transaksi_detail
FOR EACH ROW
BEGIN
    UPDATE transaksi 
    SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = NEW.transaksi_id)
    WHERE id = NEW.transaksi_id;
END$$
DELIMITER ;

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG01', 'Ahmad Rizal', 'L', '081111111', 'Surabaya'),
('PLG02', 'Siti Nurhaliza', 'P', '082222222', 'Bangkalan'),
('PLG03', 'Budi Santoso', 'L', '083333333', 'Pamekasan'),
('PLG04', 'Dina Mariana', 'P', '084444444', 'Sampang'),
('PLG05', 'Eko Prasetyo', 'L', '085555555', 'Sumenep');

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Jaya', '0311234', 'Sidoarjo'),
('CV. Makmur Abadi', '0315678', 'Surabaya'),
('Toko Sinar Mas', '0319012', 'Gresik'),
('UD. Berkah', '0313456', 'Mojokerto'),
('PT. Teknologi Kuat', '0317890', 'Malang');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG01', 'Mouse Logitech', 150000, 50, 1),
('BRG02', 'Keyboard Mechanical', 450000, 30, 2),
('BRG03', 'Flashdisk 32GB', 75000, 100, 3),
('BRG04', 'Monitor 24 Inch', 1500000, 15, 4),
('BRG05', 'Kabel HDMI', 35000, 80, 5);

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', 'admin123', 'Administrator', 'Lab Kampus', '0899999', 1),
('kasir1', 'kasir123', 'Petugas Kasir 1', 'Burneh', '0888888', 2),
('kasir2', 'kasir123', 'Petugas Kasir 2', 'Bangkalan', '0877777', 2),
('manager', 'man123', 'Manager Toko', 'Surabaya', '0866666', 3),
('gudang', 'gudang123', 'Staf Gudang', 'Telang', '0855555', 4);

INSERT INTO transaksi (waktu_transaksi, keterangan, pelanggan_id) VALUES
('2026-11-01', 'Pembelian Rutin', 'PLG01'),
('2026-11-02', 'Proyek Kantor', 'PLG02'),
('2026-11-03', 'Grosir', 'PLG03'),
('2026-11-04', 'Toko Cabang', 'PLG04'),
('2026-11-05', 'Pribadi', 'PLG05');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 150000, 2),  -- Transaksi 1 beli Mouse (2pcs)
(1, 3, 75000, 1),   -- Transaksi 1 beli Flashdisk (1pcs)
(2, 2, 450000, 5),  -- Transaksi 2 beli Keyboard (5pcs)
(2, 4, 1500000, 2), -- Transaksi 2 beli Monitor (2pcs)
(3, 5, 35000, 10),  -- Transaksi 3 beli Kabel (10pcs)
(3, 1, 150000, 5),  -- Transaksi 3 beli Mouse (5pcs)
(4, 2, 450000, 1),  -- Transaksi 4 beli Keyboard (1pcs)
(4, 3, 75000, 3),   -- Transaksi 4 beli Flashdisk (3pcs)
(5, 4, 1500000, 1), -- Transaksi 5 beli Monitor (1pcs)
(5, 5, 35000, 2);   -- Transaksi 5 beli Kabel (2pcs)
