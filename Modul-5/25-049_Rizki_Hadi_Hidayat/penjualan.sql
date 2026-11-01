CREATE DATABASE IF NOT EXISTS modul_praktikum_5;
USE modul_praktikum_5;

CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY NOT NULL,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE supplier (
    id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nama VARCHAR(100),
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE barang (
    id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    kode_barang VARCHAR(10),
    nama_barang VARCHAR(100),
    harga INT(11),
    stok INT(11),
    supplier_id INT(11),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE transaksi (
    id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    waktu_transaksi DATE,
    keterangan TEXT,
    total INT(11),
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
    transaksi_id INT(11) NOT NULL,
    barang_id INT(11) NOT NULL,
    harga INT(11),
    qty INT(11),
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE pembayaran (
    id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    waktu_bayar DATETIME,
    total INT(11),
    metode ENUM('TUNAI', 'TRANSFER', 'EDC'),
    transaksi_id INT(11),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE user (
    id_user TINYINT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    username VARCHAR(30),
    password VARCHAR(35),
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
);

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(2, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(3, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(4, 'PT. Ternak', '088883242', 'Suramadu'),
(5, 'PT. Sehat', '083943422', 'Malang'),
(7, 'PT. Mobile legend', '089544322', 'Montoon'),
(8, 'PT. Free Fire', '089644223', 'Garena'),
(9, 'PT. Panas', '08988334', 'Siang'),
(10, 'PT. Dingin', '088763531', 'Malam'),
(11, 'PT. Makan', '089764445', 'Bandung');
