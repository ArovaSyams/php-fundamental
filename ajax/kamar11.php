<?php 


require '../function.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM kamar_11 WHERE 
            nama LIKE '%$keyword%' OR
            asal LIKE '%$keyword%' OR
            sekolah LIKE '%$keyword%' OR
            nomor_lemari LIKE '%$keyword%'
		";

$santri = query("$query");

?>

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