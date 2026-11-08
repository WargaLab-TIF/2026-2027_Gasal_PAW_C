<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #fff; margin: 30px; color: #333; }

        h2 { color: #337ab7; font-weight: normal; font-size: 24px; margin-bottom: 20px; }

        .header { border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 25px; }
        
        .form-group { display: flex; margin-bottom: 15px; align-items: center; }

        .form-group label { width: 100px; font-weight: bold; font-size: 14px; text-align: right; margin-right: 20px; }

        .form-group input { 
            width: 400px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;}
        .form-group input::placeholder { color: #999; }

        .btn { padding: 8px 15px; text-decoration: none; color: white; border-radius: 3px; font-size: 14px; border: none; cursor: pointer; }

        .btn-simpan { background-color: #5cb85c; border: 1px solid #4cae4c; }

        .btn-batal { background-color: #d9534f; border: 1px solid #d43f3a; }
        
        .action-buttons { margin-left: 120px; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Tambah Data Master Supplier Baru</h2>
    </div>

    <form method="POST" action="">
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
            <input type="text" name="alamat" placeholder="alamat" required>
        </div>
        
        <div class="action-buttons">
            <button type="submit" name="simpan" class="btn btn-simpan">Simpan</button>
            <a href="index.php" class="btn btn-batal">Batal</a>
        </div>
    </form>
</div>

</body>
</html>
