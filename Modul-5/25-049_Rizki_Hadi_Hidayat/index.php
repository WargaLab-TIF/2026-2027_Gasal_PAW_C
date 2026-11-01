<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    <h2>Data Master Supplier</h2>
    <a href="tambah.php" >Tambah Data</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <tr style="background-color: #d9edf7;">
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM supplier");
        $no = 1;
        while($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td style="text-align:center;"><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['telp']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td style="text-align:center;">
                <a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a>
                <a href="hapus.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>