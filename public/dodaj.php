<?php
	ob_start();
	session_start();
	include('baza.php');

	if(!isset($_SESSION['produkt_A']) || !isset($_SESSION['produkt_B']) || !isset($_SESSION['produkt_C']) || !isset($_SESSION['produkt_D'])) {
		$_SESSION['produkt_A'] = abs(floor($_POST['1']));
		$_SESSION['produkt_B'] = abs(floor($_POST['6']));
		$_SESSION['produkt_C'] = abs(floor($_POST['5']));
		$_SESSION['produkt_D'] = abs(floor($_POST['4']));
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
		</style>
	</head>			
	<body>
		<div>
			<p>Zamówienie:</p>
			<?php
				if(isset($_SESSION['login'])) {
					$suma = 0;

					if($_SESSION['produkt_A'] != 0) {
						echo 'Książka A, sztuk '.$_SESSION['produkt_A'].' w cenie '.$_SESSION['produkt_A']*29.9;
						echo ' .            <a href="usun.php?id=produkt_A">Usuń z koszyka</a>';
						echo '<br><br>';
						$suma += ($_SESSION['produkt_A']*29.9);
						$a = 'Książka A, sztuk '.$_SESSION['produkt_A'].' w cenie '.$_SESSION['produkt_A']*29.9;
					}
					if($_SESSION['produkt_B'] != 0) {
						echo 'Książka B, sztuk '.$_SESSION['produkt_B'].' w cenie '.$_SESSION['produkt_B']*35.35;
						echo ' .            <a href="usun.php?id=produkt_B">Usuń z koszyka</a>';
						echo '<br><br>';
						$suma += ($_SESSION['produkt_B']*35.35);
						$b = 'Książka B, sztuk '.$_SESSION['produkt_B'].' w cenie '.$_SESSION['produkt_B']*35.35;
					}
					if($_SESSION['produkt_C'] != 0) {
						echo 'Książka C, sztuk '.$_SESSION['produkt_C'].' w cenie '.$_SESSION['produkt_C']*19.9;
						echo ' .            <a href="usun.php?id=produkt_C">Usuń z koszyka</a>';
						echo '<br><br>';
						$suma += ($_SESSION['produkt_C']*19.9);
						$c = 'Książka C, sztuk '.$_SESSION['produkt_C'].' w cenie '.$_SESSION['produkt_C']*19.9;
					}
					if($_SESSION['produkt_D'] != 0) {
						echo 'Książka D, sztuk '.$_SESSION['produkt_D'].' w cenie '.$_SESSION['produkt_D']*50;
						echo ' .            <a href="usun.php?id=produkt_D">Usuń z koszyka</a>';
						echo '<br><br>';
						$suma += ($_SESSION['produkt_D']*50);
						$d = 'Książka D, sztuk '.$_SESSION['produkt_D'].' w cenie '.$_SESSION['produkt_D']*50;
					}

					echo '<p>W sumie: '.$suma.' zł</p><br><br>';
					echo '<p><a href="sklep.php">Wróć do sklepu</a><br><br>';
					echo '<a href="zamow.php">Wyślij e-mail z zamówieniem</a>';

					//zmienne do maila
					
					$db = $pdo->query("SELECT * FROM users WHERE login='".$_SESSION['login']."'");
					foreach($db->fetchAll() as $value){
						$_SESSION['adres_dostawy_0'] = $value['imie'].' '.$value['nazwisko'];
						$_SESSION['adres_dostawy_1'] = 'ul. '.$value['ulica'].' '.$value['budynek'].'/'.$value['mieszkanie'];
						$_SESSION['adres_dostawy_2'] = $value['kod'].' '.$value['miejscowosc'];
					}
					
					$_SESSION['nadawca'] = $_SESSION['login'];
					$_SESSION['temat'] = "Zamówinie od ".$_SESSION['login'];

					$_SESSION['wiadomosc'] = $a.'<br>'.$b.'<br>'.$c.'<br>'.$d.'<br><br>W sumie '.$suma;

				} else {
					echo "Przejdź do strony <a href=\"index.php\">logowania</a>.";
				}
			?>
		<div>
	</body>
	</html>
<?php
	ob_flush();
?>