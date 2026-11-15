<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id ASC");
$pesan = $_GET['pesan'] ?? '';
?>

<h2>Data Barang</h2>
<a href="index.php">Kembali ke Data Transaksi</a>


<?php
if ($pesan == "digunakan") {
    echo "<p>Barang masih digunakan pada transaksi dan tidak dapat dihapus.</p>";
} elseif ($pesan == "berhasil") {
    echo "<p>Barang berhasil dihapus.</p>";
} elseif ($pesan == "gagal") {
    echo "<p>Barang gagal dihapus.</p>";
}
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Action</th>
    </tr>

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $data['id']; ?></td>
        <td><?= htmlspecialchars($data['kode_barang']); ?></td>
        <td><?= htmlspecialchars($data['nama_barang']); ?></td>
        <td><?= $data['harga']; ?></td>
        <td><?= $data['stok']; ?></td>
        <td>
            <form action="hapus_barang.php" method="post"
                  onsubmit="return confirm('Yakin ingin menghapus barang?')">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>