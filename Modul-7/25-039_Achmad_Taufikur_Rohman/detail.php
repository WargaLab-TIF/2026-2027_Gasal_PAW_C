<?php
include "koneksi.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID transaksi tidak valid.");
}

$id = (int) $_GET['id'];

$query = mysqli_query($koneksi, "SELECT t.*, p.nama AS nama_pelanggan
                                 FROM transaksi t
                                 JOIN pelanggan p ON p.id = t.pelanggan_id
                                 WHERE t.id = '$id'");
$transaksi = mysqli_fetch_assoc($query);

if (!$transaksi) {
    die("Transaksi tidak ditemukan.");
}

$query = mysqli_query($koneksi, "SELECT td.*, b.kode_barang, b.nama_barang,
                                 (td.harga * td.qty) AS subtotal
                                 FROM transaksi_detail td
                                 JOIN barang b ON b.id = td.barang_id
                                 WHERE td.transaksi_id = '$id'
                                 ORDER BY b.nama_barang");

$query_barang = mysqli_query($koneksi, "SELECT * FROM barang
                                        WHERE id NOT IN (
                                            SELECT barang_id FROM transaksi_detail
                                            WHERE transaksi_id = '$id'
                                        )
                                        ORDER BY nama_barang");
?>

<h2>Detail Transaksi</h2>
<a href="index.php">Kembali ke Data Transaksi</a>

<?php
if (isset($_GET['pesan']) && $_GET['pesan'] == "dihapus") {
    echo "<p>Detail barang berhasil dihapus.</p>";
}
?>
<p>Tanggal: <?= htmlspecialchars($transaksi['waktu_transaksi']); ?></p>
<p>Pelanggan: <?= htmlspecialchars($transaksi['nama_pelanggan']); ?></p>
<p>Keterangan: <?= htmlspecialchars($transaksi['keterangan'] ?? '-'); ?></p>
<p>Total Transaksi: Rp <?= number_format($transaksi['total'], 0, ',', '.'); ?></p>

<h3>Daftar Barang</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>

    <?php
    $no = 1;
    $jumlah = 0;
    while ($data = mysqli_fetch_assoc($query)) {
        $subtotal = $data['harga'] * $data['qty'];
        $jumlah += $subtotal;
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($data['kode_barang']); ?></td>
        <td><?= htmlspecialchars($data['nama_barang']); ?></td>
        <td>Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
        <td><?= $data['qty']; ?></td>
        <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
        <td>
            <form action="hapus_detail.php" method="post"
                onsubmit="return confirm('Yakin ingin menghapus barang ini?')">

                <input type="hidden" name="transaksi_id" value="<?= $id; ?>">
                <input type="hidden" name="barang_id" value="<?= $data['barang_id']; ?>">

                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php } ?>

    <tr>
        <th colspan="5">Total</th>
        <th colspan="2">Rp <?= number_format($jumlah, 0, ',', '.'); ?></th>
    </tr>
</table>

<h3>Tambah Detail Transaksi</h3>

<?php if (mysqli_num_rows($query_barang) > 0) { ?>

<form action="tambah_detail.php" method="post">
    <input type="hidden" name="transaksi_id" value="<?= $id; ?>">
    <label>Barang:</label><br>
    <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>

        <?php while ($barang = mysqli_fetch_assoc($query_barang)) { ?>
        <option value="<?= $barang['id']; ?>">
            <?= htmlspecialchars($barang['kode_barang'] . " - " . $barang['nama_barang']); ?>
            | Rp <?= number_format($barang['harga'], 0, ',', '.'); ?>
            | Stok: <?= $barang['stok']; ?>
        </option>
        <?php } ?>

    </select>

    <br><br>
    <label>Jumlah (Qty):</label><br>
    <input type="number" name="qty" min="1" value="1" required>
    <br><br>

    <button type="submit">Tambah Barang</button>
</form>
<?php } ?>