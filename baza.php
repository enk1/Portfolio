<?php

	$servername = "mysql.cba.pl";
	$username = "enk1du";
	$password = "Internet123";
	$dbname = "271828182_c0_pl";

	//Obsługa PDO

	try {
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname; encoding=utf8", $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo 'Polaczenie z baza! :)';
	} catch(PDOExeption $e){
		echo 'Błąd: '.$e->getMessage();
	}
	
?>