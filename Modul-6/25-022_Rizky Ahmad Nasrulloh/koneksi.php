<?php
/**
 * Modul 6 : Pengelolaan Master Detil Data
 * Nama : Rizky Ahmad Nasrulloh
 * NIM  : 25-022
 *
 * Koneksi database + helper yang dipakai semua halaman.
 */

declare(strict_types=1);

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'tp6_praktikum';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $ex) {
    http_response_code(500);
    exit(
        '<h1>Koneksi database gagal</h1>'
        . '<p>' . htmlspecialchars($ex->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>'
        . '<p>Pastikan MySQL sudah berjalan dan file <code>database/tp6_praktikum.sql</code> sudah diimpor.</p>'
    );
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

function rupiah(int|float|string $value): string
{
    return 'Rp ' . number_format((float) $value, 0, ',', '.');
}
