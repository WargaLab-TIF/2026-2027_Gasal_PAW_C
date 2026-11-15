<?php include 'koneksi.php';
$id=$_GET['id'];
$d=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM supplier WHERE id='$id'"));
if(isset($_POST['update'])){
  mysqli_query($koneksi,"UPDATE supplier SET nama='$_POST[nama]', telp='$_POST[telp]', alamat='$_POST[alamat]' WHERE id='$id'");
  header("Location:soal3.php");
}
?>
<style>body{font-family:Arial;padding:20px} input{width:300px;padding:6px;margin:5px} .btn{padding:6px 12px;border:none;color:white;border-radius:4px} .hijau{background:#5cb85c} .merah{background:#d9534f}</style>
<h2 style="color:#31708f;text-align:center">Edit Data Master Supplier</h2>
<form method="post" style="width:500px;margin:auto">
<table>
<tr><td>Nama</td><td><input type="text" name="nama" value="<?=$d['nama']?>"></td></tr>
<tr><td>Telp</td><td><input type="text" name="telp" value="<?=$d['telp']?>"></td></tr>
<tr><td>Alamat</td><td><input type="text" name="alamat" value="<?=$d['alamat']?>"></td></tr>
<tr><td></td><td><button name="update" class="btn hijau">Update</button> <a href="soal3.php" class="btn merah" style="text-decoration:none">Batal</a></td></tr>
</table>
</form>