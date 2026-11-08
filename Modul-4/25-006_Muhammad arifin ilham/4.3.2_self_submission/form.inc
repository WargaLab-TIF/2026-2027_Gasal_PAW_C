<fieldset>
    <legend>Person Details</legend>
    <form name="myForm" action="processData_form.php" method="POST">
        <div>
            <label for="surname">Surname</label>
            <input type="text" id="surname" name="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>" size="31" />
        </div>
        <div>
            <label for="email">Email address</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" size="31" />
        </div>
        <div>
            <label for="passwd">Password</label>
            <input type="password" id="passwd" name="passwd" size="31" />
        </div>
        <div>
            <label for="address">Street Address</label>
            <textarea id="address" name="address" rows="3" cols="22"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
        </div>
        <div>
            <label for="state">State</label>
            <select id="state" name="state">
                <?php
                $states = [
                    "-1" => "[choose your state]",
                    "1" => "Australian Capital Territory",
                    "2" => "Queensland",
                    "3" => "Victoria",
                    "4" => "New South Wales",
                    "5" => "Tasmania",
                    "6" => "South Australia",
                    "7" => "Western Australia",
                    "8" => "Northern Territory"
                ];
                $selectedState = isset($_POST['state']) ? $_POST['state'] : '-1';
                foreach ($states as $val => $label) {
                    $selected = ($val == $selectedState) ? 'selected' : '';
                    echo "<option value=\"$val\" $selected>$label</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <input type="hidden" name="country" value="Australia" />
        </div>
        <div>
            <label>Gender</label>
            <?php $selectedSex = isset($_POST['sex']) ? $_POST['sex'] : ''; ?>
            <input type="radio" name="sex" id="male" value="male" <?php echo ($selectedSex === 'male') ? 'checked' : ''; ?> /><label for="male">Male</label>
            <input type="radio" name="sex" id="female" value="female" <?php echo ($selectedSex === 'female') ? 'checked' : ''; ?> /><label for="female">Female</label>
        </div>
        <div>
            <label for="vegetarian">Vegetarian?</label>
            <input type="checkbox" id="vegetarian" name="vegetarian" <?php echo isset($_POST['vegetarian']) ? 'checked' : ''; ?> />
        </div>
        <div>
            <input type="submit" name="submit" value="Submit" />
            <input type="reset" name="reset" value="Reset" />
        </div>
    </form>
</fieldset>