<?php
require_once __DIR__ . '/Tugas-2.4.inc';

echo function_exists('validateName')
    ? 'Fungsi validateName berhasil dimuat!'
    : 'Fungsi validateName TIDAK ditemukan!';

$errors = [];

if (isset($_POST['surname'])) {
    validateName($errors, $_POST, 'surname');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas 2.6</title>
</head>
<body>

<h3>Pengujian Validasi Detail Error (Langkah #6)</h3>

<?php
if (isset($_POST['surname'])) {
    if (!empty($errors)) {
        echo 'Errors:<br>';

        foreach ($errors as $field => $error) {
            echo htmlspecialchars($field) . ' '
               . htmlspecialchars($error) . '<br>';
        }
    } else {
        echo 'Data OK!';
    }
}
?>

<form method="POST">
    <label>Surname:</label>
    <input
        type="text"
        name="surname"
        value="<?= htmlspecialchars($_POST['surname'] ?? '') ?>"
    >
    <input type="submit" value="Submit">
</form>

</body>
</html>