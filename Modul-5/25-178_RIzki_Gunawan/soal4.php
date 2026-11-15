<?php include 'koneksi.php';
if(isset($_POST['simpan'])){
  mysqli_query($koneksi,"INSERT INTO supplier (nama,telp,alamat) VALUES ('$_POST[nama]','$_POST[telp]','$_POST[alamat]')");
  header("Location:soal3.php");
}
?>
<style>body{font-family:Arial;padding:20px} input{width:300px;padding:6px;margin:5px} .btn{padding:6px 12px;border:none;color:white;border-radius:4px} .hijau{background:#5cb85c} .merah{background:#d9534f}</style>
<h2 style="color:#31708f;text-align:center">Tambah Data Master Supplier Baru</h2>
<form method="post" style="width:500px;margin:auto">
<table>
<tr><td>Nama</td><td><input type="text" name="nama" placeholder="Nama"></td></tr>
<tr><td>Telp</td><td><input type="text" name="telp" placeholder="telp"></td></tr>
<tr><td>Alamat</td><td><input type="text" name="alamat" placeholder="alamat"></td></tr>
<tr><td></td><td><button name="simpan" class="btn hijau">Simpan</button> <a href="soal3.php" class="btn merah" style="text-decoration:none">Batal</a></td></tr>
</table>
</form>