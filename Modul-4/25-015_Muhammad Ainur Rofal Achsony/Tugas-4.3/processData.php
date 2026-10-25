<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Posted Data</title>
</head>
<body>
    <h3>Posted data:</h3>
    <?php
    // Semua data yang dikirim dengan method POST disimpan PHP
    // di array asosiatif $_POST. FOREACH digunakan untuk menelusuri
    // setiap key (nama field) dan value (isian).
    if (empty($_POST)) {
        echo '<p>Tidak ada data POST yang diterima. Jika form dikirim dengan '
            . 'method GET, data berada di URL ($_GET) sehingga tidak tampil '
            . 'di halaman ini.</p>';
    } else {
        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            echo '(' . htmlspecialchars($key) . ') =&gt; ('
                . htmlspecialchars($value) . ')<br>';
        }
    }
    ?>
</body>
</html>
