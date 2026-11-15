<?php include 'koneksi.php'; ?>
<!DOCTYPE html><html><head><title>Data Master Supplier</title>
<style>
body{font-family:Arial;padding:20px}
table{width:100%;border-collapse:collapse;margin-top:10px}
th{background:#d9edf7;padding:8px;text-align:left}
td{padding:8px;border-bottom:1px solid #ddd}
.btn{padding:5px 10px;border:none;border-radius:4px;color:white;cursor:pointer;text-decoration:none;font-size:12px}
.hijau{background:#5cb85c} .orange{background:#f0ad4e} .merah{background:#d9534f}
.tambah{float:right;margin-bottom:10px}
</style>
<script>
function hapus(id){
  if(confirm("Anda yakin akan menghapus supplier ini?")){
    window.location="soal6.php?id="+id;
  }
}
</script>
</head><body>

<h3 style="color:#31708f">Data Master Supplier</h3>
<a href="soal4.php" class="btn hijau tambah">Tambah Data</a>
<table>
<tr><th>No</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Tindakan</th></tr>
<?php
$no=1;
$q=mysqli_query($koneksi,"SELECT * FROM supplier");
while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?=$no++?></td>
<td><?=$d['nama']?></td>
<td><?=$d['telp']?></td>
<td><?=$d['alamat']?></td>
<td>
<a href="soal5.php?id=<?=$d['id']?>" class="btn orange">Edit</a>
<button onclick="hapus(<?=$d['id']?>)" class="btn merah">Hapus</button>
</td>
</tr>
<?php } ?>
</table>
</body></html>