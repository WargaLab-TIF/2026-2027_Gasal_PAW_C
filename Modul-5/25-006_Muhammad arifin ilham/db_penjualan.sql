CREATE DATABASE DB_PENJUALAN;
USE DB_PENJUALAN;

-- Tabel user
CREATE TABLE `user` (
    id_user TINYINT(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(30),
    password VARCHAR(35),
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
);

-- Tabel supplier
CREATE TABLE supplier (
    id INT(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nama VARCHAR(100),
    telp VARCHAR(12),
    alamat TEXT
);

-- Tabel barang
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    kode_barang VARCHAR(10),
    nama_barang VARCHAR(100),
    harga INT(11),
    stok INT(11),
    supplier_id INT(11),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Tabel pelanggan 
CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY NOT NULL,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);

-- Tabel transaksi 
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    waktu_transaksi DATE,
    keterangan TEXT,
    total INT(11),
    pelanggan_id VARCHAR(20), 
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Tabel transaksi_detail
CREATE TABLE transaksi_detail (
    transaksi_id INT(11) NOT NULL,
    barang_id INT(11) NOT NULL,
    harga INT(11),
    qty INT(11),
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel pembayaran
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    waktu_bayar DATETIME,
    total INT(11),
    metode ENUM('TUNAI', 'TRANSFER', 'EDC'),
    transaksi_id INT(11),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- Insert User (10 data)
INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES
('admin', 'admin123', 'Administrator', 'Jl. Pusat No. 1', '0811111111', 1),
('kasir1', 'kasir123', 'Budi Santoso', 'Jl. Mawar No. 2', '0822222222', 2),
('kasir2', 'kasir123', 'Siti Aminah', 'Jl. Melati No. 3', '0833333333', 2),
('gudang1', 'gudang123', 'Agus Setiawan', 'Jl. Kenanga No. 4', '0844444444', 3),
('manager', 'manajer123', 'Dewi Lestari', 'Jl. Anggrek No. 5', '0855555555', 1),
('user6', 'pass6', 'Rudi Hermawan', 'Jl. Kamboja No. 6', '0866666666', 2),
('user7', 'pass7', 'Rina Wati', 'Jl. Flamboyan No. 7', '0877777777', 2),
('user8', 'pass8', 'Joko Susilo', 'Jl. Cempaka No. 8', '0888888888', 3),
('user9', 'pass9', 'Ani Yuliana', 'Jl. Dahlia No. 9', '0899999999', 2),
('user10', 'pass10', 'Eko Prasetyo', 'Jl. Teratai No. 10', '0812121212', 3);

-- Insert Supplier (10 data)
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama', '08123456', 'Surabaya'),
('PT. Senang Sekali', '081515563', 'Bangkalan'),
('PT. Segar Segar', '0845454663', 'Surabaya'),
('CV. Sumber Makmur', '0817778888', 'Sidoarjo'),
('UD. Berkah Jaya', '0821112222', 'Gresik'),
('PT. Indo Makmur', '0833334444', 'Jakarta'),
('CV. Tunas Baru', '0845556666', 'Bandung'),
('PT. Sinar Terang', '0857778888', 'Semarang'),
('UD. Karya Abadi', '0869990000', 'Yogyakarta'),
('PT. Pangan Sejahtera', '0871231234', 'Malang');

-- Insert Barang 
INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras Premium 5kg', 65000, 50, 1),
('BRG002', 'Minyak Goreng 2L', 35000, 100, 2),
('BRG003', 'Gula Pasir 1kg', 15000, 80, 3),
('BRG004', 'Telur Ayam 1kg', 28000, 60, 1),
('BRG005', 'Tepung Terigu 1kg', 12000, 40, 4),
('BRG006', 'Kecap Manis 500ml', 18000, 75, 5),
('BRG007', 'Sabun Mandi Cair', 25000, 120, 6),
('BRG008', 'Sampo Anti Ketombe', 45000, 30, 7),
('BRG009', 'Pasta Gigi 150g', 16000, 90, 8),
('BRG010', 'Detergen Bubuk 1kg', 22000, 65, 9);

-- Insert Pelanggan 
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P001', 'Andi Wijaya', 'L', '0811111111', 'Jl. Merdeka No. 1'),
('P002', 'Bunga Citra', 'P', '0822222222', 'Jl. Sudirman No. 2'),
('P003', 'Candra Kirana', 'L', '0833333333', 'Jl. Thamrin No. 3'),
('P004', 'Diana Putri', 'P', '0844444444', 'Jl. Gatot Subroto No. 4'),
('P005', 'Eko Prasetyo', 'L', '0855555555', 'Jl. Ahmad Yani No. 5'),
('P006', 'Fitri Handayani', 'P', '0866666666', 'Jl. Diponegoro No. 6'),
('P007', 'Gilang Ramadhan', 'L', '0877777777', 'Jl. Pahlawan No. 7'),
('P008', 'Hesti Purwadinata', 'P', '0888888888', 'Jl. Pemuda No. 8'),
('P009', 'Indra Herlambang', 'L', '0899999999', 'Jl. Veteran No. 9'),
('P010', 'Julia Perez', 'P', '0810101010', 'Jl. Kartini No. 10');

-- Insert Transaksi
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2023-10-01', 'Pembelian Rutin', 130000, 'P001'),
('2023-10-02', 'Pembelian Grosir', 70000, 'P002'),
('2023-10-03', 'Belanja Harian', 45000, 'P003'),
('2023-10-04', 'Belanja Bulanan', 200000, 'P004'),
('2023-10-05', 'Pembelian Toko', 56000, 'P005'),
('2023-10-06', 'Belanja Harian', 36000, 'P006'),
('2023-10-07', 'Pembelian Snack', 75000, 'P007'),
('2023-10-08', 'Belanja Mingguan', 150000, 'P008'),
('2023-10-09', 'Pembelian Kebutuhan', 50000, 'P009'),
('2023-10-10', 'Belanja Akhir Pekan', 225000, 'P010');

-- Insert Transaksi Detail (10 data)
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 65000, 2),
(2, 2, 35000, 2),
(3, 3, 15000, 3),
(4, 4, 28000, 5),
(5, 5, 12000, 1),
(6, 6, 18000, 2),
(7, 7, 25000, 3),
(8, 8, 45000, 2),
(9, 9, 16000, 1),
(10, 10, 22000, 5);

-- Insert Pembayaran (10 data)
INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2023-10-01 10:00:00', 130000, 'TUNAI', 1),
('2023-10-02 11:30:00', 70000, 'TRANSFER', 2),
('2023-10-03 09:15:00', 45000, 'EDC', 3),
('2023-10-04 14:00:00', 200000, 'TRANSFER', 4),
('2023-10-05 16:45:00', 56000, 'TUNAI', 5),
('2023-10-06 08:30:00', 36000, 'TUNAI', 6),
('2023-10-07 13:20:00', 75000, 'EDC', 7),
('2023-10-08 15:10:00', 150000, 'TRANSFER', 8),
('2023-10-09 12:00:00', 50000, 'TUNAI', 9),
('2023-10-10 17:30:00', 225000, 'EDC', 10);
