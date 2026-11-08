CREATE DATABASE DB_praktikum;
USE DB_praktikum;

CREATE TABLE supplier (
    id int(11) NOT NULL AUTO_INCREMENT,
    nama varchar(100),
    telp varchar(12),
    alamat text,
    PRIMARY KEY (id)
);

CREATE TABLE pelanggan (
    id varchar(20) NOT NULL,
    nama varchar(100),
    jenis_kelamin enum('L','P'),
    telp varchar(12),
    alamat text,
    PRIMARY KEY (id)
);

CREATE TABLE barang (
    id int(11) NOT NULL AUTO_INCREMENT,
    kode_barang varchar(10),
    nama_barang varchar(100),
    harga int(11),
    stok int(11),
    supplier_id int(11),
    PRIMARY KEY (id),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE transaksi (
    id int(11) NOT NULL AUTO_INCREMENT,
    waktu_transaksi date,
    keterangan text,
    total int(11),
    pelanggan_id varchar(20),
    PRIMARY KEY (id),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE transaksi_detail (
    transaksi_id int(11) NOT NULL,
    barang_id int(11) NOT NULL,
    harga int(11),
    qty int(11),
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE pembayaran (
    id int(11) NOT NULL AUTO_INCREMENT,
    waktu_bayar datetime,
    total int(11),
    metode enum('TUNAI','TRANSFER','EDC'),
    transaksi_id int(11),
    PRIMARY KEY (id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE user (
    id_user tinyint(2) NOT NULL AUTO_INCREMENT,
    username varchar(30),
    password varchar(35),
    nama varchar(50),
    alamat varchar(150),
    hp varchar(20),
    level tinyint(1),
    PRIMARY KEY (id_user)
);

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama', '08123456', 'Surabaya'),
('PT. Senang Sekali', '081515563', 'Bangkalan'),
('PT. Segar Segar', '0845454663', 'Surabaya'),
('CV. Sumber Rejeki', '0812333444', 'Sidoarjo'),
('PT. Aneka Jaya', '0812555666', 'Gresik'),
('UD. Barokah', '0813777888', 'Lamongan'),
('PT. Cahaya Abadi', '0813999000', 'Mojokerto'),
('CV. Tiga Putra', '0821111222', 'Malang'),
('PT. Nusantara Food', '0821333444', 'Pasuruan'),
('UD. Makmur Sentosa', '0821555666', 'Jember');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Ahmad Fauzi', 'L', '081234567001', 'Surabaya'),
('PLG002', 'Siti Aminah', 'P', '081234567002', 'Sidoarjo'),
('PLG003', 'Budi Santoso', 'L', '081234567003', 'Gresik'),
('PLG004', 'Dewi Lestari', 'P', '081234567004', 'Malang'),
('PLG005', 'Rudi Hartono', 'L', '081234567005', 'Surabaya'),
('PLG006', 'Rina Wati', 'P', '081234567006', 'Bangkalan'),
('PLG007', 'Andi Pratama', 'L', '081234567007', 'Mojokerto'),
('PLG008', 'Maya Sari', 'P', '081234567008', 'Jember'),
('PLG009', 'Hendra Wijaya', 'L', '081234567009', 'Pasuruan'),
('PLG010', 'Lina Marlina', 'P', '081234567010', 'Lamongan');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras Premium 5kg', 65000, 50, 1),
('BRG002', 'Minyak Goreng 2L', 34000, 40, 2),
('BRG003', 'Gula Pasir 1kg', 15000, 60, 3),
('BRG004', 'Telur Ayam 1kg', 28000, 45, 1),
('BRG005', 'Mie Instan Goreng', 3500, 200, 4),
('BRG006', 'Kopi Bubuk 250g', 22000, 35, 5),
('BRG007', 'Susu UHT 1L', 19000, 70, 6),
('BRG008', 'Sabun Mandi 100g', 5000, 150, 7),
('BRG009', 'Pasta Gigi 190g', 14000, 80, 8),
('BRG010', 'Teh Celup 25', 8000, 90, 9);

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', 'admin123', 'Administrator', 'Surabaya', '081200000001', 1),
('kasir1', 'kasir123', 'Bagus Setiawan', 'Sidoarjo', '081200000002', 2),
('kasir2', 'kasir123', 'Nur Aini', 'Gresik', '081200000003', 2),
('gudang1', 'gudang123', 'Joko Susilo', 'Malang', '081200000004', 3),
('gudang2', 'gudang123', 'Slamet Riyadi', 'Surabaya', '081200000005', 3),
('manager', 'manager123', 'Ratna Dewi', 'Mojokerto', '081200000006', 1),
('kasir3', 'kasir123', 'Fajar Nugroho', 'Jember', '081200000007', 2),
('kasir4', 'kasir123', 'Indah Permata', 'Pasuruan', '081200000008', 2),
('gudang3', 'gudang123', 'Agus Salim', 'Lamongan', '081200000009', 3),
('admin2', 'admin123', 'Wulan Sari', 'Bangkalan', '081200000010', 1);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Pembelian kebutuhan harian', 379000, 'PLG001'),
('2026-10-02', 'Pembelian bahan masakan', 117000, 'PLG002'),
('2026-10-03', 'Pembelian sembako bulanan', 71000, 'PLG003'),
('2026-10-04', 'Pembelian camilan dan minuman', 59500, 'PLG004'),
('2026-10-05', 'Pembelian kebutuhan dapur', 54500, 'PLG005'),
('2026-10-06', 'Pembelian perlengkapan mandi', 41000, 'PLG006'),
('2026-10-07', 'Pembelian bahan sarapan', 48000, 'PLG007'),
('2026-10-08', 'Pembelian kebutuhan kebersihan', 29000, 'PLG008'),
('2026-10-09', 'Pembelian makanan ringan', 30000, 'PLG009'),
('2026-10-10', 'Pembelian kebutuhan mingguan', 81000, 'PLG010');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 65000, 2),
(1, 2, 34000, 2),
(2, 2, 34000, 3),
(2, 3, 15000, 1),
(3, 3, 15000, 1),
(3, 4, 28000, 2),
(4, 4, 28000, 2),
(4, 5, 3500, 1),
(5, 5, 3500, 3),
(5, 6, 22000, 2),
(6, 6, 22000, 1),
(6, 7, 19000, 1),
(7, 7, 19000, 2),
(7, 8, 5000, 2),
(8, 8, 5000, 3),
(8, 9, 14000, 1),
(9, 9, 14000, 1),
(9, 10, 8000, 2),
(10, 10, 8000, 2),
(10, 1, 65000, 1),
(1, 6, 22000, 3),
(1, 8, 5000, 23);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 11:00:00', 198000, 'TRANSFER', 1),
('2026-10-02 11:00:00', 117000, 'EDC', 2),
('2026-10-03 11:00:00', 71000, 'TUNAI', 3),
('2026-10-04 11:00:00', 59500, 'TRANSFER', 4),
('2026-10-05 11:00:00', 54500, 'EDC', 5),
('2026-10-06 11:00:00', 41000, 'TUNAI', 6),
('2026-10-07 11:00:00', 48000, 'TRANSFER', 7),
('2026-10-08 11:00:00', 29000, 'EDC', 8),
('2026-10-09 11:00:00', 30000, 'TUNAI', 9),
('2026-10-10 11:00:00', 81000, 'TRANSFER', 10);
