<?php
include 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];

    // cek apakah barang sudah dipakai di transaksi_detail
    $cek = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM transaksi_detail WHERE barang_id = $id"));

    if ($cek[0] > 0) {
        // sudah dipakai: tidak boleh dihapus
        echo "<script>alert('Barang tidak dapat dihapus karena masih digunakan pada transaksi.');</script>";
    } else {
        // belum dipakai: boleh dihapus
        mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id");
        echo "<script>alert('Barang berhasil dihapus.');</script>";
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM barang");
?>
<style>a, a:visited { color: blue; }</style>

<h2>Data Barang</h2>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Kode</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
  <?php while ($r = mysqli_fetch_assoc($data)) { ?>
  <tr>
    <td><?= $r['id'] ?></td>
    <td><?= $r['kode_barang'] ?></td>
    <td><?= $r['nama_barang'] ?></td>
    <td><?= $r['harga'] ?></td>
    <td><?= $r['stok'] ?></td>
    <td><a href="Tugas-3.php?hapus=<?= $r['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td>
  </tr>
  <?php } ?>
</table>