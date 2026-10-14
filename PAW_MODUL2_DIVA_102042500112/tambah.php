<?php
require 'koneksi.php';

$pesan = '';

if (isset($_POST['simpan'])) {
    $kode = trim($_POST['kode_mobil']);
    $nama = trim($_POST['nama_mobil']);
    $brand = trim($_POST['brand_mobil']);
    $warna = trim($_POST['warna_mobil']);
    $tipe = trim($_POST['tipe_mobil']);
    $harga = $_POST['harga_mobil'];

    if ($kode == '' || $nama == '' || $brand == '' ||
        $warna == '' || $tipe == '' || $harga == '') {
        $pesan = 'Semua data wajib diisi!';
    } elseif (!is_numeric($harga) || $harga <= 0) {
        $pesan = 'Harga harus berupa angka lebih dari 0!';
    } else {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO showroom_mobil
            (kode_mobil, nama_mobil, brand_mobil, warna_mobil, tipe_mobil, harga_mobil)
            VALUES (?, ?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param(
            $stmt, "sssssd",
            $kode, $nama, $brand, $warna, $tipe, $harga
        );

        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php');
            exit;
        } else {
            $pesan = 'Kode mobil sudah digunakan atau data gagal disimpan.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Tambah Mobil</h1>

<?php if ($pesan != '') { ?>
    <p><?= htmlspecialchars($pesan); ?></p>
<?php } ?>

<form method="POST">
    <p>Kode Mobil</p>
    <input type="text" name="kode_mobil" required>

    <p>Nama Mobil</p>
    <input type="text" name="nama_mobil" required>

    <p>Brand Mobil</p>
    <input type="text" name="brand_mobil" required>

    <p>Warna Mobil</p>
    <input type="text" name="warna_mobil" required>

    <p>Tipe Mobil</p>
    <select name="tipe_mobil" required>
        <option value="">Pilih Tipe</option>
        <option value="MPV">MPV</option>
        <option value="SUV">SUV</option>
        <option value="Sedan">Sedan</option>
        <option value="Hatchback">Hatchback</option>
        <option value="Pickup">Pickup</option>
        <option value="Lainnya">Lainnya</option>
    </select>

    <p>Harga Mobil</p>
    <input type="number" name="harga_mobil" min="1" required>

    <br><br>
    <button type="submit" name="simpan">Simpan Mobil</button>
    <a href="index.php">Kembali</a>
</form>

</body>
</html>