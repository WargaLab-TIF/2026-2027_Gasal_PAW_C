CREATE DATABASE penjualan;
USE penjualan;

CREATE TABLE pelanggan(
    id varchar(20) PRIMARY KEY,
    nama varchar(100) not null,
    jenis_kelamin enum('L','P'),
    telp varchar(12),
    alamat text
);

CREATE TABLE transaksi(
    id int AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi date not null,
    keterangan text,
    total int not null,
    pelanggan_id varchar(20) not null,
    
    CONSTRAINT tr_to_pelanggan
    	FOREIGN KEY (pelanggan_id)
    	REFERENCES pelanggan(id)
    	ON DELETE RESTRICT
    	ON UPDATE CASCADE
);

CREATE TABLE supplier (
    id int AUTO_INCREMENT PRIMARY KEY,
    nama varchar(100) not null,
    telp varchar(12),
    alamat text
);

CREATE TABLE barang (
    id int AUTO_INCREMENT PRIMARY KEY,
    kode_barang varchar(10) not null,
    nama_barang varchar(100) not null,
    harga int not null,
    stok int,
    supplier_id int,
    
    CONSTRAINT br_to_supplier
    	FOREIGN KEY (supplier_id)
    	REFERENCES supplier(id)
    	ON DELETE RESTRICT
    	ON UPDATE CASCADE
);

CREATE TABLE transaksi_detail(
    transaksi_id int not null,
    barang_id int not null,
    harga int not null,
    qty int not null,
    
    PRIMARY KEY (transaksi_id, barang_id),
    
    CONSTRAINT td_to_barang
    	FOREIGN KEY (barang_id)
    	REFERENCES barang(id)
    	ON DELETE RESTRICT
    	ON UPDATE CASCADE,
    
    CONSTRAINT td_to_tr
    	FOREIGN KEY (transaksi_id)
    	REFERENCES transaksi(id)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE
);

CREATE TABLE pembayaran(
    id int AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar datetime not null,
    total int not null,
    metode enum('TUNAI','TRANSFER','EDC') not null,
    transaksi_id int not null,
    	
    CONSTRAINT p_to_tr
    	FOREIGN KEY (transaksi_id)
    	REFERENCES transaksi(id)
    	ON DELETE RESTRICT
    	ON UPDATE CASCADE
);

CREATE TABLE user(
    id_user tinyint AUTO_INCREMENT PRIMARY KEY,
    username varchar(30),
    password varchar(35),
    nama varchar(50),
    alamat varchar(150),
    hp varchar(20),
    level tinyint(1)
);


INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG-001', 'Budi Santoso', 'L', '081211112222', 'Jl. Merdeka No. 10, Jakarta'),
('PLG-002', 'Siti Rahmawati', 'P', '081322223333', 'Jl. Melati No. 5, Bandung'),
('PLG-003', 'Andi Pratama', 'L', '082133334444', 'Jl. Mawar No. 18, Depok'),
('PLG-004', 'Dewi Lestari', 'P', '085644445555', 'Jl. Anggrek No. 25, Tangerang'),
('PLG-005', 'Rian Hidayat', 'L', '087755556666', 'Jl. Kenanga No. 3, Bekasi');

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Sentra Komputer', '081234567890', 'Mangga Dua Mall Lt. 3, Jakarta'),
('CV. Mega Aksesoris', '081398765432', 'Jl. Braga No. 45, Bandung'),
('PT. Digital Sarana', '082155566677', 'Ruko Sentul Niaga, Bogor'),
('Distributor Gadgetindo', '085711223344', 'Komp. ITC Cempaka Putih, Jakarta'),
('Global Perkasa Tech', '087899887766', 'Jl. Pahlawan No. 12, Surabaya');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', 'admin123', 'Super Administrator', 'Jakarta Pusat', '081100000001', 1),
('kasir1', 'kasir123', 'Ahmad Dani', 'Jakarta Selatan', '081100000002', 2),
('kasir2', 'kasir123', 'Putri Ayu', 'Jakarta Timur', '081100000003', 2),
('gudang', 'gudang123', 'Hendra Wijaya', 'Bekasi Barat', '081100000004', 3),
('manager', 'manager123', 'Bambang S.', 'Bogor Kota', '081100000005', 1);

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG-001', 'Laptop ASUS Vivobook', 8500000, 15, 1),
('BRG-002', 'Mouse Wireless Logitech', 150000, 50, 2),
('BRG-003', 'Keyboard Mechanical RGB', 450000, 30, 2),
('BRG-004', 'Monitor Samsung 24 Inch', 1750000, 20, 3),
('BRG-005', 'Flashdisk Sandisk 64GB', 90000, 100, 4);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-11-01', 'Pembelian keperluan kantor', 150000, 'PLG-001'),
(2, '2026-11-01', 'Upgrade PC gaming', 8650000, 'PLG-002'),
(3, '2026-11-02', 'Beli flashdisk grosir', 450000, 'PLG-003'),
(4, '2026-11-02', 'Aksesoris meja kerja', 600000, 'PLG-004'),
(5, '2026-11-03', 'Monitor kerja baru', 1750000, 'PLG-005'),
(6, '2026-11-03', 'Laptop untuk kuliah', 8500000, 'PLG-001'),
(7, '2026-11-04', 'Peralatan lab mini', 2290000, 'PLG-002'),
(8, '2026-11-05', 'Mouse dan flashdisk', 240000, 'PLG-003'),
(9, '2026-11-06', 'Setup ruang meeting', 3500000, 'PLG-004'),
(10, '2026-11-07', 'Keyboard kantor', 900000, 'PLG-005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 2, 150000, 1),
(2, 1, 8500000, 1),
(2, 2, 150000, 1),
(3, 5, 90000, 5),
(4, 2, 150000, 1),
(4, 3, 450000, 1),
(5, 4, 1750000, 1),
(6, 1, 8500000, 1),
(7, 4, 1750000, 1),
(7, 3, 450000, 1),
(7, 5, 90000, 1),
(8, 2, 150000, 1),
(8, 5, 90000, 1),
(9, 4, 1750000, 2),
(10, 3, 450000, 2);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-11-01 10:15:00', 150000, 'TUNAI', 1),
('2026-11-01 14:30:00', 8650000, 'TRANSFER', 2),
('2026-11-02 09:45:00', 450000, 'TUNAI', 3),
('2026-11-02 16:20:00', 600000, 'EDC', 4),
('2026-11-03 11:10:00', 1750000, 'TRANSFER', 5),
('2026-11-03 15:40:00', 8500000, 'TRANSFER', 6),
('2026-11-04 13:05:00', 2290000, 'EDC', 7),
('2026-11-05 17:00:00', 240000, 'TUNAI', 8),
('2026-11-06 10:50:00', 3500000, 'TRANSFER', 9),
('2026-11-07 12:30:00', 900000, 'EDC', 10);
