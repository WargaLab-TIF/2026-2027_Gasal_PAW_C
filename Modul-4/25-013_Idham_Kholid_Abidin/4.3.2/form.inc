<fieldset>
    <legend>Person Details</legend>
    <form name="myform" action="processData_form.php" method="POST">
        <div class="field">
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname" size="31"
                   value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname'], ENT_QUOTES, 'UTF-8') : ''; ?>" />
            <?php if (isset($errors['surname'])): ?>
                <span class="error">Surname <?php echo htmlspecialchars($errors['surname'], ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </div>
        <div class="field">
            <label for="email">Email address</label>
            <input type="text" name="email" id="email" size="31"
                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" />
            <?php if (isset($errors['email'])): ?>
                <span class="error">Email <?php echo htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </div>
        <div class="field">
            <label for="passwd">Password</label>
            <input type="password" name="passwd" id="passwd" size="31" value="" />
            <?php if (isset($errors['passwd'])): ?>
                <span class="error">Password <?php echo htmlspecialchars($errors['passwd'], ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </div>
        <div class="field">
            <label for="address">Street Address</label>
            <textarea name="address" id="address" rows="3" cols="22"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
            <?php if (isset($errors['address'])): ?>
                <span class="error">Address <?php echo htmlspecialchars($errors['address'], ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </div>
        <div class="field">
            <label for="state">State</label>
            <select name="state" id="state">
                <option value="-1"<?php echo (!isset($_POST['state']) || $_POST['state'] === '-1') ? ' selected' : ''; ?>>choose your state</option>
                <option value="1"<?php echo (isset($_POST['state']) && $_POST['state'] === '1') ? ' selected' : ''; ?>>Australian Capital Territory</option>
                <option value="2"<?php echo (isset($_POST['state']) && $_POST['state'] === '2') ? ' selected' : ''; ?>>Queensland</option>
                <option value="3"<?php echo (isset($_POST['state']) && $_POST['state'] === '3') ? ' selected' : ''; ?>>Victoria</option>
                <option value="4"<?php echo (isset($_POST['state']) && $_POST['state'] === '4') ? ' selected' : ''; ?>>New South Wales</option>
                <option value="5"<?php echo (isset($_POST['state']) && $_POST['state'] === '5') ? ' selected' : ''; ?>>Tasmania</option>
                <option value="6"<?php echo (isset($_POST['state']) && $_POST['state'] === '6') ? ' selected' : ''; ?>>South Australia</option>
                <option value="7"<?php echo (isset($_POST['state']) && $_POST['state'] === '7') ? ' selected' : ''; ?>>Western Australia</option>
                <option value="8"<?php echo (isset($_POST['state']) && $_POST['state'] === '8') ? ' selected' : ''; ?>>Northern Territory</option>
            </select>
            <?php if (isset($errors['state'])): ?>
                <span class="error">State <?php echo htmlspecialchars($errors['state'], ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </div>
        <div class="field">
            <input type="hidden" name="country" value="Australia" />
        </div>
        <div class="field">
            <span>Gender</span>
            <label class="choice" for="sex_male">
                <input type="radio" name="sex" id="sex_male" value="male"<?php echo (isset($_POST['sex']) && $_POST['sex'] === 'male') ? ' checked' : ''; ?> /> Male
            </label>
            <label class="choice" for="sex_female">
                <input type="radio" name="sex" id="sex_female" value="female"<?php echo (isset($_POST['sex']) && $_POST['sex'] === 'female') ? ' checked' : ''; ?> /> Female
            </label>
            <?php if (isset($errors['sex'])): ?>
                <span class="error">Sex <?php echo htmlspecialchars($errors['sex'], ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </div>
        <div class="field">
            <label class="choice" for="vegetarian">
                <input type="checkbox" name="vegetarian" id="vegetarian"<?php echo isset($_POST['vegetarian']) ? ' checked' : ''; ?> /> Vegetarian?
            </label>
        </div>
        <div class="field">
            <label for="submit">&nbsp;</label>
            <input type="submit" name="submit" id="submit" value="Submit" />
            <input type="reset" name="reset" id="reset" value="Reset" />
        </div>
    </form>
</fieldset>
