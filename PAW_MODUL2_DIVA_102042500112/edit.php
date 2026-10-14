<?php
require 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("ID mobil tidak valid.");
}

if (isset($_POST['simpan'])) {
    $warna = $_POST['warna_mobil'];
    $harga = (int)$_POST['harga_mobil'];

    $stmt = mysqli_prepare($conn, "UPDATE showroom_mobil SET warna_mobil = ?, harga_mobil = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sii", $warna, $harga, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah data mobil.";
    }
}

$stmt = mysqli_prepare($conn, "SELECT * FROM showroom_mobil WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$mobil = mysqli_fetch_assoc($result);

if (!$mobil) {
    die("Mobil tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Edit Mobil</h1>

<form method="POST">
    <label>Nama Mobil</label><br>
    <input type="text"
           value="<?= htmlspecialchars($mobil['nama_mobil']); ?>"
           disabled><br><br>

    <label>Warna Mobil</label><br>
    <input type="text" name="warna_mobil"
           value="<?= htmlspecialchars($mobil['warna_mobil']); ?>"
           required><br><br>

    <label>Harga Mobil</label><br>
    <input type="number" name="harga_mobil"
           value="<?= (int)$mobil['harga_mobil']; ?>"
           min="0" required><br><br>

    <button type="submit" name="simpan">Simpan Perubahan</button>
    <a href="index.php">Batal</a>
</form>

</body>
</html>