<?php 
session_start();
require 'function.php';

if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
	$id = $_COOKIE["id"];
	$key = $_COOKIE["key"];

	//cek username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//cek kecocokan input dan bd
	if ($key === hash(sha512, $row["username"])) {
		$_SESSION["login"] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}

if (isset($_POST["login"])) {
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if (mysqli_num_rows($result) === 1) {

		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			header("Location: index.php");	
			//mulai session
			$_SESSION["login"] = true;

			//jika cookie
			if (isset($_POST["remember"])) {
				setcookie('id', $row["id"], time() + 60);
				setcookie('key', hash(sha512, $username));
			}

			exit;
		}
	}

	$error = true;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<h1>Log In</h1>

	<?php if (isset($error)) : ?>
		<p style="color: red">username / password anda salah</p>
	<?php  endif;?>

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
				<input type="checkbox" name="remember" id="remember">
				<label for="remember">Remember Me</label>
			</li>
			<li>
				<button type="submit" name="login">Login</button>
			</li>
		</ul>
	</form>

</body>
</html>