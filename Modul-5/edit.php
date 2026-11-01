<?php
include "koneksi.php";

$id = (int) $_GET["id"];

// Jika tombol Update ditekan
if (isset($_POST["update"])) {
    $nama   = $_POST["nama"];
    $telp   = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $stmt = $conn->prepare("UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nama, $telp, $alamat, $id);
    $stmt->execute();

    header("Location: index.php?pesan=update");
    exit;
}

// Ambil data supplier yang akan diedit
$query_supplier  = "SELECT * FROM supplier WHERE id = $id";
$supplier_result = mysqli_query($conn, $query_supplier);

if (mysqli_num_rows($supplier_result) == 0) {
    header("Location: index.php");
    exit;
}

$row = mysqli_fetch_assoc($supplier_result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Data Master Supplier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-wrap">
        <h2 class="judul">Edit Data Master Supplier</h2>
        <hr>

        <form method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($row["nama"]) ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Telp</label>
                <div class="col-sm-9">
                    <input type="text" name="telp" class="form-control pendek" maxlength="12" value="<?= htmlspecialchars($row["telp"]) ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-9">
                    <input type="text" name="alamat" class="form-control pendek" value="<?= htmlspecialchars($row["alamat"]) ?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <a href="index.php" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
