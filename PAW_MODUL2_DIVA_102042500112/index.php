<?php
require 'koneksi.php';

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$stmt = mysqli_prepare($conn, "SELECT * FROM showroom_mobil WHERE nama_mobil LIKE ? ORDER BY id DESC");
$keyword = "%".$cari."%";
mysqli_stmt_bind_param($stmt, "s", $keyword);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Showroom Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Showroom Mobil</h1>

<p><a href="tambah.php">+ Tambah Mobil</a></p>

<form method="GET" action="index.php">
    <input type="text" name="cari"
           placeholder="Cari nama mobil..."
           value="<?= htmlspecialchars($cari); ?>">
    <button type="submit">Cari</button>
    <a href="index.php">Reset</a>
</form>

<br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Kode Mobil</th>
        <th>Nama Mobil</th>
        <th>Brand</th>
        <th>Warna</th>
        <th>Tipe</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    while ($mobil = mysqli_fetch_assoc($query)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($mobil['kode_mobil']); ?></td>
        <td><?= htmlspecialchars($mobil['nama_mobil']); ?></td>
        <td><?= htmlspecialchars($mobil['brand_mobil']); ?></td>
        <td><?= htmlspecialchars($mobil['warna_mobil']); ?></td>
        <td><?= htmlspecialchars($mobil['tipe_mobil']); ?></td>
        <td>Rp <?= number_format($mobil['harga_mobil'], 0, ',', '.'); ?></td>
        <td>
            <a href="detail.php?id=<?= (int)$mobil['id']; ?>">Detail</a> |
            <a href="edit.php?id=<?= (int)$mobil['id']; ?>">Edit</a> |
            <a href="hapus.php?id=<?= (int)$mobil['id']; ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>

    <?php if (mysqli_num_rows($query) == 0) { ?>
    <tr>
        <td colspan="8">Mobil tidak ditemukan.</td>
    </tr>
    <?php } ?>
</table>

</body>
</html>