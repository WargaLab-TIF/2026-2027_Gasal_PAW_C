<?php
function validateName(&$errors, $field_list, $field_name): void
{
    $pattern = "/^[a-zA-Z'-]+$/";
    $value = $field_list[$field_name] ?? null;
    if (!is_string($value) || trim($value) === '') {
        $errors[$field_name] = 'required';
    } elseif (!preg_match($pattern, trim($value))) {
        $errors[$field_name] = 'invalid';
    }
}

function validateEmail(&$errors, $field_list, $field_name): void
{
    $value = $field_list[$field_name] ?? null;
    if (!is_string($value) || trim($value) === '') {
        $errors[$field_name] = 'required';
    } elseif (!filter_var(trim($value), FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'invalid';
    }
}

function validateRequired(&$errors, $field_list, $field_name): void
{
    $value = $field_list[$field_name] ?? null;
    if (!is_string($value) || trim($value) === '') {
        $errors[$field_name] = 'required';
    }
}

function validateState(&$errors, $field_list, $field_name): void
{
    $allowed = ['1', '2', '3', '4', '5', '6', '7', '8'];
    $value = $field_list[$field_name] ?? null;
    if (!is_string($value) || !in_array($value, $allowed, true)) {
        $errors[$field_name] = 'required';
    }
}

function validateCountry(&$errors, $field_list, $field_name): void
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] !== 'Australia') {
        $errors[$field_name] = 'invalid';
    }
}

function validateSex(&$errors, $field_list, $field_name): void
{
    $allowed = ['male', 'female'];
    $value = $field_list[$field_name] ?? null;
    if (!is_string($value) || !in_array($value, $allowed, true)) {
        $errors[$field_name] = 'required';
    }
}
?>