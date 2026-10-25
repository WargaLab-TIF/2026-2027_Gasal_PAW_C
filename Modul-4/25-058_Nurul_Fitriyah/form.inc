<fieldset>
    <legend>Person Details</legend>
    <form name="myForm" action="" method="POST">
        
        <!-- Surname -->
        <div class="field-wrapper">
            <div class="field">
                <label for="surname">Surname</label>
                <input type="text" name="surname" id="surname" size="31" 
                       value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
            </div>
            <?php if (isset($errors['surname'])): ?>
                <span class="error-text"><?php echo $errors['surname']; ?></span>
            <?php endif; ?>
        </div>

        <!-- Email address -->
        <div class="field-wrapper">
            <div class="field">
                <label for="email">Email address</label>
                <input type="text" name="email" id="email" size="31"
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <?php if (isset($errors['email'])): ?>
                <span class="error-text"><?php echo $errors['email']; ?></span>
            <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="field-wrapper">
            <div class="field">
                <label for="paswd">Password</label>
                <input type="password" name="paswd" id="paswd" size="31">
            </div>
            <?php if (isset($errors['paswd'])): ?>
                <span class="error-text"><?php echo $errors['paswd']; ?></span>
            <?php endif; ?>
        </div>

        <!-- Street Address -->
        <div class="field">
            <label for="address">Street Address</label>
            <textarea name="address" id="address" rows="3" cols="22"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
        </div>

        <!-- State -->
        <div class="field-wrapper">
            <div class="field">
                <label for="state">State</label>
                <select name="state" id="state">
                    <?php $state = isset($_POST['state']) ? $_POST['state'] : '-1'; ?>
                    <option value="-1" <?php if($state == '-1') echo 'selected'; ?>>Choose your state</option>
                    <option value="1" <?php if($state == '1') echo 'selected'; ?>>Australian Capital Territory</option>
                    <option value="2" <?php if($state == '2') echo 'selected'; ?>>Queensland</option>
                    <option value="3" <?php if($state == '3') echo 'selected'; ?>>Victoria</option>
                    <option value="4" <?php if($state == '4') echo 'selected'; ?>>New South Wales</option>
                    <option value="5" <?php if($state == '5') echo 'selected'; ?>>Tasmania</option>
                    <option value="6" <?php if($state == '6') echo 'selected'; ?>>South Australia</option>
                    <option value="7" <?php if($state == '7') echo 'selected'; ?>>Western Australia</option>
                    <option value="8" <?php if($state == '8') echo 'selected'; ?>>Northern Territory</option>
                </select>
            </div>
            <?php if (isset($errors['state'])): ?>
                <span class="error-text"><?php echo $errors['state']; ?></span>
            <?php endif; ?>
        </div>

        <!-- Country (Hidden) -->
        <input type="hidden" name="country" value="Australia">

        <!-- Gender -->
        <div class="field">
            <label>Gender</label>
            <div class="radio-group">
                <?php $sex = isset($_POST['sex']) ? $_POST['sex'] : ''; ?>
                <input type="radio" name="sex" id="male" value="male" <?php if($sex == 'male') echo 'checked'; ?>><label for="male" style="width:auto; margin-right:10px;">Male</label>
                <input type="radio" name="sex" id="female" value="female" <?php if($sex == 'female') echo 'checked'; ?>><label for="female" style="width:auto;">Female</label>
            </div>
        </div>

        <!-- Vegetarian -->
        <div class="field">
            <label for="vegetarian">Vegetarian?</label>
            <input type="checkbox" name="vegetarian" id="vegetarian" value="Yes" <?php if(isset($_POST['vegetarian'])) echo 'checked'; ?>>
        </div>

        <div class="buttons">
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
        </div>

    </form>
</fieldset>