CREATE DATABASE IF NOT EXISTS DB_penjualan;
USE DB_penjualan;

DROP TABLE IF EXISTS pembayaran;
DROP TABLE IF EXISTS transaksi_detail;
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS pelanggan;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS user;

CREATE TABLE supplier (
    id int(11) NOT NULL AUTO_INCREMENT,
    nama varchar(100) NOT NULL,
    telp varchar(12) NOT NULL,
    alamat text NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE pelanggan (
    id varchar(20) NOT NULL,
    nama varchar(100) NOT NULL,
    jenis_kelamin enum('L','P') NOT NULL,
    telp varchar(12) NOT NULL,
    alamat text NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE barang (
    id int(11) NOT NULL AUTO_INCREMENT,
    kode_barang varchar(10) NOT NULL,
    nama_barang varchar(100) NOT NULL,
    harga int(11) NOT NULL,
    stok int(11) NOT NULL,
    supplier_id int(11) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY kode_barang (kode_barang),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE transaksi (
    id int(11) NOT NULL AUTO_INCREMENT,
    waktu_transaksi date NOT NULL,
    keterangan text NOT NULL,
    total int(11) NOT NULL DEFAULT 0,
    pelanggan_id varchar(20) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE transaksi_detail (
    transaksi_id int(11) NOT NULL,
    barang_id int(11) NOT NULL,
    harga int(11) NOT NULL,
    qty int(11) NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE pembayaran (
    id int(11) NOT NULL AUTO_INCREMENT,
    waktu_bayar datetime NOT NULL,
    total int(11) NOT NULL,
    metode enum('TUNAI','TRANSFER','EDC') NOT NULL,
    transaksi_id int(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE user (
    id_user tinyint(4) NOT NULL AUTO_INCREMENT,
    username varchar(30) NOT NULL,
    password varchar(35) NOT NULL,
    nama varchar(50) NOT NULL,
    alamat varchar(150) NOT NULL,
    hp varchar(20) NOT NULL,
    level tinyint(1) NOT NULL,
    PRIMARY KEY (id_user)
);

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT Sumber Kertas', '08111111111', 'Alamat A'),
(2, 'PT Pena Nusantara', '08111111112', 'Alamat B'),
(3, 'PT Alat Tulis Mandiri', '08111111113', 'Alamat C'),
(4, 'PT Citra Perlengkapan', '08111111114', 'Alamat D'),
(5, 'PT Mitra Buku', '08111111115', 'Alamat E');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Andi Pratama', 'L', '08222222221', 'Alamat A'),
('PLG002', 'Budi Santoso', 'L', '08222222222', 'Alamat B'),
('PLG003', 'Citra Dewi', 'P', '08222222223', 'Alamat C'),
('PLG004', 'Deni Setiawan', 'L', '08222222224', 'Alamat D'),
('PLG005', 'Eka Rahmawati', 'P', '08222222225', 'Alamat E'),
('PLG006', 'Fajar Nugraha', 'L', '08222222226', 'Alamat F'),
('PLG007', 'Gita Permata', 'P', '08222222227', 'Alamat G'),
('PLG008', 'Hadi Wijaya', 'L', '08222222228', 'Alamat H'),
('PLG009', 'Indah Lestari', 'P', '08222222229', 'Alamat I'),
('PLG010', 'Joko Supriadi', 'L', '08222222230', 'Alamat J');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Buku tulis', 5000, 100, 1),
(2, 'BRG002', 'Pensil', 3000, 100, 2),
(3, 'BRG003', 'Pulpen', 4000, 100, 3),
(4, 'BRG004', 'Penghapus', 2000, 100, 4),
(5, 'BRG005', 'Penggaris', 6000, 100, 5),
(6, 'BRG006', 'Spidol', 8000, 50, 1);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-01-01', 'Penjualan', 10000, 'PLG001'),
(2, '2026-01-02', 'Penjualan', 6000, 'PLG002'),
(3, '2026-01-03', 'Penjualan', 8000, 'PLG003'),
(4, '2026-01-04', 'Penjualan', 4000, 'PLG004'),
(5, '2026-01-05', 'Penjualan', 12000, 'PLG005'),
(6, '2026-01-06', 'Penjualan', 5000, 'PLG006'),
(7, '2026-01-07', 'Penjualan', 3000, 'PLG007'),
(8, '2026-01-08', 'Penjualan', 4000, 'PLG008'),
(9, '2026-01-09', 'Penjualan', 2000, 'PLG009'),
(10, '2026-01-10', 'Penjualan', 6000, 'PLG010');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 5000, 2),
(2, 2, 3000, 2),
(3, 3, 4000, 2),
(4, 4, 2000, 2),
(5, 5, 6000, 2),
(6, 1, 5000, 1),
(7, 2, 3000, 1),
(8, 3, 4000, 1),
(9, 4, 2000, 1),
(10, 5, 6000, 1);

INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1, '2026-01-01 10:00:00', 10000, 'TUNAI', 1),
(2, '2026-01-02 10:00:00', 6000, 'TRANSFER', 2),
(3, '2026-01-03 10:00:00', 8000, 'EDC', 3),
(4, '2026-01-04 10:00:00', 4000, 'TUNAI', 4),
(5, '2026-01-05 10:00:00', 12000, 'TRANSFER', 5),
(6, '2026-01-06 10:00:00', 5000, 'TUNAI', 6),
(7, '2026-01-07 10:00:00', 3000, 'EDC', 7),
(8, '2026-01-08 10:00:00', 4000, 'TUNAI', 8),
(9, '2026-01-09 10:00:00', 2000, 'TRANSFER', 9),
(10, '2026-01-10 10:00:00', 6000, 'TUNAI', 10);

INSERT INTO user (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'user1', '973696ef07947fe7d3f6fa2b354580ed', 'User A', 'Alamat A', '08333333331', 1),
(2, 'user2', '973696ef07947fe7d3f6fa2b354580ed', 'User B', 'Alamat B', '08333333332', 1),
(3, 'user3', '973696ef07947fe7d3f6fa2b354580ed', 'User C', 'Alamat C', '08333333333', 1),
(4, 'user4', '973696ef07947fe7d3f6fa2b354580ed', 'User D', 'Alamat D', '08333333334', 1),
(5, 'user5', '973696ef07947fe7d3f6fa2b354580ed', 'User E', 'Alamat E', '08333333335', 1);
