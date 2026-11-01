<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$supplier = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "UPDATE supplier SET
        nama='$nama',
        telp='$telp',
        alamat='$alamat'
        WHERE id='$id'");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Supplier</title>
</head>
<body>

<h2>Edit Data Supplier</h2>

<form method="post">
    Nama:
    <input type="text" name="nama"
        value="<?= htmlspecialchars($supplier['nama']) ?>" required>
    <br><br>

    Telp:
    <input type="text" name="telp"
        value="<?= htmlspecialchars($supplier['telp']) ?>">
    <br><br>

    Alamat:
    <input type="text" name="alamat"
        value="<?= htmlspecialchars($supplier['alamat']) ?>">
    <br><br>

    <button type="submit" name="update">Update</button>
    <a href="index.php">Batal</a>
</form>

</body>
</html>