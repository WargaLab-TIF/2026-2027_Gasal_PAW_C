    
<?php
include 'koneksi.php';
$data = get_transaksi($koneksi);
if (isset($_POST['barang'])) {
    header("Location: barang.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul 06</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
        }
        #tb-daftar {
            border-collapse: collapse;
            width: 60%;
            border-radius: 10px;
        }
        #tb-daftar th, #tb-daftar td {
            border: 1px solid white; /* Garis warna putih */
            padding: 10px;
        }
        #tb-daftar thead td {
            border: 1px solid white;
        }
        #daftar {
            background-color: darkcyan;
            color: white;
            text-align: center;
        }
        #detail-button {
            background: #059669; 
            border: none; 
            border-radius: 5px; 
            color: white;
            padding: 5px 10px;
        }
        #hapus-button {
            display: inline-block;
            background: red; 
            border: none; 
            border-radius: 5px; 
            color: white;
            padding: 5px 10px;
        }
        #barang-button {
            background: #2563EB; 
            border: none; 
            border-radius: 5px; 
            color: white;
            width: 140px;
            height: 30px;
        } 
        #tambahBarang-button {
            background: #047857; 
            border: none; 
            border-radius: 5px; 
            color: white;
            width: 120px;
            height: 30px;
        }
        #barang-button:hover {
            background-color: #1D4ED8;
        }
        #detail-button:hover {
            background-color: #047857;
        }
        #hapus-button:hover {
            background-color: #B91C1C;
        }
        a {
            text-decoration: none   ;
        }
    </style>
</head>
<body>
    <center>
    <h1>DAFTAR TRANSAKSI</h1>
    <table border="0" cellpadding="5" cellspacing="0" id="tb-daftar">
        <thead id="daftar">
            <tr>
                <td>No</td>
                <td>ID</td>
                <td>Waktu Transaksi</td>
                <td>Nama Pelanggan</td>
                <td>Keterangan</td>
                <td>Total Harga</td>
                <td>Metode Transaksi</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php foreach ($data as $d): ?>
                <tr>
                    <td> <?= $no ?>.</td>
                    <td> <?= $d['id'] ?></td>
                    <td> <?= $d['waktu_transaksi'] ?></td>  
                    <td> <?= $d['nama'] ?></td>
                    <td> <?= $d['keterangan'] ?></td>
                    <td> <?= $d['total'] ?></td>
                    <td> <?= $d['metode'] ?></td>
                    <td>
                    <div style="text-align: center;">
                        <a href="detail_transaksi.php?id=<?= $d['id']?>" id="detail-button">Detail</a>
                        <!-- <a href="master-detail.php?id=<?= $d['id']?>" id="hapus-button">Hapus</a> -->
                    </div>
                    </td>
                </tr>
                <?php $no++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>
    <form method="POST">
        <button id="barang-button" name="barang">Daftar Barang</button>
    </form>
    </center>
    
</body>
</html>