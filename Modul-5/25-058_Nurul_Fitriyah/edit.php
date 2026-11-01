<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id = '$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($koneksi, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
    if ($update) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data Master Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .form-group { margin-bottom: 15px; width: 400px; }
        label { display: inline-block; width: 100px; }
        input, textarea { width: 280px; padding: 6px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 8px 15px; border: none; color: white; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .btn-update { background-color: #5cb85c; }
        .btn-batal { background-color: #d9534f; margin-left: 5px; }
    </style>
</head>
<body>

    <h2>Edit Data Master Supplier</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label>Telp</label>
            <input type="text" name="telp" value="<?= htmlspecialchars($data['telp']); ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" rows="3" required><?= htmlspecialchars($data['alamat']); ?></textarea>
        </div>
        <div style="margin-left: 100px;">
            <button type="submit" name="update" class="btn btn-update">Update</button>
            <a href="index.php" class="btn btn-batal">Batal</a>
        </div>
    </form>

</body>
</html>