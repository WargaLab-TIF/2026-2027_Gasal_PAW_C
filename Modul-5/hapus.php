<?php
include "koneksi.php";

$id = (int) $_GET["id"];

$sql = "DELETE FROM supplier WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?pesan=hapus");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
