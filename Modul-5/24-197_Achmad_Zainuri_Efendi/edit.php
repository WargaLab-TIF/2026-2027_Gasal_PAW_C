<?php
include 'koneksi.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM supplier WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    mysqli_query($conn, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Edit Data Master Supplier</h2>
    <form method="POST">
        <table>
            <tr><td>Nama</td><td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" required></td></tr>
            <tr><td>Telp</td><td><input type="text" name="telp" value="<?php echo $data['telp']; ?>" required></td></tr>
            <tr><td>Alamat</td><td><input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required></td></tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="update" style="background:#5cb85c; color:white;">Update</button>
                    <a href="index.php" style="background:#d9534f; color:white; padding: 2px 5px; text-decoration:none;">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>