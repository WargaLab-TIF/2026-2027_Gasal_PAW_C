<?php
$status = "";

if (isset($_POST['surname'])) {
    if (!empty($_POST['surname'])) {
        $status = 'Data OK!';
    } else {
        $status = 'Data invalid!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Self-Submission</title>
</head>
<body>
    <h3>Pengujian Validasi dengan Self-Submission</h3>

    <?php if ($status != ""): ?>
        <p><b>Status: <?php echo $status; ?></b></p>
    <?php endif; ?>

    <?php 
    // Memanggil skrip form dari file terpisah
    include 'form.inc'; 
    ?>
</body>
</html>