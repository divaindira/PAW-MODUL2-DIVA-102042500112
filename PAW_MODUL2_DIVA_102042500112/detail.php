<?php
require 'koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

$query = mysqli_prepare($conn, "SELECT * FROM showroom_mobil WHERE id = ?");
mysqli_stmt_bind_param($query, "i", $id);
mysqli_stmt_execute($query);

$result = mysqli_stmt_get_result($query);
$mobil = mysqli_fetch_assoc($result);

if (!$mobil) {
    die('Data mobil tidak ditemukan.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Detail Mobil</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Kode Mobil</th>
        <td><?= htmlspecialchars($mobil['kode_mobil']); ?></td>
    </tr>
    <tr>
        <th>Nama Mobil</th>
        <td><?= htmlspecialchars($mobil['nama_mobil']); ?></td>
    </tr>
    <tr>
        <th>Brand Mobil</th>
        <td><?= htmlspecialchars($mobil['brand_mobil']); ?></td>
    </tr>
    <tr>
        <th>Warna Mobil</th>
        <td><?= htmlspecialchars($mobil['warna_mobil']); ?></td>
    </tr>
    <tr>
        <th>Tipe Mobil</th>
        <td><?= htmlspecialchars($mobil['tipe_mobil']); ?></td>
    </tr>
    <tr>
        <th>Harga Mobil</th>
        <td>Rp <?= number_format($mobil['harga_mobil'], 0, ',', '.'); ?></td>
    </tr>
</table>

<br>
<a href="index.php">Kembali ke Daftar Mobil</a>

</body>
</html>