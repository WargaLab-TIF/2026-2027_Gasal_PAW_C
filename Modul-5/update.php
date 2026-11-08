<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
    
    if (mysqli_query($koneksi, $update)) {
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
    <title>Edit Data Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #fff; margin: 30px; color: #333; }

        h2 { color: #337ab7; font-weight: normal; font-size: 24px; margin-bottom: 20px; }
        .header { border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 25px; }
        
        /* Form Layout */
        .form-group { display: flex; margin-bottom: 15px; align-items: center; }
        .form-group label { width: 100px; font-weight: bold; font-size: 14px; text-align: right; margin-right: 20px; }
        .form-group input { 
            width: 400px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; color: #555;
        }
        
        /* Tombol */
        .btn { padding: 8px 15px; text-decoration: none; color: white; border-radius: 3px; font-size: 14px; border: none; cursor: pointer; }
        .btn-update { background-color: #5cb85c; border: 1px solid #4cae4c; }
        .btn-batal { background-color: #d9534f; border: 1px solid #d43f3a; }
        
        .action-buttons { margin-left: 120px; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Edit Data Master Supplier</h2>
    </div>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" value="<?= $data['telp']; ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="<?= $data['alamat']; ?>" required>
        </div>
        
        <div class="action-buttons">
            <button type="submit" name="update" class="btn btn-update">Update</button>
            <a href="index.php" class="btn btn-batal">Batal</a>
        </div>
    </form>
</div>

</body>
</html>