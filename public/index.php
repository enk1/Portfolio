<?php
	session_start();
	ob_start();
?>
<!doctype html>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Bookstore - login</title>

	<link rel="stylesheet" type="text/css" href="/dist/vendors/bootstrap.min.css">
	<script src="/dist/vendors/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="main.css" media="all">
</head>			
<body>
	<div class="login-form">
		<form class="login" method="POST" action="login.php">
			<input type="text" name="login" maxlength="32" placeholder="Login" onfocus="this.placeholder=''" onblur="this.placeholder='Login'">
			<input type="password" name="haslo" maxlength="32" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'">
			<button type="submit" name="zaloguj">Zaloguj</button> <a class="register" href="rejestracja.php">Zarejestruj</a>
		</form>
	</div>	
</body>
</html>
<?php
	ob_flush();
?>