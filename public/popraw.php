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

	$nowy_tytul = $_POST['tytul'];
	$nowy_autor = $_POST['autor'];
	if(strlen($_POST['cena']) != 0){
		$nowa_cena = abs(number_format($_POST['cena'], 2, '.', ','));
	}
	$id = $_GET['id'];

	if(strlen($nowy_tytul) != 0){
		$pdo -> exec("UPDATE ksiazki SET tytul='".$nowy_tytul."' WHERE id='".$id."'");
		echo "Tytuł książki został poprawnie zmieniony na: ".$nowy_tytul;
	}
	if(strlen($nowy_autor) != 0){
		$pdo -> exec("UPDATE ksiazki SET autor='".$nowy_autor."' WHERE id='".$id."'");
		echo "Autor książki został poprawnie zmieniony na: ".$nowy_autor;
	}
	if(strlen($nowa_cena) != 0){
		$pdo -> exec("UPDATE ksiazki SET cena='".$nowa_cena."' WHERE id='".$id."'");
		echo "Cena książki została poprawnie zmienionya na: ".$nowa_cena;
	}
	
?>