<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data</title>
</head>
<body>
<h2>Tambah Data Supplier Baru</h2>
<form method="POST" action="simpan.php">
    <table cellpadding="8">
        <tr>
            <td><label for="nama">Nama Supplier</label></td>
            <td><input type="text" name="nama" id="nama" placeholder="Masukkan nama supplier" required></td>
        </tr>
        <tr>
            <td><label for="telp">Telepon</label></td>
            <td><input type="text" name="telp" id="telp" placeholder="Masukkan nomor telepon" required></td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td><input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat supplier" required></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Simpan</button>
                <a href="data.php">Batal</a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>