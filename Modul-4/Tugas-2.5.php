<?php
require_once __DIR__ . '/Tugas-2.4.inc';

$errors = array();

if (isset($_POST['surname'])) {
    validateName($errors, $_POST, 'surname');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas-2.5</title>
</head>
<body>
    <h3>Pengujian Validasi Detail Error (Langkah #5)</h3>

    <?php
    if (isset($_POST['surname'])) {
        if ($errors)
        {
            echo 'Errors:<br/>';
            foreach ($errors as $field => $error)
                echo "$field $error<br/>";
        }
        else
            echo 'Data OK!';
    }
    ?>

    <form method="POST">
        <label>Surname:</label>
        <input type="text" name="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
        <input type="submit" value="Submit">
    </form>
        <?php require 'form.inc'; ?>
</body>
</html>
