<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h3>Register</h3>
    <?php
    $errors = array();
    
    // Cek apakah tombol submit sudah ditekan
    if (isset($_POST['submit']))
    {
        require 'validate.inc';
        validateName($errors, $_POST, 'surname');
        
        // Jika ditemukan error pada validasi
        if ($errors)
        {
            echo '<h4 style="color:red;">Invalid, correct the following errors:</h4>';
            foreach ($errors as $field => $error) {
                echo "<p style='color:red;'>$field $error</p>";
            }
            // Tampilkan kembali form beserta isian data sebelumnya (Sticky Form)
            include 'form.inc';
        }
        else
        {
            echo '<p style="color:green;"><b>Form submitted successfully with no errors</b></p>';
        }
    }
    else
    {
        // Kondisi awal ketika halaman pertama kali dibuka (menampilkan form kosong)
        include 'form.inc';
    }
    ?>
</body>
</html>