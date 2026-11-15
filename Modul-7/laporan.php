<?php

declare(strict_types=1);

function koneksi(): mysqli
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli(
        getenv('DB_HOST') ?: 'localhost',
        getenv('DB_USER') ?: 'root',
        getenv('DB_PASS') ?: '',
        getenv('DB_NAME') ?: 'penjualan'
    );
    $conn->set_charset('utf8mb4');
    return $conn;
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function rupiah(int|float|string $value): string
{
    return 'Rp ' . number_format((float) $value, 0, ',', '.');
}

function tanggalValid(mixed $value): bool
{
    if (!is_string($value) || !preg_match('/^[1-9][0-9]{3}-[0-9]{2}-[0-9]{2}$/D', $value)) {
        return false;
    }
    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value);
    return $date !== false && $date->format('Y-m-d') === $value;
}

function filterTanggal(array $input): array
{
    $mulai = $input['tanggal_mulai'] ?? '';
    $selesai = $input['tanggal_selesai'] ?? '';
    if (!tanggalValid($mulai) || !tanggalValid($selesai)) {
        throw new InvalidArgumentException('Isi tanggal mulai dan tanggal selesai dengan tanggal yang valid.');
    }
    if ($mulai > $selesai) {
        throw new InvalidArgumentException('Tanggal mulai tidak boleh melewati tanggal selesai.');
    }
    return [$mulai, $selesai];
}

function ambilLaporan(mysqli $conn, string $mulai, string $selesai): array
{
    $conn->begin_transaction(MYSQLI_TRANS_START_READ_ONLY | MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
    try {
        $stmt = $conn->prepare('SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total_harian FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ? GROUP BY DATE(waktu_transaksi) ORDER BY tanggal ASC');
        $stmt->bind_param('ss', $mulai, $selesai);
        $stmt->execute();
        $rekap = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        $stmt = $conn->prepare('SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan, COALESCE(SUM(total), 0) AS total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?');
        $stmt->bind_param('ss', $mulai, $selesai);
        $stmt->execute();
        $ringkasan = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->commit();
        return ['rekap' => $rekap, 'ringkasan' => $ringkasan];
    } catch (Throwable $error) {
        $conn->rollback();
        throw $error;
    }
}
