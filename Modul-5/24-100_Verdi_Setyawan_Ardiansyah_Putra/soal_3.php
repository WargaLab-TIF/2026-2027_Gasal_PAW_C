<?php
$host = "localhost";
$username = "root";
$pass = "";
$database = "db_penjualan";

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect($host, $username, $pass, $database);

    $query_supplier = "SELECT id, nama, telp, alamat
                       FROM supplier
                       ORDER BY id ASC";
    $result = mysqli_query($conn, $query_supplier);
} catch (mysqli_sql_exception $e) {
    die("Koneksi atau pengambilan data gagal: " . htmlspecialchars($e->getMessage()));
}

$status = $_GET["status"] ?? "";
$status_message = "";
$status_class = "";

if ($status === "added") {
    $status_message = "Data supplier berhasil ditambahkan.";
    $status_class = "success";
} elseif ($status === "updated") {
    $status_message = "Data supplier berhasil diperbarui.";
    $status_class = "success";
} elseif ($status === "deleted") {
    $status_message = "Data supplier berhasil dihapus.";
    $status_class = "success";
} elseif ($status === "notfound") {
    $status_message = "Data supplier tidak ditemukan atau sudah dihapus.";
    $status_class = "error";
} elseif ($status === "related") {
    $status_message = "Data supplier tidak dapat dihapus karena masih digunakan pada tabel barang. Ubah atau hapus data barang yang terkait terlebih dahulu.";
    $status_class = "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Master Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; color: #333; }
        h2 { color: #428bca; font-weight: normal; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #d9edf7; padding: 12px; text-align: left; }
        td { border: 1px solid #ddd; padding: 12px; }
        .btn { display: inline-block; padding: 8px 12px; color: white; text-decoration: none; border: 0; border-radius: 4px; font-size: 13px; cursor: pointer; }
        .tambah { background: #5cb85c; }
        .edit { background: #f0ad4e; }
        .hapus { background: #d9534f; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .status { padding: 10px 12px; margin: 0 0 18px; border-radius: 4px; }
        .success { color: #3c763d; background: #dff0d8; border: 1px solid #d6e9c6; }
        .error { color: #a94442; background: #f2dede; border: 1px solid #ebccd1; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Master Supplier</h2>
        <a href="soal_4.php" class="btn tambah">Tambah Data</a>
    </div>

    <?php if ($status_message !== ""): ?>
        <p class="status <?= htmlspecialchars($status_class); ?>">
            <?= htmlspecialchars($status_message); ?>
        </p>
    <?php endif; ?>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row["nama"]); ?></td>
                    <td><?= htmlspecialchars($row["telp"]); ?></td>
                    <td><?= htmlspecialchars($row["alamat"]); ?></td>
                    <td>
                        <a href="soal_5.php?id=<?= urlencode((string)$row["id"]); ?>" class="btn edit">Edit</a>

                        <form action="soal_6.php" method="POST" style="display:inline;"
                              onsubmit="return confirm('Anda yakin akan menghapus supplier ini?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars((string)$row["id"]); ?>">
                            <button type="submit" class="btn hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada data supplier.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>