<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Master-Detail Transaksi</title></head>
<body>
    <h2>Master: Data Transaksi</h2>
    <a href="barang.php">Kelola Data Barang</a><br><br>

    <form method="GET" action="">
        <label>Pilih Transaksi: </label>
        <select name="transaksi_id" onchange="this.form.submit()">
            <option value="">-- Pilih Transaksi --</option>
            <?php
            $q_transaksi = mysqli_query($conn, "SELECT t.id, t.waktu_transaksi, p.nama, t.total FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.id");
            $selected_id = isset($_GET['transaksi_id']) ? $_GET['transaksi_id'] : '';
            
            while($t = mysqli_fetch_assoc($q_transaksi)){
                $sel = ($t['id'] == $selected_id) ? 'selected' : '';
                echo "<option value='{$t['id']}' $sel>TRX-{$t['id']} | {$t['nama']} | Rp ".number_format($t['total'],0,',','.')."</option>";
            }
            ?>
        </select>
    </form>

    <?php if($selected_id): ?>
    <hr>
    <h3>Detail Transaksi (TRX-<?php echo $selected_id; ?>)</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $q_detail = mysqli_query($conn, "SELECT d.*, b.nama_barang FROM transaksi_detail d JOIN barang b ON d.barang_id = b.id WHERE d.transaksi_id = '$selected_id'");
        $total_semua = 0;
        while($d = mysqli_fetch_assoc($q_detail)){
            $subtotal = $d['harga'] * $d['qty'];
            $total_semua += $subtotal;
            echo "<tr>
                    <td>{$d['nama_barang']}</td>
                    <td>Rp ".number_format($d['harga'],0,',','.')."</td>
                    <td>{$d['qty']}</td>
                    <td>Rp ".number_format($subtotal,0,',','.')."</td>
                  </tr>";
        }
        ?>
        <tr>
            <td colspan="3" align="right"><b>Total</b></td>
            <td><b>Rp <?php echo number_format($total_semua,0,',','.'); ?></b></td>
        </tr>
    </table>

    <br>
    <h4>Tambah Detail Baru</h4>
    <form method="POST" action="tambah_detail.php">
        <input type="hidden" name="transaksi_id" value="<?php echo $selected_id; ?>">
        <label>Pilih Barang:</label>
        <select name="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php
            $q_barang = mysqli_query($conn, "
                SELECT * FROM barang 
                WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = '$selected_id')
            ");
            while($b = mysqli_fetch_assoc($q_barang)){
                echo "<option value='{$b['id']}'>{$b['nama_barang']} - Rp ".number_format($b['harga'],0,',','.')."</option>";
            }
            ?>
        </select>
        <label>Qty:</label>
        <input type="number" name="qty" min="1" required>
        <button type="submit">Tambah Detail</button>
    </form>
    <?php endif; ?>
</body>
</html>