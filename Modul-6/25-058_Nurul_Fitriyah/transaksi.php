<?php
// transaksi.php
include 'koneksi.php';

$transaksi_id = isset($_GET['transaksi_id']) ? intval($_GET['transaksi_id']) : 0;

// PROSES INPUT DETAIL TRANSAKSI (Soal No 4)
if (isset($_POST['tambah_detail'])) {
    $barang_id = intval($_POST['barang_id']);
    $qty = intval($_POST['qty']);
    
    // Ambil harga asli barang saat ini
    $res_brg = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = $barang_id");
    $data_brg = mysqli_fetch_assoc($res_brg);
    $harga = $data_brg['harga'];
    
    // 1. Simpan ke tabel transaksi_detail
    mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ($transaksi_id, $barang_id, $harga, $qty)");
    
    // 2. Hitung ulang total dan update ke master transaksi (Otomatisasi Soal No 4)
    $res_total = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total_baru FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
    $data_total = mysqli_fetch_assoc($res_total);
    $total_baru = $data_total['total_baru'] ? $data_total['total_baru'] : 0;
    
    mysqli_query($koneksi, "UPDATE transaksi SET total = $total_baru WHERE id = $transaksi_id");
    
    header("Location: transaksi.php?transaksi_id=" . $transaksi_id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Master Detail Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .box { padding: 15px; border: 1px solid #333; background: #fafafa; margin-top: 10px; }
    </style>
</head>
<body>

    <!-- PART MASTER: Daftar Transaksi -->
    <h2>Data Master: Transaksi</h2>
    <table>
        <tr>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Keterangan</th>
            <th>Total Belanja</th>
            <th>Aksi</th>
        </tr>
        <?php
        $q_trans = mysqli_query($koneksi, "SELECT t.*, p.nama AS nama_pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id");
        while ($t = mysqli_fetch_assoc($q_trans)) {
            $selected = ($t['id'] == $transaksi_id) ? "style='background-color:#e0f7fa; font-weight:bold;'" : "";
            echo "<tr $selected>";
            echo "<td>" . $t['id'] . "</td>";
            echo "<td>" . $t['waktu_transaksi'] . "</td>";
            echo "<td>" . ($t['nama_pelanggan'] ?? 'Umum') . "</td>";
            echo "<td>" . $t['keterangan'] . "</td>";
            echo "<td>Rp " . number_format($t['total'], 0, ',', '.') . "</td>";
            echo "<td><a href='transaksi.php?transaksi_id=" . $t['id'] . "'>Pilih / Detail</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- PART DETAIL: Tampil hanya jika transaksi telah dipilih -->
    <?php if ($transaksi_id > 0): 
        $q_master = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = $transaksi_id");
        $master = mysqli_fetch_assoc($q_master);
    ?>
        <hr>
        <h2>Data Detail untuk Transaksi ID: #<?= $transaksi_id; ?></h2>
        <p>Keterangan Master: <strong><?= $master['keterangan']; ?></strong> | Total Sementara: <strong>Rp <?= number_format($master['total'], 0, ',', '.'); ?></strong></p>
        
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            <?php
            $q_detail = mysqli_query($koneksi, "SELECT td.*, b.nama_barang FROM transaksi_detail td JOIN barang b ON td.barang_id = b.id WHERE td.transaksi_id = $transaksi_id");
            if (mysqli_num_rows($q_detail) == 0) {
                echo "<tr><td colspan='4'>Belum ada item barang dalam transaksi ini.</td></tr>";
            } else {
                while ($d = mysqli_fetch_assoc($q_detail)) {
                    echo "<tr>";
                    echo "<td>" . $d['nama_barang'] . "</td>";
                    echo "<td>Rp " . number_format($d['harga'], 0, ',', '.') . "</td>";
                    echo "<td>" . $d['qty'] . "</td>";
                    echo "<td>Rp " . number_format($d['harga'] * $d['qty'], 0, ',', '.') . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

        <!-- Form Input Detail Transaksi (Soal No 2) -->
        <div class="box">
            <h3>Tambah Item Barang</h3>
            <form action="" method="POST">
                <label>Pilih Barang:</label>
                <select name="barang_id" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php
                    // SQL anti-duplikasi: Mengeliminasi barang yang sudah ada di transaksi_detail milik transaksi terkait (Soal No 2)
                    $q_brg_ready = "SELECT id, kode_barang, nama_barang, harga FROM barang 
                                    WHERE id NOT IN (
                                        SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id
                                    )";
                    $res_brg_ready = mysqli_query($koneksi, $q_brg_ready);
                    
                    while ($b = mysqli_fetch_assoc($res_brg_ready)) {
                        echo "<option value='" . $b['id'] . "'>" . $b['kode_barang'] . " - " . $b['nama_barang'] . " (Rp " . $b['harga'] . ")</option>";
                    }
                    ?>
                </select>

                <label style="margin-left: 15px;">Jumlah (Qty):</label>
                <input type="number" name="qty" min="1" value="1" required style="width: 60px;">

                <button type="submit" name="tambah_detail" style="margin-left: 15px; background: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">Simpan Detail</button>
            </form>
        </div>
    <?php endif; ?>

</body>
</html>