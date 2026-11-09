<?php
// Memanggil file pustaka fungsi validasi dari Soal No. 1
require 'Tugas-2.1.inc';

$status = "";

// Pengecekan ketika form disubmit
if (isset($_POST['surname'])) {
    if (validateName($_POST, 'surname')) {
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
    <title>Tugas-2.2</title>
</head>
<body>

    <?php if ($status != ""): ?>
        <p><b>Status: <?php echo $status; ?></b></p>
    <?php endif; ?>

    <form method="POST">
        <label>Surname:</label>
        <input type="text" name="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
        <input type="submit" value="Submit">
    </form>
</body>
</html>