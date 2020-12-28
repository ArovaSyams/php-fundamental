<?php
require 'function.php';

if (isset($_POST["register"])) {
	if (registrasi($_POST)) {
		echo "
			<script>
				alert('Registrasi Berhasil');
			</script>
		";
	}else {
		echo mysqli_error($conn);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrasi</title>
</head>
<body>
	<h1>Registrasi</h1>

	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username : </label><br>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">Password : </label><br>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<label for="password2">Konfirmasi Password : </label><br>
				<input type="password" name="password2" id="password2">
			</li>
			<li>
				<button type="submit" name="register">Registrasi</button>
			</li>
		</ul>
	</form>
</body>
</html>