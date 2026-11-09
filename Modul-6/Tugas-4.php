<?php
include 'koneksi.php';

// ===== HALAMAN DETAIL (jika ada ?id=) =====
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // simpan detail transaksi
    if (isset($_POST['simpan'])) {
        $barang_id = (int)$_POST['barang_id'];
        $qty       = (int)$_POST['qty'];

        $b = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = $barang_id"));
        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ($id, $barang_id, {$b['harga']}, $qty)");

        // ===== SOAL 4: hitung ulang total, simpan ke kolom total transaksi =====
        mysqli_query($koneksi, "UPDATE transaksi SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = $id) WHERE id = $id");

        header("Location: Tugas-4.php?id=$id");
        exit;
    }

    // MASTER
    $master = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN pelanggan ON pelanggan.id = transaksi.pelanggan_id WHERE transaksi.id = $id"));

    // DETAIL
    $detail = mysqli_query($koneksi, "SELECT barang.nama_barang, transaksi_detail.harga, transaksi_detail.qty FROM transaksi_detail JOIN barang ON barang.id = transaksi_detail.barang_id WHERE transaksi_detail.transaksi_id = $id");

    // barang yang sudah dipakai di transaksi ini
    $dipakai = [];
    $cek = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $id");
    while ($c = mysqli_fetch_assoc($cek)) {
        $dipakai[] = $c['barang_id'];
    }

    // semua barang untuk dropdown
    $barang = mysqli_query($koneksi, "SELECT id, nama_barang, harga FROM barang");
    ?>
    <style>a, a:visited { color: blue; }</style>

    <h2>Transaksi #<?= $master['id'] ?></h2>
    <p>Tanggal: <?= $master['waktu_transaksi'] ?><br>
       Pelanggan: <?= $master['nama'] ?><br>
       Keterangan: <?= $master['keterangan'] ?><br>
       Total: <?= $master['total'] ?></p>

    <h3>Detail</h3>
    <table border="1" cellpadding="5">
      <tr><th>Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
      <?php while ($d = mysqli_fetch_assoc($detail)) { ?>
      <tr>
        <td><?= $d['nama_barang'] ?></td>
        <td><?= $d['harga'] ?></td>
        <td><?= $d['qty'] ?></td>
        <td><?= $d['harga'] * $d['qty'] ?></td>
      </tr>
      <?php } ?>
    </table>

    <h3>Tambah Detail</h3>
    <form method="post">
      Barang:
      <select name="barang_id" required>
        <option value="">-- pilih barang --</option>
        <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
          <option value="<?= $b['id'] ?>" <?= in_array($b['id'], $dipakai) ? 'disabled' : '' ?>>
            <?= $b['nama_barang'] ?> (<?= $b['harga'] ?>)
          </option>
        <?php } ?>
      </select>
      Qty: <input type="number" name="qty" min="1" value="1" required>
      <button type="submit" name="simpan">Simpan</button>
    </form>
    <a href="Tugas-4.php">Kembali</a>
    <?php
    exit;
}

// ===== HALAMAN MASTER (daftar transaksi) =====
$data = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama FROM transaksi JOIN pelanggan ON pelanggan.id = transaksi.pelanggan_id");
?>
<style>a, a:visited { color: blue; }</style>

<h2>Data Transaksi</h2>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th><th>Total</th><th>Aksi</th></tr>
  <?php while ($r = mysqli_fetch_assoc($data)) { ?>
  <tr>
    <td><?= $r['id'] ?></td>
    <td><?= $r['waktu_transaksi'] ?></td>
    <td><?= $r['nama'] ?></td>
    <td><?= $r['keterangan'] ?></td>
    <td><?= $r['total'] ?></td>
    <td><a href="Tugas-4.php?id=<?= $r['id'] ?>">Detail</a></td>
  </tr>
  <?php } ?>
</table>