<?php
$host = "localhost";
$username = "root";
$pass = "";
$database = "db_penjualan";

$error = "";
$nama = "";
$telp = "";
$alamat = "";

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect($host, $username, $pass, $database);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama = trim($_POST["nama"] ?? "");
        $telp = trim($_POST["telp"] ?? "");
        $alamat = trim($_POST["alamat"] ?? "");

        if ($nama === "" || $telp === "" || $alamat === "") {
            $error = "Semua data harus diisi.";
        } else {
            $query = mysqli_prepare(
                $conn,
                "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)"
            );
            mysqli_stmt_bind_param($query, "sss", $nama, $telp, $alamat);
            mysqli_stmt_execute($query);
            mysqli_stmt_close($query);

            header("Location: soal_3.php?status=added");
            exit;
        }
    }
} catch (mysqli_sql_exception $e) {
    $error = "Gagal menyimpan data: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #ffffff; margin: 0; padding: 30px; color: #333; }
        .container { max-width: 600px; margin: 30px auto; }
        h2 { color: #428bca; font-size: 24px; font-weight: normal; margin-bottom: 25px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 7px; font-size: 14px; }
        input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
        input:focus { outline: none; border-color: #66afe9; }
        .btn { display: inline-block; padding: 9px 15px; border: none; border-radius: 4px; color: white; text-decoration: none; font-size: 14px; cursor: pointer; }
        .btn-simpan { background: #5cb85c; }
        .btn-batal { background: #d9534f; }
        .error { color: #d9534f; margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Data Master Supplier Baru</h2>

    <?php if ($error !== ""): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="soal_4.php" method="POST">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" maxlength="100"
                   placeholder="Masukkan nama supplier"
                   value="<?= htmlspecialchars($nama); ?>" required>
        </div>

        <div class="form-group">
            <label for="telp">Telp</label>
            <input type="text" id="telp" name="telp" maxlength="12"
                   placeholder="Masukkan nomor telepon"
                   value="<?= htmlspecialchars($telp); ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat"
                   placeholder="Masukkan alamat supplier"
                   value="<?= htmlspecialchars($alamat); ?>" required>
        </div>

        <button type="submit" class="btn btn-simpan">Simpan</button>
        <a href="soal_3.php" class="btn btn-batal">Batal</a>
    </form>
</div>
</body>
</html>