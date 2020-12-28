<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$santri = query("SELECT * FROM kamar_11");

if (isset($_POST["cari"])) {
    $santri = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Santri</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 120px;
            left: 160px;
            z-index: -1;
            display: none;
        }
    </style>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>

    <a href="logout.php">Logout</a>

    <h1>Daftar Santri Kamar 11</h1>

    <a href="tambah.php">Tambahkan Data</a>
    <br><br>

    <form action="" method="post">

        <input type="text" name="keyword" autocomplete="off" autofocus="" placeholder="masukkan keyword" id="keyword">
        <button type="submit" name="cari" id="cari">Cari</button>
        <img src="img/loader.gif" class="loader">

    </form>
    <br>

    <div id="container">

    <table border="1" cellpadding="15" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Edit</th>
            <th>Nama</th>
            <th>Asal</th>
            <th>Sekolah</th>
            <th>Nomor Lemari</th>
            <th>Gambar</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($santri as $san) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><a href="ubah.php?id=<?= $san["id"] ?>">Ubah</a> | <a href="hapus.php?id=<?= $san["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a></td>
            <td><?= $san["nama"] ?></td>
            <td><?= $san["asal"] ?></td>
            <td><?= $san["sekolah"] ?></td>
            <td><?= $san["nomor_lemari"] ?></td>
            <td><img src="img/<?= $san["gambar"] ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    </div>
</body>
</html>