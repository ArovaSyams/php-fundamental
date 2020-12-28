<?php 

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$id = $_GET["id"];	

$santri = query("SELECT * FROM kamar_11 WHERE id = $id")[0];

if (isset($_POST["submit"])) {

	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Diubah')
				document.location.href='index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah')
				document.location.href='index.php';
			</script>
		";
	}	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Santri</title>
</head>
<body>
	<h1>Edit data Santri</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $santri["id"] ?>">
		<ul>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" required value="<?= $santri["nama"] ?>">
			</li>
			<li>
				<label for="asal">Asal : </label>
				<input type="text" name="asal" id="asal" value="<?= $santri["asal"] ?>">
			</li>
			<li>
				<label for="sekolah">Sekolah : </label>
				<input type="text" name="sekolah" id="sekolah" value="<?= $santri["sekolah"] ?>">
			</li>
			<li>
				<label for="lemari">Nomor Lemari : </label>
				<input type="text" name="lemari" id="lemari" value="<?= $santri["nomor_lemari"] ?>">
			</li>
			<li>
				<label for="gambar">Gambar</label>
				<img src="img/<?= $santri["gambar"] ?>">
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Edit Data</button>
			</li>
		</ul>
	</form>
</body>
</html>