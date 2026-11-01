<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form action="form.php" method="POST">

    Surname:
    <input type="text" name="surname" size="31"
    value="<?php
    if (isset($_POST['surname'])) {
        echo htmlspecialchars($_POST['surname']);
    }
    ?>">
    <br><br>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">

</form>

</body>
</html>