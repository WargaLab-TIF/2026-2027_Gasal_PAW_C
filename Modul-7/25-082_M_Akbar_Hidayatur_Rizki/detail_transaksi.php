<?php
include 'koneksi.php';

$id_transaksi = $_GET['id'] ?? $_POST['id_transaksi'] ?? null;
$error = [];
if ($id_transaksi == null) {
    exit("ID transaksi tidak ditemukan");
}

$record = detail_transaksi($koneksi, $_GET['id']);
$data = mysqli_fetch_assoc(get_transaksi($koneksi, $_GET['id']));   

if (isset($_POST['tambahBarang-button'])) {

    $tambah_id = $_POST['tambah_id'];
    $tambah_qty = $_POST['tambah_qty'];
    
    if (!empty($tambah_id) && $tambah_qty > 0 && $tambah_id !== "kosong") {
        $cek = check_stok($koneksi, $tambah_id, $tambah_qty);
        if ($cek === true) {
            add_barang($koneksi, $id_transaksi ,$tambah_id, $tambah_qty);    
            header("location: detail_transaksi.php?id=" . $id_transaksi);
            exit;
        } else {
            $error["add"] = "Gagal menambagkan barang : Stok tidak mencukupi";
        }
    } else {
        $error["add"] = "Pilih barang dan jumlah yang valid!";
    }
};

if (isset($_POST['cancelBarang-button'])) {
    header("location: detail_transaksi.php?id=" . $id_transaksi);
};
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
        }
        #detail {
            background-color: #6D28D9;
            color: white;
            text-align: center;
        }
        #tb-detail {
            border-collapse: collapse;
            width: 800px;
            border-color: darkcyan;
            border-radius: 10px;
        }
        .card {
            width: auto;
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        .card-tambah {
            width: 300px;
            background: aliceblue;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .detail {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            gap: 15px;
        }

        .label {
            color: #777;
        }

        .value {
            color: #333;
            font-weight: 600;
            text-align: right;
        }
        #cancelBarang-button {
            display: inline-block;
            background: red; 
            border: none; 
            border-radius: 5px; 
            color: white;
            padding: 5px 10px;
        }
        #tambahBarang-button {
                background: #059669; 
            border: none; 
            border-radius: 5px; 
            color: white;
            padding: 5px 10px;
        } 

        #tambah-button {
            background: #2563EB; 
            border: none; 
            border-radius: 5px; 
            color: white;
            width: 140px;
            height: 30px;
        } 
        #tambah-button:hover {
            background-color: #1D4ED8;
        }
        #hapus-button {
            display: inline-block;
            background: red; 
            border: none; 
            border-radius: 5px; 
            color: white;
            padding: 5px 10px;
        }
        #hapus-button:hover {
            background-color: #B91C1C;
        }
        #tambahBarang-button:hover {
            background-color: #047857;
        }
        #cancelBarang-button:hover {
            background-color: #B91C1C;
        }
        .kembali-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #6B7280; /* Warna abu-abu netral elegan */
            color: white;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.1s;
            margin-bottom: 15px;
        }

        .kembali-button:hover {
            background-color: #4B5563;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
    <h2>Detail Transaksi:</h2>
        <table>
            <tr class="detail">
                <td class="label">No. Transaksi: </td>
                <td class="value"><?= $data['id']?></td>
            </tr>   
            <tr class="detail">
                <td class="label">Pelanggan: </td> 
                <td class="value"><?= $data['nama']?></td>
            </tr>
            <tr class="detail">
                <td class="label">Tanggal: </td> 
                <td class="value"><?= $data['waktu_transaksi']?></td>
            </tr><tr class="detail">
                <td class="label">Metode Transaksi: </td> 
                <td class="value"><?= $data['metode']?></td>
            </tr>
            <tr class="detail">
                <td class="label">Total Saat Ini: </td>
                <td class="value"><?= $data['total']?></td>
            </tr> 
        </table>
    

    <br>
    <br>
    <h2>Barang Yang Sudah Dibeli:</h2>

    <table border="1" cellpadding="5" id="tb-detail">
        <thead id="detail">
            <tr>
                <td>No</td>
                <td>Waktu</td>
                <td>Barang</td>
                <td>Harga</td>
                <td>Jumlah</td>
                <!-- <td>Action</td> -->    
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php foreach ($record as $d): ?>
                <tr>
                    <td> <?= $no ?>.</td>
                    <td> <?= $d["waktu_transaksi"] ?> </td>
                    <td> <?= $d["nama_barang"] ?> </td>
                    <td> <?= $d["harga"] ?> </td>
                    <td> <?= $d["qty"] ?> </td>
                    <!-- <td style="text-align: center;"> -->
                        <!-- <a href="?id=<?= $d['id'] ?>" id="hapus-button">Hapus</a> -->
                    <!-- </td> -->
                </tr>
                <?php $no++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
    <div style="display: flex; gap: 10px; margin-top: 20px;">       
        <form method="POST">
            <button name="tambah" id="tambah-button">Tambah Barang</button>
        </form>
        <a href="master-detail.php" class="kembali-button">Kembali</a>
    </div>
    <?php if (isset($_POST['tambah'])): ?>
        <?php $data_barang = get_selected_barang($koneksi,$data['id']); ?>
        <br>
        <br>
        <div class="card-tambah">
            <table border="0" cellpadding="5" cellspacing="0">
                <form method="POST">
                    <tr>
                        <td>
                            <label>Daftar Barang</label>
                        </td>
                        <td>
                            <select name="tambah_id">
                                <option value="kosong">-- Pilih Barang --</option>
                                <?php foreach ($data_barang as $d): ?>
                                    <option value="<?= $d['id'] ?>"><?= $d['nama_barang'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Jumlah</label>   
                        </td>
                        <td>
                            <input type="number" name="tambah_qty" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button name="tambahBarang-button" id="tambahBarang-button">Tambah</button>
                            <button name="cancelBarang-button" id="cancelBarang-button">Cancel</button>
                        </td>
                    </tr>
                    <input type="hidden" name="id_transaksi" value="<?= $data['id'] ?>">
                </form>
            </table>
        </div>
    <?php endif; ?>
    <?php if (!empty($error['add'])): ?>
        <h2 style="color: red;"><?= $error['add']?></h2>
    <?php endif ?>
    </div>
</body>
</html>