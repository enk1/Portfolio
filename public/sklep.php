<?php
	ob_start();
	session_start();
	include('baza.php');
	
	unset($_SESSION['produkt_A']);
	unset($_SESSION['produkt_B']);
	unset($_SESSION['produkt_C']);
	unset($_SESSION['produkt_D']);
?>

<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="/dist/vendors/bootstrap.min.css">
	<script src="/dist/vendors/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="main.css" media="all">
</head>			
<body>
	<nav>
		<ul class="shop-nav">
			<li>
				<?php
					if(isset($_SESSION['login'])) {
						echo 'Witaj '.$_SESSION['login'].'! ';
						echo "<a href=\"logout.php\">Wyloguj</a>";

					} else {
						echo '<p>Witaj nieznajomy!';
						echo "<a href='index.php'>Zaloguj</a>";
					}
				?>
			</li>
		</ul>
	</nav>
	<div>
		<?php
			if(isset($_SESSION['login'])) {
				$db = $pdo->query("SELECT `ksiazki`.tytul, `ksiazki`.autor, `ksiazki`.cena, `ksiazki`.wydawnictwo_id, `wydawnictwo`.id, `wydawnictwo`.nazwa_wydawnictwa FROM `ksiazki` INNER JOIN `wydawnictwo` ON
				 `ksiazki`.wydawnictwo_id=`wydawnictwo`.id");
		?>
				
			<form method="POST" action="dodaj.php">
				<?php
					foreach($db->fetchAll() as $value) {
						echo 'Tytuł: '.$value['tytul'].'<br>';
						echo 'Autor: '.$value['autor'].'<br>';
						echo 'Cena: '.$value['cena'].'<br>';
						echo 'Wydawnictwo: '.$value['wydawnictwo_id'].'<br>';
						echo 'Ilość zamówionych produktów: <input type="number" name="'.$value['id'].'" /><br><br><br>';
					}
				?>
				<input type="submit" value="Zamów" />	<input type="reset" value="Wyczyść" />
			</form>
		<?php
			} else { 
				echo "Przejdź do strony <a href=\"index.php\">logowania</a>.";
			}?>
	</div>	
	<div style="text-align: center;">
		<?php
			if(isset($_SESSION['login'])) {
				if($_SESSION['login'] == 'admin') {
					echo "<a href=\"panel.php\">Panel administratora</a>";

				}
				else {
					echo "Księgarnia internetowa sp. z o.o.";
				}
			}
		?>
	</div>
</body>
</html>
<?php
	ob_flush();
?>