<?php
include "koneksi.php";

if (isset($_POST['simpan_barang'])) {
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $supplier_id = (int) $_POST['supplier_id'];

    mysqli_query($koneksi, "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
    VALUES ('$kode', '$nama', $harga, $stok, $supplier_id)");

    header("Location: barang.php?pesan=Barang berhasil ditambahkan");
    exit;
}

if (isset($_GET['hapus'])) {
    $id_barang = (int) $_GET['hapus'];

    $cek_barang = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id = $id_barang");

    if (mysqli_num_rows($cek_barang) > 0) {
        header("Location: barang.php?pesan=Barang tidak bisa dihapus karena masih digunakan pada transaksi");
        exit;
    } else {
        mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id_barang");
        header("Location: barang.php?pesan=Barang berhasil dihapus");
        exit;
    }
}

$query_barang = mysqli_query($koneksi, "SELECT barang.*, supplier.nama AS nama_supplier
    FROM barang
    JOIN supplier ON barang.supplier_id = supplier.id
    ORDER BY barang.id ASC");

$query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Data Barang</h1>

    <nav>
        <a href="transaksi.php">Transaksi</a>
        <a href="barang.php">Data Barang</a>
    </nav>

    <?php if (isset($_GET['pesan'])) { ?>
        <p class="pesan"><?php echo htmlspecialchars($_GET['pesan']); ?></p>
    <?php } ?>

    <h2>Daftar Barang</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Supplier</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while ($barang = mysqli_fetch_assoc($query_barang)) { ?>
        <tr>
            <td><?php echo $barang['id']; ?></td>
            <td><?php echo htmlspecialchars($barang['kode_barang']); ?></td>
            <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
            <td><?php echo htmlspecialchars($barang['nama_supplier']); ?></td>
            <td>Rp <?php echo number_format($barang['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $barang['stok']; ?></td>
            <td>
                <?php
                $id_barang = (int) $barang['id'];
                $cek_pemakaian = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id = $id_barang");
                if (mysqli_num_rows($cek_pemakaian) > 0) {
                    echo "Tidak bisa dihapus";
                } else {
                ?>
                    <a href="barang.php?hapus=<?php echo $barang['id']; ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2>Tambah Barang</h2>
    <form method="POST" class="form-barang">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" maxlength="10" required>

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" required>

        <label>Harga</label>
        <input type="number" name="harga" min="0" required>

        <label>Stok</label>
        <input type="number" name="stok" min="0" required>

        <label>Supplier</label>
        <select name="supplier_id" required>
            <option value="">-- Pilih supplier --</option>
            <?php while ($supplier = mysqli_fetch_assoc($query_supplier)) { ?>
                <option value="<?php echo $supplier['id']; ?>">
                    <?php echo htmlspecialchars($supplier['nama']); ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit" name="simpan_barang">Simpan Barang</button>
    </form>
</div>
</body>
</html>