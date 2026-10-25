<?php
// File ini menjadi tujuan pengiriman form sekaligus penampil form (self-submission).
$errors = array();
$fields = array('surname', 'email', 'password', 'address', 'state', 'sex');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Self-Submission Form</title>
</head>
<body>
<?php
if (isset($_POST['surname'])) {
    require 'validate.inc';

    foreach ($fields as $field) {
        validateName($errors, $_POST, $field);
    }

    if ($errors) {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error) {
            echo htmlspecialchars($field) . ' ' . htmlspecialchars($error) . '<br/>';
        }

        // Tampilkan kembali form beserta data yang sudah diisi sebelumnya.
        include 'form.inc';
    } else {
        echo '<p>Form submitted successfully with no errors</p>';
        echo '<p><a href="prosesData_form.php">Isi form lagi</a></p>';
    }
} else {
    // Belum ada data yang dikirim: tampilkan form kosong.
    include 'form.inc';
}
?>
</body>
</html>
