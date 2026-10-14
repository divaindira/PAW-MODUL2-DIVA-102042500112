<?php
require 'koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM showroom_mobil WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$mobil = mysqli_fetch_assoc($result);

if (!$mobil) {
    die('Data mobil tidak ditemukan.');
}

if (isset($_POST['hapus'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM showroom_mobil WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Hapus Mobil</h1>

<p>Apakah kamu yakin ingin menghapus mobil ini?</p>

<p>
    <b>Nama Mobil:</b>
    <?= htmlspecialchars($mobil['nama_mobil']); ?>
</p>

<p>
    <b>Kode Mobil:</b>
    <?= htmlspecialchars($mobil['kode_mobil']); ?>
</p>

<form method="POST">
    <button type="submit" name="hapus">Ya, Hapus</button>
    <a href="index.php">Batal</a>
</form>

</body>
</html>