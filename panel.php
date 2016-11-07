<?php
	ob_start();
	session_start();
	include('baza.php');
	
	if(isset($_SESSION['login'])) {
		if($_SESSION['login'] == 'admin') {
			echo "<a href=\"sklep.php\">Powrót do sklepu</a>";
		}
		else {
			header('Location: sklep.php');
		}
	} else {
		header('Location: index.php');
	}
?>

<html>
<head>
	<meta charset="utf-8" />
	<title>Strona główna</title>
	<style>
		div {
			margin-left: 5%;
			margin-top: 2%;
		}
		input{
			width: 100px;
		}
	</style>
</head>			
<body>
	<div>
		<p>Pole edycji tabeli <b>Książki</b>:</p>
		<p><i>Uwaga! Możesz zmienić na raz tylko jeden rekord z tabeli <b>Książki</b>!</i></p>
		<?php
			try {
				$db = $pdo->query("SELECT * FROM ksiazki");
				foreach($db->fetchAll() as $value) {
					echo '<form method="POST" action="popraw.php?id='.$value['id'].'">';
						echo 'Tytuł: '.$value['tytul'].' [popraw na: <input type="text" name="tytul" />] <br>';
						echo 'Autor: '.$value['autor'].' [popraw na: <input type="text" name="autor" />] <br>';
						echo 'Cena: '.$value['cena'].' [popraw na: <input type="number" step="any" name="cena" />] <br>';
						echo '<input type="submit" value="Zmień" />	<input type="reset" value="Wyczyść" /><br>';
						echo '<a href="usun_ksiazke.php?id='.$value['id'].'">Usuń</a>';
					echo '</form><br><br>';
				}
				echo '<br><br><form method="POST" action="nowa_ksiazka.php">';
					echo '<fieldset>';
						echo '<legend><b>Formularz dodawania nowej książki</b></legend>';
						echo '<label>Nazwisko autora:</label> <input type="text" name="autor" /><br>';
						echo '<label>Tytuł ksiązki:</label> <input type="text" name="tytul" /><br>';
						echo '<label>Cena:</label> <input type="number" step="any" name="cena" /><br><br><br>';
						echo '<input type="submit" value="Dodaj" />	<input type="reset" value="Wyczyść" />';
					echo '</fieldset>';
				echo '</form>';
			} catch(PDOException $e) {
		 		echo 'Wystapił blad biblioteki PDO: ' . $e->getMessage();
			}
		?>
	</div>
</body>
</html>

<?php
	ob_flush();
?>