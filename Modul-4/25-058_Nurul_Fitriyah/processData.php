<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Final Form</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        fieldset { width: 450px; padding: 20px; border: 1px solid #ccc; }
        legend { font-weight: bold; }
        .field-wrapper { margin-bottom: 15px; }
        .field { margin-bottom: 5px; display: flex; align-items: center; }
        .field label { width: 120px; display: inline-block; }
        .field input[type="text"], .field input[type="password"], .field select, .field textarea { width: 100%; }
        .radio-group { display: inline-block; }
        .buttons { margin-left: 120px; margin-top: 15px; }
        .error-header { color: red; font-size: 16px; margin-bottom: 15px; font-weight: bold; }
        .error-text { color: red; font-size: 12px; margin-left: 120px; display: block; font-style: italic; }
        .success-box { color: green; border: 1px solid green; padding: 15px; width: 450px; background-color: #f0fff0; }
    </style>
</head>
<body>

<?php 
$errors = array(); 

// Cek apakah tombol submit sudah di-klik oleh user
if (isset($_POST['submit'])) 
{ 
    require 'validate.inc'; // Memanggil file pengecekan
    
    // Proses semua validasi inputan form
    validateName($errors, $_POST, 'surname'); 
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'paswd');
    validateState($errors, $_POST, 'state');
    
    if ($errors) 
    { 
        // Jika ada inputan yang salah, tampilkan pesan warning di atas form
        echo '<div class="error-header">Form submitted with errors. Please correct the fields below:</div>'; 
        include 'form.inc'; // Panggil form kembali (data yang benar tidak akan hilang)
    } 
    else 
    { 
        // Jika semuanya sukses tanpa error, tampilkan box sukses beserta rekap datanya
        echo '<div class="success-box">';
        echo '<h1>Form submitted successfully with no errors</h1>'; 
        echo '<h3>Data Recap:</h3>';
        foreach ($_POST as $key => $value) {
            if($key != 'submit' && $key != 'paswd') { 
                echo "<strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "<br/>";
            }
        }
        echo '</div>';
    } 
} 
else 
{ 
    // Saat pertama kali halaman dibuka di browser, tampilkan form kosong
    include 'form.inc'; 
}
?>

</body>
</html>