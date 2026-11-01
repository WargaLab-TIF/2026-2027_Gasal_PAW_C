<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
    if ($insert) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menambah data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Data Master Supplier Baru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .form-group { margin-bottom: 15px; width: 400px; }
        label { display: inline-block; width: 100px; }
        input, textarea { width: 280px; padding: 6px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 8px 15px; border: none; color: white; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .btn-simpan { background-color: #5cb85c; }
        .btn-batal { background-color: #d9534f; margin-left: 5px; }
    </style>
</head>
<body>

    <h2>Tambah Data Master Supplier Baru</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" placeholder="telp" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" placeholder="alamat" rows="3" required></textarea>
        </div>
        <div style="margin-left: 100px;">
            <button type="submit" name="simpan" class="btn btn-simpan">Simpan</button>
            <a href="index.php" class="btn btn-batal">Batal</a>
        </div>
    </form>

</body>
</html>