<?php
$host = "localhost";
$username = "root";
$pass = "";
$database = "db_penjualan";

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect($host, $username, $pass, $database);

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: soal_3.php");
        exit;
    }

    $id = (int)($_POST["id"] ?? 0);

    if ($id <= 0) {
        header("Location: soal_3.php?status=notfound");
        exit;
    }

    $query = mysqli_prepare($conn, "DELETE FROM supplier WHERE id = ?");
    mysqli_stmt_bind_param($query, "i", $id);
    mysqli_stmt_execute($query);

    $deleted = mysqli_stmt_affected_rows($query);
    mysqli_stmt_close($query);

    if ($deleted > 0) {
        header("Location: soal_3.php?status=deleted");
    } else {
        header("Location: soal_3.php?status=notfound");
    }
    exit;

} catch (mysqli_sql_exception $e) {
    header("Location: soal_3.php?status=related");
    exit;
}