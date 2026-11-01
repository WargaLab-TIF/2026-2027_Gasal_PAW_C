<!DOCTYPE html>
<html>
<head>
    <title>Hasil Data Pribadi</title>
</head>
<body>

<h2>Hasil Data Pribadi</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $surname = htmlspecialchars($_POST["surname"] ?? "");
    $email = htmlspecialchars($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $address = htmlspecialchars($_POST["address"] ?? "");
    $state = htmlspecialchars($_POST["state"] ?? "");
    $country = htmlspecialchars($_POST["country"] ?? "");
    $sex = htmlspecialchars($_POST["sex"] ?? "Belum dipilih");

    if (isset($_POST["vegetarian"])) {
        $vegetarian = "Ya";
    } else {
        $vegetarian = "Tidak";
    }

    echo "Surname: " . $surname . "<br>";
    echo "Email address: " . $email . "<br>";
    echo "Password: " . str_repeat("*", strlen($password)) . "<br>";
    echo "Street Address: " . nl2br($address) . "<br>";
    echo "State: " . $state . "<br>";
    echo "Country: " . $country . "<br>";
    echo "Gender: " . $sex . "<br>";
    echo "Vegetarian: " . $vegetarian . "<br>";

} else {
    echo "Silakan isi form terlebih dahulu.";
}
?>

<br><br>
<a href="processData_form.html">Kembali ke Form</a>

</body>
</html>