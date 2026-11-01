<?php
include "koneksi.php";

if (isset($_POST["simpan"])) {
    $nama   = $_POST["nama"];
    $telp   = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $stmt = $conn->prepare("INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $telp, $alamat);
    $stmt->execute();

    header("Location: index.php?pesan=tambah");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Data Master Supplier Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-wrap">
        <h2 class="judul">Tambah Data Master Supplier Baru</h2>
        <hr>

        <form method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Telp</label>
                <div class="col-sm-9">
                    <input type="text" name="telp" class="form-control pendek" placeholder="telp" maxlength="12" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-9">
                    <input type="text" name="alamat" class="form-control pendek" placeholder="alamat" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
