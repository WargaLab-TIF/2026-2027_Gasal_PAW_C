<?php
// Menampung nilai POST sebelumnya agar tidak hilang saat ada error
$val_surname = $_POST['surname'] ?? '';
$val_email   = $_POST['email'] ?? '';
$val_address = $_POST['address'] ?? '';
$val_state   = $_POST['state'] ?? '-1';
$val_sex     = $_POST['sex'] ?? '';
$val_veg     = isset($_POST['vegetarian']);
?>

<form style="background-color: grey; color: white;" action="procesData_form.php" method="POST">
    <fieldset>
        <legend>Informasi Pribadi User</legend>
        
        <label for="surname">Surname:</label><br>
        <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($val_surname) ?>" placeholder="Masukan Username"><br>

        <label for="email">Email Address:</label><br>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($val_email) ?>" placeholder="Masukan Email"><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Masukan Password"><br>

        <label for="address">Street Address:</label><br>
        <textarea id="address" name="address" rows="3" cols="22" placeholder="Masukan Alamat"><?= htmlspecialchars($val_address) ?></textarea><br>

        <label for="state">State:</label><br>
        <select id="state" name="state">
            <option value="-1" <?= $val_state == '-1' ? 'selected' : '' ?>>[choose your state]</option>
            <option value="1" <?= $val_state == '1' ? 'selected' : '' ?>>Australian</option>
            <option value="2" <?= $val_state == '2' ? 'selected' : '' ?>>Indonesia</option>
            <option value="3" <?= $val_state == '3' ? 'selected' : '' ?>>UK</option>
            <option value="4" <?= $val_state == '4' ? 'selected' : '' ?>>South Korea</option>
        </select><br>

        <input type="hidden" name="country" value="Australia"><br>

        <label>Gender:</label><br>
        <input type="radio" name="sex" value="male" <?= $val_sex == 'male' ? 'checked' : '' ?>> Male
        <input type="radio" name="sex" value="female" <?= $val_sex == 'female' ? 'checked' : '' ?>> Female<br>

        <label>Vegetarian?</label>
        <input type="checkbox" name="vegetarian" value="1" <?= $val_veg ? 'checked' : '' ?>><br>

        <button type="submit" name="submit">Submit</button>
        <button type="reset">Reset</button><br>
    </fieldset>
</form>