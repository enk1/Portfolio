<?php
	session_start();

	if(isset($_SESSION['login'])) {
		$usun = $_GET['id'];
		$_SESSION[$usun] = 0;
		header('Location: dodaj.php');
	} else {
		header('Location: zaloguj.php');
	}
?>