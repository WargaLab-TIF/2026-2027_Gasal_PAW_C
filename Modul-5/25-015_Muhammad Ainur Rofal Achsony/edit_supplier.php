<?php
include "koneksi.php";

$id = intval($_GET["id"]);
$data = mysqli_query($conn, "SELECT * FROM supplier WHERE id = $id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST["update"])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST["nama"]));
    $telp = mysqli_real_escape_string($conn, trim($_POST["telp"]));
    $alamat = mysqli_real_escape_string($conn, trim($_POST["alamat"]));

    if ($nama == "") {
        $error = "Nama wajib diisi.";
    } else {
        $sql = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = $id";
        $update = mysqli_query($conn, $sql);

        if ($update) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Data gagal diperbarui.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        h1,
        h2 {
            color: #2e7d7a;
            font-size: 24px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            padding: 10px;
            border: 1px solid #eee;
        }
        th {
            background: #d6eef8;
            color: #333;
            text-align: left;
            font-weight: normal;
        }
        .btn {
            display: inline-block;
            padding: 6px 14px;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-green {
            background: #7cb342;
        }
        .btn-orange {
            background: #e65100;
        }
        .btn-red {
            background: #b71c1c;
        }
        .alert {
            margin-bottom: 15px;
            padding: 10px;
            background: #fdeaea;
            color: #b71c1c;
        }
        label {
            display: inline-block;
            width: 80px;
            vertical-align: top;
        }
        input,
        textarea {
            width: 300px;
            padding: 6px;
            margin-bottom: 10px;
        }
        .form-actions {
            margin-left: 84px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="head">
        <h1>Edit Data Master Supplier</h1>
    </div>

    <?php if ($error != "") { ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php } ?>

    <form class="form" method="post" action="edit_supplier.php?id=<?php echo $id; ?>">
        <div class="form-row">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row["nama"]); ?>" maxlength="100" required>
        </div>
        <div class="form-row">
            <label for="telp">Telp</label>
            <input type="text" id="telp" name="telp" value="<?php echo htmlspecialchars($row["telp"]); ?>" maxlength="12">
        </div>
        <div class="form-row">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat"><?php echo htmlspecialchars($row["alamat"]); ?></textarea>
        </div>
        <div class="form-actions">
            <button class="btn btn-green" type="submit" name="update">Update</button>
            <a class="btn btn-red" href="index.php">Batal</a>
        </div>
    </form>

</div>
</body>
</html>
