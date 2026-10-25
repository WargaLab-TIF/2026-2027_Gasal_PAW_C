<?php
// Helper untuk menampilkan nilai lama, pesan error, dan status pilihan form.
function postValue($name)
{
  if (!isset($_POST[$name])) {
    return '';
  }
  $value = is_array($_POST[$name])
    ? implode(', ', $_POST[$name]) : $_POST[$name];
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function fieldError($errors, $name)
{
  if (isset($errors[$name])) {
    return ' <strong>' . htmlspecialchars($errors[$name]) . '</strong>';
  }
  return '';
}

function stateSelected($value)
{
  return (isset($_POST['state'])
    && (string) $_POST['state'] === (string) $value) ? ' selected' : '';
}

function sexChecked($value)
{
  return (isset($_POST['sex']) && $_POST['sex'] === $value) ? ' checked' : '';
}
?>
<h2>Register</h2>
<fieldset>
  <legend>Person Details</legend>
  <form name="myForm" action="prosesData_form.php" method="POST" novalidate>
    <table>
      <tr>
        <td><label for="surname">Surname</label></td>
        <td>
          <input type="text" id="surname" name="surname" size="31"
                 value="<?php echo postValue('surname'); ?>">
          <?php echo fieldError($errors, 'surname'); ?>
        </td>
      </tr>
      <tr>
        <td><label for="email">Email address</label></td>
        <td>
          <input type="email" id="email" name="email" size="31"
                 value="<?php echo postValue('email'); ?>">
          <?php echo fieldError($errors, 'email'); ?>
        </td>
      </tr>
      <tr>
        <td><label for="password">Password</label></td>
        <td>
          <input type="password" id="password" name="password" size="31"
                 value="<?php echo postValue('password'); ?>">
          <?php echo fieldError($errors, 'password'); ?>
        </td>
      </tr>
      <tr>
        <td><label for="address">Street Address</label></td>
        <td>
          <textarea id="address" name="address" cols="30" rows="3"><?php
            echo postValue('address');
          ?></textarea>
          <?php echo fieldError($errors, 'address'); ?>
        </td>
      </tr>
      <tr>
        <td><label for="state">State</label></td>
        <td>
          <select id="state" name="state">
            <option value="-1"
                    <?php echo stateSelected('-1'); ?>>[choose your state]</option>
            <option value="1"
                    <?php echo stateSelected('1'); ?>>Australian Capital Territory</option>
            <option value="2"
                    <?php echo stateSelected('2'); ?>>Queensland</option>
            <option value="3"
                    <?php echo stateSelected('3'); ?>>Victoria</option>
            <option value="4"
                    <?php echo stateSelected('4'); ?>>New South Wales</option>
            <option value="5"
                    <?php echo stateSelected('5'); ?>>Tasmania</option>
            <option value="6"
                    <?php echo stateSelected('6'); ?>>South Australia</option>
            <option value="7"
                    <?php echo stateSelected('7'); ?>>Western Australia</option>
            <option value="8"
                    <?php echo stateSelected('8'); ?>>Northern Territory</option>
          </select>
          <input type="hidden" name="country" value="Australia">
          <?php echo fieldError($errors, 'state'); ?>
        </td>
      </tr>
      <tr>
        <td><label>Gender</label></td>
        <td>
          <input type="radio" id="male" name="sex" value="male"
                 <?php echo sexChecked('male'); ?>>
          <label for="male">Male</label>
          <input type="radio" id="female" name="sex" value="female"
                 <?php echo sexChecked('female'); ?>>
          <label for="female">Female</label>
          <?php echo fieldError($errors, 'sex'); ?>
        </td>
      </tr>
      <tr>
        <td><label for="vegetarian">Vegetarian?</label></td>
        <td>
          <input type="checkbox" id="vegetarian" name="vegetarian" value="yes"
                 <?php echo isset($_POST['vegetarian']) ? ' checked' : ''; ?>>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type="submit" value="Submit" name="submit">
          <input type="reset" value="Reset" name="reset">
        </td>
      </tr>
    </table>
  </form>
</fieldset>
