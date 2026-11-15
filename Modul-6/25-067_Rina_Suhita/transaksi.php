<?php
require 'koneksi.php';

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal      = $_POST['waktu_transaksi'] ?? '';
    $pelanggan_id = $_POST['pelanggan_id'] ?? '';
    $keterangan   = trim($_POST['keterangan'] ?? '');

    if ($tanggal === '' || $pelanggan_id === '') {
        $pesan = "Tanggal dan pelanggan wajib diisi.";
    } else {
        $stmt = mysqli_prepare($koneksi,
            "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $tanggal, $keterangan, $pelanggan_id);
        mysqli_stmt_execute($stmt);
        header("Location: detail.php?id=" . mysqli_insert_id($koneksi));
        exit;
    }
}

$pelanggan = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan ORDER BY nama");

$daftar = mysqli_query($koneksi,
    "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan
       FROM transaksi t
       LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
      ORDER BY t.id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Transaksi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="menu"><a href="transaksi.php">Transaksi</a> <a href="barang.php">Barang</a></div>
  <h1>Data Transaksi (Master)</h1>

  <?php if ($pesan): ?><div class="pesan gagal"><?= h($pesan) ?></div><?php endif; ?>

  <form method="post" class="box">
    <h2>Tambah Transaksi Baru</h2>
    <p><label>Tanggal</label>
       <input type="date" name="waktu_transaksi" value="<?= date('Y-m-d') ?>" required></p>
    <p><label>Pelanggan</label>
       <select name="pelanggan_id" required>
         <option value="">-- pilih pelanggan --</option>
         <?php while ($p = mysqli_fetch_assoc($pelanggan)): ?>
           <option value="<?= h($p['id']) ?>"><?= h($p['id'] . ' - ' . $p['nama']) ?></option>
         <?php endwhile; ?>
       </select></p>
    <p><label>Keterangan</label>
       <input type="text" name="keterangan" size="40"></p>
    <button type="submit">Simpan &amp; Isi Detail</button>
  </form>

  <table>
    <tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th><th class="angka">Total</th><th>Aksi</th></tr>
    <?php while ($r = mysqli_fetch_assoc($daftar)): ?>
      <tr>
        <td><?= h($r['id']) ?></td>
        <td><?= h($r['waktu_transaksi']) ?></td>
        <td><?= h($r['nama_pelanggan']) ?></td>
        <td><?= h($r['keterangan']) ?></td>
        <td class="angka"><?= rupiah($r['total']) ?></td>
        <td><a class="btn" href="detail.php?id=<?= (int)$r['id'] ?>">Lihat / Isi Detail</a></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>