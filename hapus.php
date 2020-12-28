<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$id = $_GET["id"];
	
if (hapus($id) > 0) {
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

?>