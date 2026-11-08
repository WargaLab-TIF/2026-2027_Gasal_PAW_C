<?php
function validateName(&$errors, $field_list, $field_name) {
    $pattern = "/^[a-zA-Z'-]+$/";
    $val = trim($field_list[$field_name] ?? '');

    if (empty($val)) {
        $errors[$field_name] = 'required';
    } else if (!preg_match($pattern, $val)) {
        $errors[$field_name] = 'invalid (harus huruf alfabet)';
    }
}
function validateEmail(&$errors, $field_list, $field_name) {
    $email = trim($field_list[$field_name] ?? '');
    if (empty($email)) {
        $errors[$field_name] = 'required';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'invalid format email';
    }
}
function validateRequired(&$errors, $field_list, $field_name) {
    $val = trim($field_list[$field_name] ?? '');
    if (empty($val)) {
        $errors[$field_name] = 'required';
    }
}
?>