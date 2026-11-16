USE db_penjualan;

START TRANSACTION;

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('1', 'Andi Saputra', 'L', '081234560001', 'Jl. Melati No. 1, Bangkalan'),
('2', 'Siti Aminah', 'P', '081234560002', 'Jl. Mawar No. 2, Surabaya'),
('3', 'Budi Santoso', 'L', '081234560003', 'Jl. Kenanga No. 3, Kamal'),
('4', 'Dewi Lestari', 'P', '081234560004', 'Jl. Anggrek No. 4, Gresik'),
('5', 'Rizky Pratama', 'L', '081234560005', 'Jl. Flamboyan No. 5, Sumenep'),
('6', 'Putri Maharani', 'P', '081234560006', 'Jl. Dahlia No. 6, Pamekasan'),
('7', 'Fajar Hidayat', 'L', '081234560007', 'Jl. Cempaka No. 7, Sampang'),
('8', 'Nadia Safitri', 'P', '081234560008', 'Jl. Teratai No. 8, Bangkalan'),
('9', 'Agus Setiawan', 'L', '081234560009', 'Jl. Merpati No. 9, Surabaya'),
('10', 'Lina Febriani', 'P', '081234560010', 'Jl. Rajawali No. 10, Kamal');

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT. Maju Bersama', '081515560001', 'Surabaya'),
(2, 'CV. Sumber Makmur', '081515560002', 'Bangkalan'),
(3, 'PT. Sentosa Jaya', '081515560003', 'Gresik'),
(4, 'CV. Berkah Niaga', '081515560004', 'Sidoarjo'),
(5, 'PT. Sinar Abadi', '081515560005', 'Malang'),
(6, 'CV. Mitra Sejahtera', '081515560006', 'Pamekasan'),
(7, 'PT. Karya Utama', '081515560007', 'Mojokerto'),
(8, 'CV. Cahaya Baru', '081515560008', 'Sampang'),
(9, 'PT. Indo Persada', '081515560009', 'Jombang'),
(10, 'CV. Alam Niaga', '081515560010', 'Sumenep');

INSERT INTO `user` (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'admin01', 'demo123', 'Admin Utama', 'Bangkalan', '082100000001', 1),
(2, 'kasir01', 'demo123', 'Kasir Andi', 'Surabaya', '082100000002', 2),
(3, 'kasir02', 'demo123', 'Kasir Siti', 'Kamal', '082100000003', 2),
(4, 'staff01', 'demo123', 'Staff Budi', 'Gresik', '082100000004', 3),
(5, 'staff02', 'demo123', 'Staff Dewi', 'Sidoarjo', '082100000005', 3),
(6, 'staff03', 'demo123', 'Staff Rizky', 'Pamekasan', '082100000006', 3),
(7, 'kasir03', 'demo123', 'Kasir Putri', 'Sampang', '082100000007', 2),
(8, 'staff04', 'demo123', 'Staff Fajar', 'Sumenep', '082100000008', 3),
(9, 'kasir04', 'demo123', 'Kasir Nadia', 'Malang', '082100000009', 2),
(10, 'staff05', 'demo123', 'Staff Agus', 'Mojokerto', '082100000010', 3);

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Beras 5 Kg', 15000, 50, 1),
(2, 'BRG002', 'Gula Pasir 1 Kg', 12000, 60, 2),
(3, 'BRG003', 'Minyak Goreng 1 L', 8000, 80, 3),
(4, 'BRG004', 'Kopi Bubuk 200 g', 25000, 35, 4),
(5, 'BRG005', 'Teh Celup 25 Pcs', 18000, 40, 5),
(6, 'BRG006', 'Mi Instan', 10000, 100, 6),
(7, 'BRG007', 'Susu UHT 1 L', 30000, 30, 7),
(8, 'BRG008', 'Deterjen 800 g', 22000, 45, 8),
(9, 'BRG009', 'Air Mineral 600 ml', 5000, 120, 9),
(10, 'BRG010', 'Tepung Terigu 1 Kg', 40000, 25, 10);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-10-01', 'Pembelian beras', 30000, '1'),
(2, '2026-10-02', 'Pembelian gula pasir', 36000, '2'),
(3, '2026-10-03', 'Pembelian minyak goreng', 40000, '3'),
(4, '2026-10-04', 'Pembelian kopi bubuk', 50000, '4'),
(5, '2026-10-05', 'Pembelian teh celup', 36000, '5'),
(6, '2026-10-06', 'Pembelian mi instan', 40000, '6'),
(7, '2026-10-07', 'Pembelian susu UHT', 30000, '7'),
(8, '2026-10-08', 'Pembelian deterjen', 44000, '8'),
(9, '2026-10-09', 'Pembelian air mineral', 40000, '9'),
(10, '2026-10-10', 'Pembelian tepung terigu', 40000, '10');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 15000, 2),
(2, 2, 12000, 3),
(3, 3, 8000, 5),
(4, 4, 25000, 2),
(5, 5, 18000, 2),
(6, 6, 10000, 4),
(7, 7, 30000, 1),
(8, 8, 22000, 2),
(9, 9, 5000, 8),
(10, 10, 40000, 1);

INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1, '2026-10-01 09:15:00', 30000, 'TUNAI', 1),
(2, '2026-10-02 10:20:00', 36000, 'TRANSFER', 2),
(3, '2026-10-03 11:05:00', 40000, 'EDC', 3),
(4, '2026-10-04 12:30:00', 50000, 'TUNAI', 4),
(5, '2026-10-05 13:10:00', 36000, 'TRANSFER', 5),
(6, '2026-10-06 14:25:00', 40000, 'EDC', 6),
(7, '2026-10-07 15:40:00', 30000, 'TUNAI', 7),
(8, '2026-10-08 16:00:00', 44000, 'TRANSFER', 8),
(9, '2026-10-09 17:15:00', 40000, 'EDC', 9),
(10, '2026-10-10 18:30:00', 40000, 'TUNAI', 10);

COMMIT;

SELECT 'pelanggan' AS nama_tabel, COUNT(*) AS jumlah_data FROM pelanggan
UNION ALL SELECT 'supplier', COUNT(*) FROM supplier
UNION ALL SELECT 'user', COUNT(*) FROM `user`
UNION ALL SELECT 'barang', COUNT(*) FROM barang
UNION ALL SELECT 'transaksi', COUNT(*) FROM transaksi
UNION ALL SELECT 'transaksi_detail', COUNT(*) FROM transaksi_detail
UNION ALL SELECT 'pembayaran', COUNT(*) FROM pembayaran;