<?php
include 'koneksi.php';
$selectedId = isset($_GET['transaksi_id']) ? (int) $_GET['transaksi_id'] : 0;
$message = '';
$messageType = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_detail'])) {
    $transaksiId = (int) ($_POST['transaksi_id'] ?? 0);
    $barangId = (int) ($_POST['barang_id'] ?? 0);
    $qty = (int) ($_POST['qty'] ?? 0);
    $selectedId = $transaksiId;
    if ($transaksiId < 1 || $barangId < 1 || $qty < 1) {
        $message = 'Transaksi, barang, dan qty wajib diisi dengan benar.'; $messageType = 'error';
    } else {
        $cek = mysqli_prepare($koneksi, 'SELECT 1 FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?');
        mysqli_stmt_bind_param($cek, 'ii', $transaksiId, $barangId); mysqli_stmt_execute($cek);
        $sudahAda = mysqli_stmt_get_result($cek)->num_rows > 0; mysqli_stmt_close($cek);
        if ($sudahAda) { $message = 'Barang tersebut sudah ada pada transaksi yang dipilih.'; $messageType = 'error'; }
        else {
            $barang = mysqli_prepare($koneksi, 'SELECT harga FROM barang WHERE id = ?');
            mysqli_stmt_bind_param($barang, 'i', $barangId); mysqli_stmt_execute($barang);
            $barangData = mysqli_stmt_get_result($barang)->fetch_assoc(); mysqli_stmt_close($barang);
            if (!$barangData) { $message = 'Barang tidak ditemukan.'; $messageType = 'error'; }
            else {
                mysqli_begin_transaction($koneksi);
                $detail = mysqli_prepare($koneksi, 'INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)');
                mysqli_stmt_bind_param($detail, 'iiii', $transaksiId, $barangId, $barangData['harga'], $qty);
                $berhasil = mysqli_stmt_execute($detail); mysqli_stmt_close($detail);
                if ($berhasil) {
                    $total = mysqli_prepare($koneksi, 'UPDATE transaksi SET total = (SELECT COALESCE(SUM(harga * qty), 0) FROM transaksi_detail WHERE transaksi_id = ?) WHERE id = ?');
                    mysqli_stmt_bind_param($total, 'ii', $transaksiId, $transaksiId); $berhasil = mysqli_stmt_execute($total); mysqli_stmt_close($total);
                }
                if ($berhasil) { mysqli_commit($koneksi); $message = 'Detail transaksi berhasil ditambahkan dan total diperbarui.'; }
                else { mysqli_rollback($koneksi); $message = 'Detail transaksi gagal disimpan.'; $messageType = 'error'; }
            }
        }
    }
}
$transaksi = mysqli_query($koneksi, 'SELECT t.*, p.nama AS nama_pelanggan FROM transaksi t LEFT JOIN pelanggan p ON p.id = t.pelanggan_id ORDER BY t.id ASC');
$detail = []; $barangTersedia = [];
if ($selectedId > 0) {
    $detailQuery = mysqli_prepare($koneksi, 'SELECT d.*, b.kode_barang, b.nama_barang FROM transaksi_detail d JOIN barang b ON b.id = d.barang_id WHERE d.transaksi_id = ? ORDER BY b.nama_barang');
    mysqli_stmt_bind_param($detailQuery, 'i', $selectedId); mysqli_stmt_execute($detailQuery); $result = mysqli_stmt_get_result($detailQuery);
    while ($row = $result->fetch_assoc()) $detail[] = $row; mysqli_stmt_close($detailQuery);
    $barangQuery = mysqli_query($koneksi, 'SELECT b.id, b.kode_barang, b.nama_barang, b.harga FROM barang b WHERE NOT EXISTS (SELECT 1 FROM transaksi_detail d WHERE d.transaksi_id = ' . $selectedId . ' AND d.barang_id = b.id) ORDER BY b.nama_barang');
    while ($row = $barangQuery->fetch_assoc()) $barangTersedia[] = $row;
}
function rupiah($nilai) { return 'Rp ' . number_format((int) $nilai, 0, ',', '.'); }
?>
<!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Master-Detail Transaksi</title>
<style>*{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#f4f6f8;color:#17202a}main{width:min(1180px,calc(100% - 32px));margin:32px auto}h1{margin-bottom:6px}.subjudul{color:#59636e;margin-top:0}.panel{background:#fff;border:1px solid #d9dee3;border-radius:8px;padding:20px;margin-top:20px;overflow-x:auto}table{width:100%;border-collapse:collapse;min-width:650px}th,td{padding:11px 12px;border-bottom:1px solid #e5e8eb;text-align:left}th{background:#16324f;color:#fff}tr.selected{background:#e8f1f8}a,button{cursor:pointer}a{color:#155d8a}.button,button{display:inline-block;border:0;border-radius:5px;padding:10px 14px;background:#176b87;color:#fff;text-decoration:none;font-weight:bold}.button.secondary{background:#59636e}.notice{padding:12px 14px;border-radius:5px;margin:16px 0;background:#d9f3df;color:#145a25}.notice.error{background:#f9dddd;color:#8b1e1e}.form-grid{display:grid;grid-template-columns:1fr 130px auto;gap:12px;align-items:end}label{display:block;font-weight:bold;margin-bottom:6px}select,input{width:100%;padding:10px;border:1px solid #aeb7bf;border-radius:4px;background:white}.empty{color:#59636e;padding:8px 0}@media(max-width:700px){main{width:min(100% - 20px,1180px);margin:20px auto}.form-grid{grid-template-columns:1fr}.form-grid button{width:100%}}</style><style>body{margin:20px;background-color:#f2f2f2;color:black}main{width:100%;margin:0}.panel{background-color:#fff;border:0;border-radius:0;padding:20px}th{background-color:blue;font-size:18px;border:1px solid black}td{font-size:16px;border:1px solid black;color:black}.button,button{background-color:blue;border-radius:4px;padding:8px 14px;font-weight:normal}.button.secondary{background-color:blue}.button.tombol-detail{background-color:orange;padding:6px 12px;margin-bottom:0}.notice{border-radius:0;color:green}.notice.error{color:red}.subjudul{color:#333}</style></head><body><main>
<h1>Master-Detail Transaksi</h1><p class="subjudul">Pilih transaksi sebagai master untuk melihat dan menambah barang pada detailnya.</p><p><a class="button secondary" href="barang.php">Kelola Data Barang</a> <a class="button secondary" href="tambah.php">Kelola Supplier</a></p>
<?php if ($message): ?><div class="notice <?= $messageType === 'error' ? 'error' : '' ?>" role="alert"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<section class="panel"><h2>Data Master Transaksi</h2><table><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th><th>Total</th><th>Aksi</th></tr><?php while ($row = $transaksi->fetch_assoc()): ?><tr class="<?= $selectedId === (int) $row['id'] ? 'selected' : '' ?>"><td><?= (int) $row['id'] ?></td><td><?= htmlspecialchars($row['waktu_transaksi']) ?></td><td><?= htmlspecialchars($row['nama_pelanggan'] ?? '-') ?></td><td><?= htmlspecialchars($row['keterangan']) ?></td><td><?= rupiah($row['total']) ?></td><td><a class="button tombol-detail" href="index.php?transaksi_id=<?= (int) $row['id'] ?>">Detail</a></td></tr><?php endwhile; ?></table></section>
<?php if ($selectedId > 0): ?><section class="panel"><h2>Detail Transaksi #<?= $selectedId ?></h2><?php if ($barangTersedia): ?><form method="post" class="form-grid"><input type="hidden" name="transaksi_id" value="<?= $selectedId ?>"><div><label for="barang_id">Barang</label><select id="barang_id" name="barang_id" required><option value="">Pilih barang</option><?php foreach ($barangTersedia as $barang): ?><option value="<?= $barang['id'] ?>"><?= htmlspecialchars($barang['kode_barang'] . ' - ' . $barang['nama_barang']) ?> (<?= rupiah($barang['harga']) ?>)</option><?php endforeach; ?></select></div><div><label for="qty">Qty</label><input id="qty" name="qty" type="number" min="1" required></div><button type="submit" name="tambah_detail">Simpan Detail</button></form><?php else: ?><p class="empty">Semua barang yang tersedia sudah dimasukkan ke transaksi ini.</p><?php endif; ?><table><tr><th>Kode</th><th>Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr><?php if (!$detail): ?><tr><td colspan="5" class="empty">Belum ada detail untuk transaksi ini.</td></tr><?php endif; ?><?php foreach ($detail as $row): ?><tr><td><?= htmlspecialchars($row['kode_barang']) ?></td><td><?= htmlspecialchars($row['nama_barang']) ?></td><td><?= rupiah($row['harga']) ?></td><td><?= (int) $row['qty'] ?></td><td><?= rupiah($row['harga'] * $row['qty']) ?></td></tr><?php endforeach; ?></table></section><?php endif; ?></main></body></html>
