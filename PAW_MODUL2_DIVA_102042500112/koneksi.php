<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'paw_modul2_showroom'
);

if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');

echo 'Koneksi database berhasil!';
?>