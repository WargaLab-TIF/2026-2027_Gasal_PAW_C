<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Person Details</title>
</head>
<body>
    <?php
    function h($value)
    {
        return htmlspecialchars(
            (string) $value,
            ENT_QUOTES,
            'UTF-8'
        );
    }
    $errors = array();
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        require 'validate.inc';
        validateName($errors, $_POST, 'surname');
        validateEmail($errors, $_POST, 'email');
        validateRequired($errors, $_POST, 'passwd');
        validateRequired($errors, $_POST, 'address');
        validateState($errors, $_POST, 'state');
        validateCountry($errors, $_POST, 'country');
        validateSex($errors, $_POST, 'sex');
        if ($errors)
            {
                echo '<h1>Invalid, correct the following errors:</h1>';
                foreach ($errors as $field => $error)    
                    echo h($field) . ' ' . h($error) . '<br>';
                    // tampilkan kembali form
                    echo "<h1>Register</h1>";
                    include 'form.inc';
            } else {echo 'Form submitted successfully with no errors';}
    } else {
        // tampilkan kembali form
        echo "<h1>Register</h1>";
        include 'form.inc';
    }
    ?>
</body>
</html>