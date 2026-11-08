<?php
$host = "localhost";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS penjualan");
mysqli_select_db($conn, "penjualan");

$queries = array();

$queries[] = "DROP TABLE IF EXISTS pembayaran";
$queries[] = "DROP TABLE IF EXISTS transaksi_detail";
$queries[] = "DROP TABLE IF EXISTS transaksi";
$queries[] = "DROP TABLE IF EXISTS barang";
$queries[] = "DROP TABLE IF EXISTS pelanggan";
$queries[] = "DROP TABLE IF EXISTS `user`";
$queries[] = "DROP TABLE IF EXISTS supplier";

$queries[] = "CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB";

$queries[] = "CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P') NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB";

$queries[] = "CREATE TABLE `user` (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB";

$queries[] = "CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    supplier_id INT NOT NULL,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE RESTRICT
) ENGINE=InnoDB";

$queries[] = "CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT NOT NULL DEFAULT 0,
    pelanggan_id VARCHAR(20) NOT NULL,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT
) ENGINE=InnoDB";

$queries[] = "CREATE TABLE transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL DEFAULT 0,
    qty INT NOT NULL DEFAULT 0,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
) ENGINE=InnoDB";

$queries[] = "CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL DEFAULT 0,
    metode ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
    transaksi_id INT NOT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE
) ENGINE=InnoDB";

$queries[] = "INSERT INTO supplier (id, nama, telp, alamat) VALUES
    (1, 'PT Sumber Makmur', '081234567890', 'Surabaya'),
    (2, 'CV Berkah Jaya', '081234567891', 'Sidoarjo'),
    (3, 'UD Makmur Sentosa', '081234567892', 'Gresik'),
    (4, 'PT Cahaya Abadi', '081234567893', 'Malang'),
    (5, 'CV Mitra Sejahtera', '081234567894', 'Bangkalan')";

$queries[] = "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
    ('P001', 'Budi Santoso', 'L', '081234567801', 'Surabaya'),
    ('P002', 'Siti Aminah', 'P', '081234567802', 'Bangkalan'),
    ('P003', 'Ahmad Fauzi', 'L', '081234567803', 'Sidoarjo'),
    ('P004', 'Dewi Lestari', 'P', '081234567804', 'Malang'),
    ('P005', 'Rudi Hartono', 'L', '081234567805', 'Gresik')";

$queries[] = "INSERT INTO `user` (id_user, username, password, nama, alamat, hp, level) VALUES
    (1, 'admin', 'admin123', 'Administrator', 'Surabaya', '081200000001', 1),
    (2, 'kasir1', 'kasir123', 'Siti Kasir', 'Bangkalan', '081200000002', 0),
    (3, 'kasir2', 'kasir123', 'Dewi Kasir', 'Sidoarjo', '081200000003', 0),
    (4, 'gudang1', 'gudang123', 'Joko Gudang', 'Gresik', '081200000004', 0),
    (5, 'supervisor', 'super123', 'Ahmad Supervisor', 'Malang', '081200000005', 1)";

$queries[] = "INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
    (1, 'B001', 'Beras Premium 5kg', 65000, 50, 1),
    (2, 'B002', 'Minyak Goreng 2L', 34000, 40, 2),
    (3, 'B003', 'Gula Pasir 1kg', 15000, 60, 3),
    (4, 'B004', 'Tepung Terigu 1kg', 12000, 45, 4),
    (5, 'B005', 'Teh Celup 25 Kantong', 8500, 80, 5),
    (6, 'B006', 'Kopi Bubuk 250g', 28000, 35, 1),
    (7, 'B007', 'Susu UHT 1L', 19000, 55, 2),
    (8, 'B008', 'Kecap Manis 550ml', 18000, 30, 3)";

$queries[] = "INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
    (1, '2026-10-01', 'Pembelian sembako bulanan', 181000, 'P001'),
    (2, '2026-10-02', 'Pembelian kebutuhan dapur', 69000, 'P002'),
    (3, '2026-10-03', 'Pembelian minuman', 62000, 'P003'),
    (4, '2026-10-04', 'Pembelian bahan kue', 114000, 'P004'),
    (5, '2026-10-05', 'Pembelian stok warung', 104000, 'P005'),
    (6, '2026-10-06', 'Pembelian beras', 203500, 'P001'),
    (7, '2026-10-07', 'Pembelian minyak dan tepung', 99000, 'P002'),
    (8, '2026-10-08', 'Pembelian grosir', 195000, 'P003'),
    (9, '2026-10-09', 'Pembelian teh dan kopi', 113500, 'P004'),
    (10, '2026-10-10', 'Pembelian kebutuhan toko', 275500, 'P005')";

$queries[] = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
    (1, 1, 65000, 2),
    (1, 2, 34000, 1),
    (1, 5, 8500, 2),
    (2, 3, 15000, 3),
    (2, 4, 12000, 2),
    (3, 5, 8500, 4),
    (3, 6, 28000, 1),
    (4, 1, 65000, 1),
    (4, 3, 15000, 2),
    (4, 7, 19000, 1),
    (5, 2, 34000, 2),
    (5, 4, 12000, 3),
    (6, 1, 65000, 3),
    (6, 5, 8500, 1),
    (7, 2, 34000, 1),
    (7, 3, 15000, 1),
    (7, 4, 12000, 1),
    (7, 7, 19000, 2),
    (8, 1, 65000, 1),
    (8, 2, 34000, 2),
    (8, 3, 15000, 3),
    (8, 5, 8500, 2),
    (9, 4, 12000, 5),
    (9, 5, 8500, 3),
    (9, 6, 28000, 1),
    (10, 1, 65000, 2),
    (10, 2, 34000, 1),
    (10, 3, 15000, 4),
    (10, 4, 12000, 2),
    (10, 5, 8500, 1),
    (10, 7, 19000, 1)";

$queries[] = "INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
    (1, '2026-10-01 10:15:00', 181000, 'TUNAI', 1),
    (2, '2026-10-02 11:20:00', 69000, 'TRANSFER', 2),
    (3, '2026-10-03 12:10:00', 62000, 'EDC', 3),
    (4, '2026-10-04 13:25:00', 114000, 'TUNAI', 4),
    (5, '2026-10-05 14:30:00', 104000, 'TRANSFER', 5),
    (6, '2026-10-06 15:05:00', 203500, 'EDC', 6),
    (7, '2026-10-07 16:15:00', 99000, 'TUNAI', 7),
    (8, '2026-10-08 17:20:00', 195000, 'TRANSFER', 8),
    (9, '2026-10-09 18:10:00', 113500, 'EDC', 9),
    (10, '2026-10-10 19:30:00', 275500, 'TUNAI', 10)";

$berhasil = true;
foreach ($queries as $sql) {
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . mysqli_error($conn) . "<br>";
        $berhasil = false;
        break;
    }
}

if ($berhasil) {
    echo "Database penjualan berhasil dibuat dan data berhasil diinput.<br>";
    echo "<a href='index.php'>Buka halaman transaksi</a> | ";
    echo "<a href='barang.php'>Buka halaman barang</a>";
}

mysqli_close($conn);
?>
