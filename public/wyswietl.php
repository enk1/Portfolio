<?php
	include('baza.php');
	
	//Pobranie i przypisanie bazy użytkowników do zmiennej tablicowej
	$login = "nosek";

	$db = $pdo->query("SELECT * FROM users WHERE login='".$login."'");

	echo '<table border="1">';
		echo '<tr>';
			echo '<th>Nazwisko</th>';
			echo '<th>Imię</th>';
			echo '<th>Login</th>';
			echo '<th style="color: red;">Hasło</th>';
			echo '<th>E-mail</th>';
			echo '<th>Ulica</th>';
			echo '<th>Nr budynku</th>';
			echo '<th>Nr mieszkania<br>(jeśli dotyczy)</th>';
			echo '<th>Miejscowość</th>';
			echo '<th>Kod pocztowy</th>';
			echo '<th>Wykształcenie</th>';
			echo '<th>Zainteresowania</th>';
		echo '</tr>';	
	//Pętla wyświetlająca rekordy z tablicy
	foreach($db->fetchAll() as $value){
		echo '<tr>';
			echo '<td>'.$value['nazwisko'].'</td>';
			echo '<td>'.$value['imie'].'</td>';
			echo '<td>'.$value['login'].'</td>';
			echo '<td>'.$value['haslo'].'</td>';
			echo '<td>'.$value['email'].'</td>';
			echo '<td>'.$value['ulica'].'</td>';
			echo '<td>'.$value['budynek'].'</td>';
			echo '<td>'.$value['mieszkanie'].'</td>';
			echo '<td>'.$value['miejscowosc'].'</td>';
			echo '<td>'.$value['kod'].'</td>';
			echo '<td>'.$value['wyksztalcenie'].'</td>';
			echo '<td>'.$value['zainteresowania'].'</td>';
		echo '</tr>';
		}
	echo '</table>';
?>