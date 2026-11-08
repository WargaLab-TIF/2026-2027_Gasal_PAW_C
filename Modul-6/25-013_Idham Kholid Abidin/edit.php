<?php
include 'koneksi.php';

$id = (int) $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    if ($nama == "" || $telp == "" || $alamat == "") {
        die("Data gagal diperbarui. Lengkapi semua data. <a href='edit.php?id=$id'>Kembali</a>");
    }

    $nama = mysqli_real_escape_string($koneksi, $nama);
    $telp = mysqli_real_escape_string($koneksi, $telp);
    $alamat = mysqli_real_escape_string($koneksi, $alamat);

    $query = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = $id";
    mysqli_query($koneksi, $query);

    die("Data berhasil diperbarui. <a href='index.php?status=edit'>Kembali ke Data Supplier</a>");
}

$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id = $id");

if (mysqli_num_rows($data) == 0) {
    die("Data tidak ditemukan. <a href='index.php'>Kembali ke Data Supplier</a>");
}

$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Supplier</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2;
        }

        .kotak {
            width: 400px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 25px;
            border: 1px solid #cccccc;
            border-radius: 6px;
        }

        h2 {
            text-align: center;
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #999999;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .aksi {
            text-align: center;
        }

        .tombol {
            display: inline-block;
            padding: 8px 18px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .tombol-batal {
            background-color: gray;
        }
    </style>
</head>
<body>
    <div class="kotak">
        <h2>Edit Data Master Supplier</h2>

        <form action="edit.php?id=<?= $row['id'] ?>" method="post">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" maxlength="100" placeholder="Nama" value="<?= htmlspecialchars($row['nama']) ?>" required>

            <label for="telp">Telp</label>
            <input type="text" name="telp" id="telp" maxlength="12" placeholder="telp" value="<?= htmlspecialchars($row['telp']) ?>" required>

            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" placeholder="alamat" value="<?= htmlspecialchars($row['alamat']) ?>" required>

            <div class="aksi">
                <input type="submit" value="Update" class="tombol">
                <a href="index.php" class="tombol tombol-batal">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
