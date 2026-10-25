<?php
// 1. Validasi Surname (Wajib diisi & hanya alfabet)
function validateName(&$errors, $field_list, $field_name) 
{ 
    $pattern = "/^[a-zA-Z'-]+$/"; 
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'Surname wajib diisi.'; 
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Surname hanya boleh berisi huruf alfabet.'; 
    }
} 

// 2. Validasi Email Address (Wajib diisi & format email benar)
function validateEmail(&$errors, $field_list, $field_name) 
{
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'Email address wajib diisi.';
    } else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'Format email address tidak valid.';
    }
}

// 3. Validasi Password (Wajib diisi & minimal 6 karakter)
function validatePassword(&$errors, $field_list, $field_name) 
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Password wajib diisi.';
    } else if (strlen($field_list[$field_name]) < 6) {
        $errors[$field_name] = 'Password minimal harus 6 karakter.';
    }
}

// 4. Validasi State Dropdown (Wajib memilih salah satu negara bagian)
function validateState(&$errors, $field_list, $field_name) 
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == "-1") {
        $errors[$field_name] = 'Silakan pilih State Anda.';
    }
}
?>