<?php
require 'koneksi.php';

$pesan = '';
$tipe  = 'gagal';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_id'])) {
    $hapus_id = (int)$_POST['hapus_id'];

    $q = mysqli_prepare($koneksi, "SELECT nama_barang FROM barang WHERE id = ?");
    mysqli_stmt_bind_param($q, "i", $hapus_id);
    mysqli_stmt_execute($q);
    $brg = mysqli_fetch_assoc(mysqli_stmt_get_result($q));

    if (!$brg) {
        $pesan = "Data barang tidak ditemukan.";
    } else {
    
        $c = mysqli_prepare($koneksi,
            "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = ?");
        mysqli_stmt_bind_param($c, "i", $hapus_id);
        mysqli_stmt_execute($c);
        $jumlah = (int)mysqli_fetch_assoc(mysqli_stmt_get_result($c))['jumlah'];

        if ($jumlah > 0) {
            $pesan = "Barang \"{$brg['nama_barang']}\" tidak dapat dihapus karena masih digunakan pada {$jumlah} transaksi.";
        } else {
            $del = mysqli_prepare($koneksi, "DELETE FROM barang WHERE id = ?");
            mysqli_stmt_bind_param($del, "i", $hapus_id);
            mysqli_stmt_execute($del);
            $pesan = "Barang \"{$brg['nama_barang']}\" berhasil dihapus.";
            $tipe  = 'sukses';
        }
    }
}

$daftar = mysqli_query($koneksi,
    "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS nama_supplier,
            (SELECT COUNT(*) FROM transaksi_detail d WHERE d.barang_id = b.id) AS dipakai
       FROM barang b
       LEFT JOIN supplier s ON s.id = b.supplier_id
      ORDER BY b.id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Barang</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="menu"><a href="transaksi.php">Transaksi</a> <a href="barang.php">Barang</a></div>
  <h1>Data Barang</h1>

  <?php if ($pesan): ?><div class="pesan <?= $tipe ?>"><?= h($pesan) ?></div><?php endif; ?>

  <table>
    <tr><th>ID</th><th>Kode</th><th>Nama Barang</th><th class="angka">Harga</th><th class="angka">Stok</th>
        <th>Supplier</th><th class="angka">Dipakai di Transaksi</th><th>Aksi</th></tr>
    <?php while ($r = mysqli_fetch_assoc($daftar)): ?>
      <tr>
        <td><?= (int)$r['id'] ?></td>
        <td><?= h($r['kode_barang']) ?></td>
        <td><?= h($r['nama_barang']) ?></td>
        <td class="angka"><?= rupiah($r['harga']) ?></td>
        <td class="angka"><?= (int)$r['stok'] ?></td>
        <td><?= h($r['nama_supplier']) ?></td>
        <td class="angka"><?= (int)$r['dipakai'] ?></td>
        <td>
          <form method="post" style="display:inline"
                onsubmit="return confirm('Yakin hapus barang ini?');">
            <input type="hidden" name="hapus_id" value="<?= (int)$r['id'] ?>">
            <button type="submit">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>