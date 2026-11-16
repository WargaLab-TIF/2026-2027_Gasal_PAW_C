<?php
$host = "localhost";
$username = "root";
$pass = "";
$database = "db_penjualan";

$error = "";
$supplier = null;

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect($host, $username, $pass, $database);

    $id = (int)($_POST["id"] ?? $_GET["id"] ?? 0);

    if ($id <= 0) {
        $error = "ID supplier tidak valid.";
    } else {
        $query = mysqli_prepare(
            $conn,
            "SELECT id, nama, telp, alamat FROM supplier WHERE id = ?"
        );
        mysqli_stmt_bind_param($query, "i", $id);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $supplier = mysqli_fetch_assoc($result);
        mysqli_stmt_close($query);

        if (!$supplier) {
            $error = "Data supplier tidak ditemukan.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && $supplier) {
        $nama = trim($_POST["nama"] ?? "");
        $telp = trim($_POST["telp"] ?? "");
        $alamat = trim($_POST["alamat"] ?? "");

        $supplier["nama"] = $nama;
        $supplier["telp"] = $telp;
        $supplier["alamat"] = $alamat;

        if ($nama === "" || $telp === "" || $alamat === "") {
            $error = "Semua data harus diisi.";
        } else {
            $query = mysqli_prepare(
                $conn,
                "UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?"
            );
            mysqli_stmt_bind_param($query, "sssi", $nama, $telp, $alamat, $id);
            mysqli_stmt_execute($query);
            mysqli_stmt_close($query);

            header("Location: soal_3.php?status=updated");
            exit;
        }
    }
} catch (mysqli_sql_exception $e) {
    $error = "Gagal memperbarui data: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
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
    <h2>Edit Data Master Supplier</h2>

    <?php if ($error !== ""): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($supplier): ?>
        <form action="soal_5.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars((string)$supplier["id"]); ?>">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" maxlength="100"
                       placeholder="Masukkan nama supplier"
                       value="<?= htmlspecialchars($supplier["nama"]); ?>" required>
            </div>

            <div class="form-group">
                <label for="telp">Telp</label>
                <input type="number" id="telp" name="telp" maxlength="12"
                       placeholder="Masukkan nomor telepon"
                       value="<?= htmlspecialchars($supplier["telp"]); ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat"
                       placeholder="Masukkan alamat supplier"
                       value="<?= htmlspecialchars($supplier["alamat"]); ?>" required>
            </div>

            <button type="submit" class="btn btn-simpan">Update</button>
            <a href="soal_3.php" class="btn btn-batal">Batal</a>
        </form>
    <?php endif; ?>
</div>
</body>
</html>