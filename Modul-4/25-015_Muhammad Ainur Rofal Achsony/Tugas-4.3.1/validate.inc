<?php
// Fungsi validasi sederhana untuk field surname (4.3.1).
// Pesan error disimpan ke array $errors yang dilewatkan secara by reference.
function validateName(&$errors, $field_list, $field_name)
{
    // Format surname: alfabet, apostrof, dan tanda hubung.
    $pattern = "/^[a-zA-Z'-]+$/";

    if (!isset($field_list[$field_name]) || is_array($field_list[$field_name])
        || trim($field_list[$field_name]) === '') {
        $errors[$field_name] = 'required';
    } else if (!preg_match($pattern, trim($field_list[$field_name]))) {
        $errors[$field_name] = 'invalid';
    }
}
?>
