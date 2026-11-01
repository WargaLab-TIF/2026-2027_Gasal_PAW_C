<?php
include "koneksi.php";

$id = intval($_GET["id"]);

mysqli_query($conn, "DELETE FROM supplier WHERE id = $id");

header("Location: index.php");
exit;
