<?php
	ob_start();
	session_start();
	include('baza.php');
	
	if(isset($_SESSION['login'])) {
		if($_SESSION['login'] == 'admin') {
			echo "<a href=\"panel.php\">Panel administratora</a> ";
			echo " <a href=\"sklep.php\">Sklep</a>";
			echo '<br><br><br>';
		}
		else {
			header('Location: sklep.php');
		}
	} else {
		header('Location: index.php');
	}

	$id = $_GET['id'];
	$pdo -> exec("DELETE FROM `ksiazki` WHERE id='".$id."'");
	echo "Poprawnie usunięto książkę z bazy danych";
?>