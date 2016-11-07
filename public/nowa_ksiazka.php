<?php
	ob_start();
        header('Content-Type: text/html; charset=utf-8');
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
	$cena = abs(number_format($_POST['cena'], 2, '.', ','));
	$nowa_cena = (string)$cena;

	echo $nowy_tytul.'<br>';
	echo $nowy_autor.'<br>';
	echo $nowa_cena.'<br>';
	
	if ((strlen($nowy_tytul) < 1) == TRUE){
		echo 'Pole <b>Tytuł</b> powinno zawierać przynajmniej 1 znak.';
		echo '<br><br><form action="./panel.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($nowy_autor) < 3) == TRUE) {
		echo 'Pole <b>Autor</b> powinno zawierać przynajmniej 3 znaki.';
		echo '<br><br><form action="./panel.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($nowa_cena) < 1) == TRUE) {
		echo 'Pole <b>Cena</b> powinno zawierać przynajmniej 1 znak.';
		echo '<br><br><form action="./panel.php"><input type="submit" value="Powrót"></form>';
	} else {
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$ilosc = $pdo -> exec("INSERT INTO ksiazki (tytul, cena, autor) VALUES ('".$nowy_tytul."', '".$nowa_cena."', '".$nowy_autor."')");
			//$ilosc = $pdo -> exec('INSERT INTO ksiazki (tytul, cena, autor) VALUES ('".$nowy_tytul."', '".$nowa_cena."', '".$nowy_autor."')');
			if ($ilosc > 0) {
		 		$db = $pdo->query("SELECT * FROM ksiazki WHERE tytul='".$nowy_tytul."'");
		 		echo 'Pomyślnie dodano książkę!<br><br>';
		 		echo '<table border="1">';
					echo '<tr>';
						echo '<th>Tytuł</th>';
						echo '<th>Autor</th>';
						echo '<th>Cena</th>';
					echo '</tr>';
					echo '<tr>';
					foreach($db->fetchAll() as $value){
						echo '<td>'.$value['tytul'].'</td>';
						echo '<td>'.$value['cena'].'</td>';
						echo '<td>'.$value['autor'].'</td>';
					}
					echo '</tr>';
				echo '</table>';
			} else {
		 		echo 'Oops! Wystąpił błąd podczas dodawania pozycji.';
		 	}
		}
		catch(PDOException $e) {
		 	echo 'Wystapił blad biblioteki PDO: ' . $e->getMessage();
		}
	}
?>			