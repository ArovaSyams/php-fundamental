<?php 

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

if (isset($_POST["submit"])) {

	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan')
				document.location.href='index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan')
				document.location.href='index.php';
			</script>
		";
	}	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Santri</title>
</head>
<body>
	<h1>Tambah data Santri</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li>
				<label for="asal">Asal : </label>
				<input type="text" name="asal" id="asal">
			</li>
			<li>
				<label for="sekolah">Sekolah : </label>
				<input type="text" name="sekolah" id="sekolah">
			</li>
			<li>
				<label for="lemari">Nomor Lemari : </label>
				<input type="text" name="lemari" id="lemari">
			</li>
			<li>
				<label for="gambar">Gambar</label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Tambahkan Data</button>
			</li>
		</ul>
	</form>
</body>
</html>