<?php
$errors = array();

// Cek apakah tombol submit ditekan
if (isset($_POST['submit'])) {
    require 'validate.inc';
    
    // Jalankan semua validasi
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'passwd');
    
    if ($errors) {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error) {
            echo "$field: $error<br/>";
        }
        // Tampilkan kembali form dengan isian data
        include 'form.inc';
    } else {
        echo 'Form submitted successfully with no errors';
    }
} else {
    // Tampilkan form kosong
    include 'form.inc';
}
?>