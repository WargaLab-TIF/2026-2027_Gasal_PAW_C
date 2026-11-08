<?php
require "koneksi.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$pesan = isset($_GET["pesan"]) ? $_GET["pesan"] : "";

$pesanSukses = "";
$pesanError = "";

if ($pesan == "tambah") {
    $pesanSukses = "Detail transaksi berhasil disimpan. Total transaksi sudah diperbarui.";
} elseif ($pesan == "dobel") {
    $pesanError = "Barang tersebut sudah ada di detail transaksi ini, jadi tidak boleh dipilih lagi.";
} elseif ($pesan == "gagal") {
    $pesanError = "Detail transaksi gagal disimpan. Periksa kembali data yang diinput.";
}

$dataTransaksi = mysqli_query($conn, "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan
                                      FROM transaksi t
                                      JOIN pelanggan p ON p.id = t.pelanggan_id
                                      ORDER BY t.id ASC");

if ($id == 0) {
    $ambilIdPertama = mysqli_query($conn, "SELECT id FROM transaksi ORDER BY id ASC LIMIT 1");
    $barisPertama = mysqli_fetch_assoc($ambilIdPertama);

    if ($barisPertama != null) {
        $id = (int) $barisPertama["id"];
    }
}

$transaksi = null;
if ($id > 0) {
    $ambilTransaksi = mysqli_query($conn, "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan
                                           FROM transaksi t
                                           JOIN pelanggan p ON p.id = t.pelanggan_id
                                           WHERE t.id = $id");
    $transaksi = mysqli_fetch_assoc($ambilTransaksi);
}

$dataDetail = array();
$idTerpakai = array();

if ($transaksi != null) {
    $ambilDetail = mysqli_query($conn, "SELECT td.barang_id, td.harga, td.qty, b.nama_barang
                                        FROM transaksi_detail td
                                        JOIN barang b ON b.id = td.barang_id
                                        WHERE td.transaksi_id = $id
                                        ORDER BY b.nama_barang ASC");

    while ($row = mysqli_fetch_assoc($ambilDetail)) {
        $dataDetail[] = $row;
        $idTerpakai[] = (int) $row["barang_id"];
    }
}

$dataBarang = mysqli_query($conn, "SELECT id, nama_barang, harga FROM barang ORDER BY nama_barang ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            color: #222;
            margin: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1,
        h2 {
            color: #1565c0;
        }

        nav {
            margin-bottom: 15px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #cfd8dc;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #e3f2fd;
        }

        tr.aktif td {
            background: #fff8e1;
        }

        table.info {
            width: 60%;
        }

        table.info th {
            width: 30%;
        }

        .btn {
            display: inline-block;
            padding: 6px 10px;
            background: #1565c0;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background: #0d47a1;
        }

        .btn-hapus {
            background: #c62828;
        }

        .btn-hapus:hover {
            background: #8e0000;
        }

        .pesan {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        .sukses {
            background: #e8f5e9;
            color: #1b5e20;
            border: 1px solid #a5d6a7;
        }

        .error {
            background: #ffebee;
            color: #b71c1c;
            border: 1px solid #ef9a9a;
        }

        form {
            background: #fff;
            border: 1px solid #cfd8dc;
            padding: 12px;
            margin-bottom: 15px;
        }

        label {
            margin-right: 6px;
        }

        input,
        select {
            padding: 6px;
            margin-right: 12px;
        }

        .selesai {
            color: #666;
        }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a class="btn" href="index.php">Data Transaksi</a>
        <a class="btn" href="barang.php">Data Barang</a>
    </nav>

    <h1>Master Detail Transaksi</h1>

    <?php if ($pesanSukses != "") : ?>
        <p class="pesan sukses"><?= htmlspecialchars($pesanSukses) ?></p>
    <?php endif; ?>

    <?php if ($pesanError != "") : ?>
        <p class="pesan error"><?= htmlspecialchars($pesanError) ?></p>
    <?php endif; ?>

    <h2>Data Transaksi</h2>

    <?php if (mysqli_num_rows($dataTransaksi) == 0) : ?>
        <p>Belum ada data transaksi. Jalankan database.php terlebih dahulu.</p>
    <?php else : ?>
        <table>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($dataTransaksi)) :
            ?>
                <tr class="<?= ((int) $row["id"] == $id) ? "aktif" : "" ?>">
                    <td><?= $no ?></td>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row["waktu_transaksi"]) ?></td>
                    <td><?= htmlspecialchars($row["nama_pelanggan"]) ?></td>
                    <td><?= htmlspecialchars($row["keterangan"]) ?></td>
                    <td>Rp <?= number_format($row["total"], 0, ",", ".") ?></td>
                    <td><a class="btn" href="index.php?id=<?= $row["id"] ?>">Pilih</a></td>
                </tr>
            <?php
                $no++;
            endwhile;
            ?>
        </table>
    <?php endif; ?>

    <?php if ($transaksi != null) : ?>
        <h2>Detail Transaksi</h2>

        <table class="info">
            <tr>
                <th>ID Transaksi</th>
                <td><?= $transaksi["id"] ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?= htmlspecialchars($transaksi["waktu_transaksi"]) ?></td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td><?= htmlspecialchars($transaksi["nama_pelanggan"]) ?></td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td><?= htmlspecialchars($transaksi["keterangan"]) ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td>Rp <?= number_format($transaksi["total"], 0, ",", ".") ?></td>
            </tr>
        </table>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            <?php if (count($dataDetail) == 0) : ?>
                <tr>
                    <td colspan="5">Belum ada detail untuk transaksi ini.</td>
                </tr>
            <?php else : ?>
                <?php
                $noDetail = 1;
                foreach ($dataDetail as $detail) :
                ?>
                    <tr>
                        <td><?= $noDetail ?></td>
                        <td><?= htmlspecialchars($detail["nama_barang"]) ?></td>
                        <td>Rp <?= number_format($detail["harga"], 0, ",", ".") ?></td>
                        <td><?= $detail["qty"] ?></td>
                        <td>Rp <?= number_format($detail["harga"] * $detail["qty"], 0, ",", ".") ?></td>
                    </tr>
                <?php
                    $noDetail++;
                endforeach;
                ?>
            <?php endif; ?>
        </table>

        <h2>Tambah Detail Transaksi</h2>

        <form method="post" action="tambah_detail.php">
            <input type="hidden" name="transaksi_id" value="<?= $transaksi["id"] ?>">

            <label for="barang_id">Barang</label>
            <select name="barang_id" id="barang_id" required>
                <option value="">-- Pilih Barang --</option>
                <?php while ($barang = mysqli_fetch_assoc($dataBarang)) : ?>
                    <option value="<?= $barang["id"] ?>" <?= in_array((int) $barang["id"], $idTerpakai) ? "disabled" : "" ?>>
                        <?= htmlspecialchars($barang["nama_barang"]) ?> - Rp <?= number_format($barang["harga"], 0, ",", ".") ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" value="1" required>

            <button class="btn" type="submit">Tambah Detail</button>
        </form>

        <p class="selesai">Barang yang sudah ada di detail transaksi ini tampil dengan pilihan nonaktif (disabled).</p>
    <?php elseif ($id > 0) : ?>
        <p class="pesan error">Transaksi tidak ditemukan.</p>
    <?php endif; ?>
</div>
</body>
</html>
