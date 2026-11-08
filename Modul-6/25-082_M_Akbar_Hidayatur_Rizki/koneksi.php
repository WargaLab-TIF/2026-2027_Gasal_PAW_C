<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function get_transaksi($koneksi, $id = null) {
    $query = "
        SELECT tr.id, tr.waktu_transaksi, pl.nama, tr.total, tr.keterangan, p.metode
        FROM transaksi tr
        INNER JOIN pelanggan pl ON tr.pelanggan_id = pl.id
        LEFT JOIN pembayaran p ON tr.id = p.transaksi_id
    ";
    
    if ($id !== null) {
        $query .= " WHERE tr.id = $id";
    }
    
    return mysqli_query($koneksi, $query);
}

function detail_transaksi($koneksi, $id) {
    $query = "
        SELECT tr.id, tr.waktu_transaksi, td.harga, b.nama_barang, td.qty, td.barang_id
        FROM transaksi tr 
        INNER JOIN transaksi_detail td ON tr.id = td.transaksi_id
        INNER JOIN barang b ON td.barang_id = b.id
        WHERE tr.id = $id
    ";
    return mysqli_query($koneksi, $query);
}

function get_selected_barang($koneksi, $id) {
    $query = "
        SELECT * FROM barang
        WHERE id NOT IN (
            SELECT barang_id 
            FROM transaksi_detail 
            WHERE transaksi_id = $id
        )
    ";
    return mysqli_query($koneksi, $query);
}

function add_barang($koneksi, $id_transaksi, $id_barang, $qty) {
    $query1 = "
        INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
        VALUES (
            $id_transaksi, 
            $id_barang, 
            (SELECT harga FROM barang WHERE id = $id_barang), 
            $qty
        )
    ";
    mysqli_query($koneksi, $query1);

    $query2 = "
        UPDATE transaksi
        SET total = (
            SELECT SUM(harga * qty) 
            FROM transaksi_detail 
            WHERE transaksi_id = $id_transaksi
        )
        WHERE id = $id_transaksi
    ";
    mysqli_query($koneksi, $query2);

    $query3 = "
        UPDATE barang
        SET stok = stok - $qty
        WHERE id = $id_barang
    ";
    mysqli_query($koneksi, $query3);

    $query4 = "
        UPDATE pembayaran
        SET total = (
            SELECT total FROM transaksi WHERE id = $id_transaksi
        )
        WHERE transaksi_id = $id_transaksi
    ";
    mysqli_query($koneksi, $query4);

    return true;
}

function check_stok($koneksi, $id_barang, $qty) {
    $query = "SELECT stok FROM barang WHERE id = $id_barang";
    $result = mysqli_query($koneksi, $query);
    $hasil = mysqli_fetch_assoc($result);
    return ($hasil && $hasil['stok'] >= $qty);
}

function get_barang($koneksi) {
    return mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id ASC");
}

function hapus_barang($koneksi, $id_barang) {
    $id_barang = intval($id_barang);

    $cek_query = "SELECT COUNT(*) AS total FROM transaksi_detail WHERE barang_id = $id_barang";
    $cek_result = mysqli_query($koneksi, $cek_query);
    $data = mysqli_fetch_assoc($cek_result);

    if ($data['total'] > 0) {
        return [
            'status' => false,
            'pesan'  => 'Data barang tidak boleh dihapus karena masih digunakan pada data transaksi!'
        ];
    }

    $delete_query = "DELETE FROM barang WHERE id = $id_barang";
    if (mysqli_query($koneksi, $delete_query)) {
        return [
            'status' => true,
            'pesan'  => 'Data barang berhasil dihapus!'
        ];
    } else {
        return [
            'status' => false,
            'pesan'  => 'Gagal menghapus data barang: ' . mysqli_error($koneksi)
        ];
    }
}
?>