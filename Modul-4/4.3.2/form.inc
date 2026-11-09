<?php
$old = $_POST ?? [];
?>
<form name="myForm" action="processData_form.php" method="POST">
    <fieldset>
        <legend>Person Details</legend>

        <div class="field">
            <label for="surname">Surname :</label>
            <input type="text" id="surname" name="surname" maxlength="31" value="<?= h($old['surname'] ?? ''); ?>">
        </div>
        <br>
        <div class="field">
            <label for="email">Email address :</label>
            <input type="email" id="email" name="email" maxlength="150" value="<?= h($old['email'] ?? ''); ?>">
        </div>
        <br>
        <div class="field">
            <label for="passwd">Password :</label>
            <input type="password" id="passwd" name="passwd" maxlength="31" value="<?= h($old['passwd'] ?? ''); ?>">
        </div>
        <br>
        <div class="field">
            <label for="address">Street Address :</label><br>
            <textarea id="address" name="address" rows="3" cols="22"><?= h($old['address'] ?? ''); ?></textarea>
        </div>
        <br>
        <div class="field">
            <label for="state">State :</label>
            <select id="state" name="state">
                <option value="-1" <?= (($old['state'] ?? '-1') === '-1') ? 'selected' : ''; ?>>Choose your state</option>
                <option value="1" <?= (($old['state'] ?? '') === '1') ? 'selected' : ''; ?>>Australian Capital Territory</option>
                <option value="2" <?= (($old['state'] ?? '') === '2') ? 'selected' : ''; ?>>Queensland</option>
                <option value="3" <?= (($old['state'] ?? '') === '3') ? 'selected' : ''; ?>>Victoria</option>
                <option value="4" <?= (($old['state'] ?? '') === '4') ? 'selected' : ''; ?>>New South Wales</option>
                <option value="5" <?= (($old['state'] ?? '') === '5') ? 'selected' : ''; ?>>Tasmania</option>
                <option value="6" <?= (($old['state'] ?? '') === '6') ? 'selected' : ''; ?>>South Australia</option>
                <option value="7" <?= (($old['state'] ?? '') === '7') ? 'selected' : ''; ?>>Western Australia</option>
                <option value="8" <?= (($old['state'] ?? '') === '8') ? 'selected' : ''; ?>>Northern Territory</option>
            </select>
        </div>
        <br>
        <input type="hidden" name="country" value="Australia">

        <div class="field">
            <label>Gender :</label>
            <div class="choices">
                <label><input type="radio" name="sex" value="male" <?= (($old['sex'] ?? '') === 'male') ? 'checked' : ''; ?>> Male</label>
                <label><input type="radio" name="sex" value="female" <?= (($old['sex'] ?? '') === 'female') ? 'checked' : ''; ?>> Female</label>
            </div>
        </div>
        <br>
        <div class="field">
            <label for="vegetarian">Vegetarian? :</label>
            <div><input type="checkbox" id="vegetarian" name="vegetarian" value="yes" <?= isset($old['vegetarian']) ? 'checked' : ''; ?>></div>
        </div>
        <br>
        <div class="actions">
            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Reset" name="reset">
        </div>
    </fieldset>
</form>