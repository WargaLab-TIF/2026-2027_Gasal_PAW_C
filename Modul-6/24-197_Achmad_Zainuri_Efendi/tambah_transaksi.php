<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Transaksi Master-Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Form Input Transaksi</h2>
        
        <form action="simpan_transaksi.php" method="POST">
            <div class="grid grid-cols-2 gap-4 mb-6 p-4 border rounded bg-gray-50">
                <div>
                    <label class="block text-sm font-semibold">Tanggal Transaksi</label>
                    <input type="date" name="waktu_transaksi" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold">Pelanggan</label>
                    <select name="pelanggan_id" class="w-full border p-2 rounded" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php
                        $q_plg = mysqli_query($conn, "SELECT id, nama FROM pelanggan");
                        while ($plg = mysqli_fetch_assoc($q_plg)) {
                            echo "<option value='{$plg['id']}'>{$plg['id']} - {$plg['nama']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-semibold">Keterangan</label>
                    <textarea name="keterangan" class="w-full border p-2 rounded"></textarea>
                </div>
            </div>

            <div class="mb-4 flex gap-2 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-semibold">Pilih Barang</label>
                    <select id="pilih_barang" class="w-full border p-2 rounded">
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $q_brg = mysqli_query($conn, "SELECT id, nama_barang, harga FROM barang");
                        while ($brg = mysqli_fetch_assoc($q_brg)) {
                            echo "<option value='{$brg['id']}' data-nama='{$brg['nama_barang']}' data-harga='{$brg['harga']}'>{$brg['nama_barang']} - Rp " . number_format($brg['harga'],0,',','.') . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="w-24">
                    <label class="block text-sm font-semibold">Qty</label>
                    <input type="number" id="qty_barang" class="w-full border p-2 rounded" min="1" value="1">
                </div>
                <button type="button" onclick="tambahBarang()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah</button>
            </div>

            <table class="w-full text-left border-collapse mb-6">
                <thead>
                    <tr class="bg-gray-200 border-b">
                        <th class="p-2">Nama Barang</th>
                        <th class="p-2">Harga</th>
                        <th class="p-2">Qty</th>
                        <th class="p-2">Subtotal</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="list_detail">
                </tbody>
            </table>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-bold hover:bg-green-700 w-full">Simpan Transaksi</button>
        </form>
    </div>

    <script>
        function tambahBarang() {
            const select = document.getElementById('pilih_barang');
            const qtyInput = document.getElementById('qty_barang');
            
            if (select.value === "") return alert("Pilih barang terlebih dahulu!");
            
            const idBarang = select.value;
            const namaBarang = select.options[select.selectedIndex].getAttribute('data-nama');
            const harga = parseInt(select.options[select.selectedIndex].getAttribute('data-harga'));
            const qty = parseInt(qtyInput.value);
            const subtotal = harga * qty;

            const tbody = document.getElementById('list_detail');
            const rowId = 'row_' + idBarang;
            
            const tr = document.createElement('tr');
            tr.id = rowId;
            tr.className = "border-b";
            tr.innerHTML = `
                <td class="p-2">${namaBarang}
                    <input type="hidden" name="barang_id[]" value="${idBarang}">
                    <input type="hidden" name="harga[]" value="${harga}">
                </td>
                <td class="p-2">Rp ${harga.toLocaleString('id-ID')}</td>
                <td class="p-2">
                    <input type="hidden" name="qty[]" value="${qty}">${qty}
                </td>
                <td class="p-2">Rp ${subtotal.toLocaleString('id-ID')}</td>
                <td class="p-2"><button type="button" onclick="hapusBaris('${idBarang}')" class="text-red-600 font-bold">Batal</button></td>
            `;
            tbody.appendChild(tr);

            select.options[select.selectedIndex].disabled = true;
            select.value = ""; 
            qtyInput.value = 1;
        }

        function hapusBaris(idBarang) {
            document.getElementById('row_' + idBarang).remove();
            
            const option = document.querySelector(`#pilih_barang option[value='${idBarang}']`);
            if (option) option.disabled = false;
        }
    </script>
</body>
</html>