CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;

-- 1. Tabel supplier
CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;

-- 2. Tabel pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;

-- 3. Tabel user
CREATE TABLE IF NOT EXISTS user (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB;

-- 4. Tabel barang
CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT,
    CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

-- 5. Tabel transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT NOT NULL,
    pelanggan_id VARCHAR(20),
    CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

-- 6. Tabel transaksi_detail
CREATE TABLE IF NOT EXISTS transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id) REFERENCES barang(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

-- 7. Tabel pembayaran
CREATE TABLE IF NOT EXISTS pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT NOT NULL,
    CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT Sumber Makmur Jaya', '081234567890', 'Jl. Raya Telang No. 12, Bangkalan'),
(2, 'CV Nusantara Elektronik', '081987654321', 'Jl. Ahmad Yani No. 45, Surabaya');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Keyboard Mechanical RGB', 350000, 25, 2),
(2, 'BRG002', 'Mouse Wireless Silent', 150000, 40, 2),
(3, 'BRG003', 'Flashdisk 64GB USB 3.0', 95000, 60, 1),
(4, 'BRG004', 'Headset Gaming Stereo', 275000, 15, 2);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Budi Santoso', 'L', '085611112222', 'Jl. Pemuda No. 5, Bangkalan'),
('PLG002', 'Siti Aminah', 'P', '085633334444', 'Jl. Trunojoyo No. 18, Bangkalan'),
('PLG003', 'Rizky Pratama', 'L', '085655556666', 'Jl. Soekarno Hatta No. 9, Bangkalan'),
('PLG004', 'Dewi Lestari', 'P', '085677778888', 'Jl. Halim Perdanakusuma No. 21, Bangkalan');

INSERT INTO user (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'admin', MD5('admin123'), 'Administrator', 'Bangkalan', '081200001111', 1);

-- 6 Transaksi dari 4 Pelanggan Unik (PLG001 & PLG002 bertransaksi lebih dari sekali)
INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-11-01', 'Pembelian perlengkapan kerja', 500000, 'PLG001'),
(2, '2026-11-01', 'Pembelian aksesoris komputer', 190000, 'PLG002'),
(3, '2026-11-02', 'Pembelian headset dan mouse', 425000, 'PLG003'),
(4, '2026-11-03', 'Repeat order keyboard', 350000, 'PLG001'),
(5, '2026-11-04', 'Pembelian flashdisk', 285000, 'PLG004'),
(6, '2026-11-05', 'Repeat order headset', 550000, 'PLG002');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 350000, 1),
(1, 2, 150000, 1),
(2, 3, 95000, 2),
(3, 4, 275000, 1),
(3, 2, 150000, 1),
(4, 1, 350000, 1),
(5, 3, 95000, 3),
(6, 4, 275000, 2);

INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1, '2026-11-01 09:15:00', 500000, 'TUNAI', 1),
(2, '2026-11-01 14:20:00', 190000, 'TRANSFER', 2),
(3, '2026-11-02 11:05:00', 425000, 'EDC', 3),
(4, '2026-11-03 16:40:00', 350000, 'TUNAI', 4),
(5, '2026-11-04 10:10:00', 285000, 'TRANSFER', 5),
(6, '2026-11-05 13:50:00', 550000, 'TUNAI', 6);