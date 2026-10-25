<?php
// Validasi server-side untuk seluruh field form (4.3.2 langkah 9).
// $errors dikirim by reference agar pesan error tiap field dapat ditampung.
function validateName(&$errors, $field_list, $field_name)
{
    $value = (isset($field_list[$field_name]) && !is_array($field_list[$field_name]))
        ? trim($field_list[$field_name]) : '';

    if ($field_name === 'surname') {
        if ($value === '') {
            $errors[$field_name] = 'required';
        } else if (!preg_match("/^[a-zA-Z'-]+$/", $value)) {
            $errors[$field_name] = 'invalid';
        }
    } else if ($field_name === 'email') {
        if ($value === '') {
            $errors[$field_name] = 'required';
        } else if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$field_name] = 'invalid';
        }
    } else if ($field_name === 'password') {
        if ($value === '') {
            $errors[$field_name] = 'required';
        } else if (strlen($value) < 6) {
            $errors[$field_name] = 'minimal 6 karakter';
        }
    } else if ($field_name === 'address') {
        if ($value === '') {
            $errors[$field_name] = 'required';
        }
    } else if ($field_name === 'state') {
        $states = array('1', '2', '3', '4', '5', '6', '7', '8');
        if ($value === '' || $value === '-1') {
            $errors[$field_name] = 'required';
        } else if (!in_array($value, $states, true)) {
            $errors[$field_name] = 'invalid';
        }
    } else if ($field_name === 'sex') {
        if ($value === '') {
            $errors[$field_name] = 'required';
        } else if (!in_array($value, array('male', 'female'), true)) {
            $errors[$field_name] = 'invalid';
        }
    }
}
?>
