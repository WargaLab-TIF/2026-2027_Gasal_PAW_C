<fieldset>
    <legend>Person Details</legend>
    <form name="myform" action="" method="POST">
        <div class="field">
            <label for="surname">Surname</label>
            <input type="text" name="surname" size="31" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>" />
            <span style="color:red;"><?php echo isset($errors['surname']) ? $errors['surname'] : ''; ?></span>
        </div>
        <div class="field">
            <label for="email">Email address</label>
            <input type="text" name="email" size="31" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
            <span style="color:red;"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
        </div>
        <div class="field">
            <label for="passwd">Password</label>
            <input type="password" name="passwd" size="31" />
            <span style="color:red;"><?php echo isset($errors['passwd']) ? $errors['passwd'] : ''; ?></span>
        </div>
        
        <!-- (Sisa field seperti address, state, dll biarkan seperti aslinya) -->
        
        <div class="field">
            <label>&nbsp;</label>
            <input type="submit" value="Submit" name="submit" />
            <input type="reset" value="Reset" name="reset" />
        </div>
    </form>
</fieldset>