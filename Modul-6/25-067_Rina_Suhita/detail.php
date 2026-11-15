<?php
require 'koneksi.php';

$id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$pesan = '';
$tipe  = 'gagal';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = (int)($_POST['barang_id'] ?? 0);
    $qty       = (int)($_POST['qty'] ?? 0);

    if ($barang_id <= 0 || $qty <= 0) {
        $pesan = "Pilih barang dan isi qty minimal 1.";
    } else {
        try {
            
            $cek = mysqli_prepare($koneksi,
                "SELECT 1 FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?");
            mysqli_stmt_bind_param($cek, "ii", $id, $barang_id);
            mysqli_stmt_execute($cek);
            $sudah = mysqli_stmt_get_result($cek)->num_rows > 0;

            if ($sudah) {
                $pesan = "Barang tersebut sudah ada di transaksi ini dan tidak boleh diinput dua kali.";
            } else {
                
                $qb = mysqli_prepare($koneksi, "SELECT harga FROM barang WHERE id = ?");
                mysqli_stmt_bind_param($qb, "i", $barang_id);
                mysqli_stmt_execute($qb);
                $brg = mysqli_fetch_assoc(mysqli_stmt_get_result($qb));

                if (!$brg) {
                    $pesan = "Barang tidak ditemukan.";
                } else {
                    $harga = (int)$brg['harga'];

                    mysqli_begin_transaction($koneksi);

                    $ins = mysqli_prepare($koneksi,
                        "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)");
                    mysqli_stmt_bind_param($ins, "iiii", $id, $barang_id, $harga, $qty);
                    mysqli_stmt_execute($ins);

                    $upd = mysqli_prepare($koneksi,
                        "UPDATE transaksi
                            SET total = (SELECT COALESCE(SUM(harga * qty), 0)
                                           FROM transaksi_detail
                                          WHERE transaksi_id = ?)
                          WHERE id = ?");
                    mysqli_stmt_bind_param($upd, "ii", $id, $id);
                    mysqli_stmt_execute($upd);

                    mysqli_commit($koneksi);

                    $pesan = "Detail berhasil disimpan dan total transaksi diperbarui.";
                    $tipe  = 'sukses';
                }
            }
        } catch (Throwable $e) {
            mysqli_rollback($koneksi);
            $pesan = "Gagal menyimpan: " . $e->getMessage();
        }
    }
}


$stmt = mysqli_prepare($koneksi,
    "SELECT t.*, p.nama AS nama_pelanggan
       FROM transaksi t
       LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
      WHERE t.id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$master = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$master) {
    die("Transaksi tidak ditemukan. <a href='transaksi.php'>Kembali</a>");
}

$stmt = mysqli_prepare($koneksi,
    "SELECT d.barang_id, b.kode_barang, b.nama_barang, d.harga, d.qty, (d.harga * d.qty) AS subtotal
       FROM transaksi_detail d
       INNER JOIN barang b ON b.id = d.barang_id
      WHERE d.transaksi_id = ?
      ORDER BY b.nama_barang");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$detail = mysqli_stmt_get_result($stmt);

$stmt = mysqli_prepare($koneksi,
    "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, d.barang_id AS sudah_dipakai
       FROM barang b
       LEFT JOIN transaksi_detail d ON d.barang_id = b.id AND d.transaksi_id = ?
      ORDER BY b.nama_barang");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$opsi_barang = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Transaksi #<?= (int)$master['id'] ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="menu"><a href="transaksi.php">Transaksi</a> <a href="barang.php">Barang</a></div>

  <h1>Master Transaksi</h1>
  <div class="box">
    <p><label>No. Transaksi</label>: <?= (int)$master['id'] ?></p>
    <p><label>Tanggal</label>: <?= h($master['waktu_transaksi']) ?></p>
    <p><label>Pelanggan</label>: <?= h($master['pelanggan_id'] . ' - ' . $master['nama_pelanggan']) ?></p>
    <p><label>Keterangan</label>: <?= h($master['keterangan']) ?></p>
    <p><label>Total</label>: <strong><?= rupiah($master['total']) ?></strong></p>
  </div>

  <?php if ($pesan): ?><div class="pesan <?= $tipe ?>"><?= h($pesan) ?></div><?php endif; ?>

  <h2>Detail Transaksi</h2>
  <table>
    <tr><th>No</th><th>Kode</th><th>Nama Barang</th><th class="angka">Harga</th><th class="angka">Qty</th><th class="angka">Subtotal</th></tr>
    <?php $no = 1; while ($d = mysqli_fetch_assoc($detail)): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= h($d['kode_barang']) ?></td>
        <td><?= h($d['nama_barang']) ?></td>
        <td class="angka"><?= rupiah($d['harga']) ?></td>
        <td class="angka"><?= (int)$d['qty'] ?></td>
        <td class="angka"><?= rupiah($d['subtotal']) ?></td>
      </tr>
    <?php endwhile; ?>
    <?php if ($no === 1): ?><tr><td colspan="6">Belum ada detail.</td></tr><?php endif; ?>
  </table>

  <form method="post" class="box">
    <h2>Tambah Barang ke Transaksi</h2>
    <p><label>Barang</label>
       <select name="barang_id" required>
         <option value="">-- pilih barang --</option>
         <?php while ($b = mysqli_fetch_assoc($opsi_barang)): ?>
           <option value="<?= (int)$b['id'] ?>" <?= $b['sudah_dipakai'] ? 'disabled' : '' ?>>
             <?= h($b['kode_barang'] . ' - ' . $b['nama_barang'] . ' (' . rupiah($b['harga']) . ')') ?>
             <?= $b['sudah_dipakai'] ? ' [sudah dipilih]' : '' ?>
           </option>
         <?php endwhile; ?>
       </select></p>
    <p><label>Qty</label> <input type="number" name="qty" min="1" value="1" required></p>
    <button type="submit">Simpan Detail</button>
  </form>

  <p><a class="btn" href="transaksi.php">&laquo; Kembali ke daftar transaksi</a></p>
</body>
</html>