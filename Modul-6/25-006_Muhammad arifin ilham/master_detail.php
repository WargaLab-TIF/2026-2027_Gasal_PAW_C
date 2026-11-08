<?php
include 'koneksi.php';

$transaksi_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$pesan_error  = '';

if (isset($_POST['tambah_detail'])) {
    $barang_id = intval($_POST['barang_id']);
    $qty       = intval($_POST['qty']);

    if ($qty < 1) {
        $pesan_error = 'Qty minimal 1.';
    } else {
        $q_brg = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = $barang_id");

        if ($row_brg = mysqli_fetch_assoc($q_brg)) {
            $harga = $row_brg['harga'];

            $insert = mysqli_query($koneksi,
                "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                 VALUES ($transaksi_id, $barang_id, $harga, $qty)");

            if ($insert) {
                // Soal 4: hitung ulang total transaksi dari seluruh detailnya
                mysqli_query($koneksi,
                    "UPDATE transaksi
                     SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = $transaksi_id)
                     WHERE id = $transaksi_id");

                header("Location: master_detail.php?id=" . $transaksi_id);
                exit;
            } else {
                $pesan_error = 'Gagal menambahkan barang (kemungkinan sudah ada di transaksi ini).';
            }
        } else {
            $pesan_error = 'Barang tidak ditemukan.';
        }
    }
}

// Data master transaksi
$q_master = mysqli_query($koneksi,
    "SELECT t.*, p.nama AS nama_pelanggan
     FROM transaksi t
     LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
     WHERE t.id = $transaksi_id");
$master = mysqli_fetch_assoc($q_master);

// Daftar semua transaksi (untuk dropdown navigasi)
$q_all_transaksi = mysqli_query($koneksi, "SELECT id, waktu_transaksi FROM transaksi ORDER BY id ASC");

// Barang yang sudah ada di transaksi ini (agar di-disabled di dropdown)
$used_barang = [];
$q_used = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
while ($r_used = mysqli_fetch_assoc($q_used)) {
    $used_barang[] = $r_used['barang_id'];
}

$q_barang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang ASC");

// Detail transaksi
$q_detail = mysqli_query($koneksi,
    "SELECT td.*, b.kode_barang, b.nama_barang
     FROM transaksi_detail td
     JOIN barang b ON td.barang_id = b.id
     WHERE td.transaksi_id = $transaksi_id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master-Detail Transaksi</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 30px; background-color: #f4f6f9; color: #333; }
        .container { max-width: 900px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2, h3 { color: #2c3e50; border-bottom: 2px solid #ecf0f1; padding-bottom: 8px; }
        .menu-link { margin-right: 15px; font-weight: bold; }
        .nav-transaksi { margin-bottom: 20px; padding: 10px; background: #eef2f7; border-radius: 5px; }
        .master-info { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px; background: #f8f9fa; padding: 15px; border-left: 4px solid #3498db; border-radius: 4px; }
        .master-info p { margin: 5px 0; }
        .form-detail { margin-bottom: 15px; }
        .form-detail select { width: 60%; padding: 8px; margin-top: 5px; }
        .form-detail input[type="number"] { width: 60px; padding: 8px; }
        .btn-simpan { background-color: #2ecc71; color: white; border: none; padding: 9px 15px; cursor: pointer; font-weight: bold; border-radius: 4px; margin-left: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #34495e; color: white; }
        .total-row { font-weight: bold; background-color: #e8f8f5 !important; }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Master-Detail Transaksi Penjualan</h2>

    <div style="margin-bottom: 15px;">
        <a href="master.php" class="menu-link">&laquo; Daftar Master</a>
        <a href="barang.php" class="menu-link">Kelola Barang</a>
    </div>

    <!-- Navigasi Master Transaksi -->
    <div class="nav-transaksi">
        <form method="GET" action="master_detail.php">
            <label for="select_id"><strong>Pilih ID Master Transaksi:</strong></label>
            <select name="id" id="select_id" onchange="this.form.submit()" style="width: 200px; padding: 8px;">
                <?php while ($t = mysqli_fetch_assoc($q_all_transaksi)): ?>
                    <option value="<?= $t['id']; ?>" <?= $t['id'] == $transaksi_id ? 'selected' : ''; ?>>
                        Transaksi #<?= $t['id']; ?> (<?= $t['waktu_transaksi']; ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

    <?php if ($master): ?>

        <!-- MASTER -->
        <div class="master-info">
            <div>
                <p><strong>ID Transaksi:</strong> #<?= $master['id']; ?></p>
                <p><strong>Tanggal Transaksi:</strong> <?= $master['waktu_transaksi']; ?></p>
            </div>
            <div>
                <p><strong>Pelanggan:</strong> <?= htmlspecialchars($master['nama_pelanggan'] ?? 'Umum'); ?></p>
                <p><strong>Keterangan:</strong> <?= htmlspecialchars($master['keterangan']); ?></p>
            </div>
        </div>

        <!-- FORM TAMBAH DETAIL -->
        <?php if ($pesan_error !== ''): ?>
            <script>alert(<?= json_encode($pesan_error); ?>);</script>
        <?php endif; ?>

        <h3>Tambah Detail Barang</h3>
        <form method="POST" action="">
            <div class="form-detail">
                <label for="barang_id"><strong>Pilih Barang:</strong></label><br>
                <select name="barang_id" id="barang_id" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php while ($b = mysqli_fetch_assoc($q_barang)):
                        $sudah_dipakai = in_array($b['id'], $used_barang);
                    ?>
                        <option value="<?= $b['id']; ?>" <?= $sudah_dipakai ? 'disabled' : ''; ?>>
                            <?= $b['kode_barang']; ?> - <?= htmlspecialchars($b['nama_barang']); ?>
                            (Rp <?= number_format($b['harga'], 0, ',', '.'); ?>)<?= $sudah_dipakai ? ' (Sudah Ditambahkan)' : ''; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="qty" style="margin-left: 10px;"><strong>Qty:</strong></label>
                <input type="number" name="qty" id="qty" value="1" min="1" required>

                <button type="submit" name="tambah_detail" class="btn-simpan">Simpan Detail</button>
            </div>
        </form>

        <!-- DETAIL -->
        <h3>Detail Items Transaksi #<?= $transaksi_id; ?></h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (mysqli_num_rows($q_detail) > 0): ?>
                    <?php while ($d = mysqli_fetch_assoc($q_detail)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $d['kode_barang']; ?></td>
                            <td><?= htmlspecialchars($d['nama_barang']); ?></td>
                            <td>Rp <?= number_format($d['harga'], 0, ',', '.'); ?></td>
                            <td><?= $d['qty']; ?></td>
                            <td>Rp <?= number_format($d['harga'] * $d['qty'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: #7f8c8d;">Belum ada item detail.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" style="text-align: right;"><strong>Total Transaksi:</strong></td>
                    <td><strong>Rp <?= number_format($master['total'], 0, ',', '.'); ?></strong></td>
                </tr>
            </tfoot>
        </table>

    <?php else: ?>
        <p style="color: red;">Data transaksi tidak ditemukan!</p>
    <?php endif; ?>
</div>

</body>
</html>