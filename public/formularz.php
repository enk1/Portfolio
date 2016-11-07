<?php
	header('Content-Type: text/html; charset=utf-8');
	include('baza.php');

	$nazwisko = $_POST['nazwisko'];
	$imie = $_POST['imie'];
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	$email = $_POST['email'];
	$ulica = $_POST['ulica'];
	$budynek = $_POST['budynek'];
	$mieszkanie = $_POST['mieszkanie'];
	$miejscowosc = $_POST['miejscowosc'];
	$kod = $_POST['kod'];
	$wyksztalcenie = $_POST['wyksztalcenie'];

	//Sprawdzenie unikalności loginu i maila oraz walidacja pozostałych pól formularza
	if (($sql = 'SELECT * FROM `users` WHERE `login` = $login') == FALSE) {
		echo 'Login <b>'.$login.'</b> jest już w użyciu. Proszę o wybranie innego loginu.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif (($sql = 'SELECT * FROM `users` WHERE `email` = $email') == FALSE) {
		echo 'E-mail <b>'.$email.'</b> jest już w użyciu';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($nazwisko) < 3) || (strlen($nazwisko) > 30) == TRUE) {
		echo 'Pole <b>nazwisko</b> powinno zawierać od 3 do 30 znaków.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($imie) < 2) || (strlen($imie) > 20) == TRUE) {
		echo 'Pole <b>imię</b> powinno zawierać od 2 do 20 znaków.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($login) < 2) || (strlen($login) > 20) == TRUE) {
		echo 'Pole <b>login</b> powinno zawierać od 2 do 20 znaków.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($haslo) >= 8) == FALSE) {
		echo 'Pole <b>hasło</b> powinno zawierać conajmniej 8 znaków.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((filter_var($email, FILTER_VALIDATE_EMAIL)) == FALSE) {
		echo 'Pole <b>E-mail</b> znak ciąg znaków alfanumerycznych, znak @ oraz domenę. Sprawdź poprawność wpisanego adresu: '.$email;
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($ulica) < 2) || (strlen($ulica) > 20) == TRUE) {
		echo 'Pole <b>ulica</b> powinno zawierać od 2 do 20 znaków.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($budynek) < 2) || (strlen($budynek) > 7) == TRUE) {
		echo 'Pole <b>nr budynku</b> powinno zawierać od 2 do 7 znaków.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((strlen($miejscowosc) < 3) || (strlen($miejscowosc) > 20) == TRUE) {
		echo 'Pole <b>miejscowość</b> powinno zawierać od 3 do 20 znaków.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif ((ereg('^[0-9]{2,2}-[0-9]{3,3}$', $kod)) == FALSE) {
		echo 'Pole <b>kod pocztowy</b> powinno być zapisane wg wzoru XX-XXX.';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} elseif (isset($_POST['zainteresowania']) == FALSE) {
		echo 'Zaznacz przynajmniej jedno pole w kategorii <b>Zainteresowania</b>';
		echo '<br><br><form action="./rejestracja.php"><input type="submit" value="Powrót"></form>';
	} else {
		try {
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//Zamiana tablicy checkboksów z pola Zainteresowania na string
			$zainteresowania2 = implode(', ', $_POST['zainteresowania']);

			//Zapisanie zmiennych do bazy				
		 	$ilosc = $pdo -> exec('INSERT INTO `users` (`nazwisko`, `imie`, `login`, `haslo`, `email`, `ulica`, `budynek`, `mieszkanie`, `miejscowosc`, `kod`, `wyksztalcenie`, `zainteresowania`) VALUES 
		 		(\''.$nazwisko.'\',
		 		\''.$imie.'\',
		 		\''.$login.'\',
		 		\''.$haslo.'\',
		 		\''.$email.'\',
		 		\''.$ulica.'\',
		 		\''.$budynek.'\',
		 		\''.$mieszkanie.'\',
		 		\''.$miejscowosc.'\',
		 		\''.$kod.'\',
		 		\''.$wyksztalcenie.'\',
		 		\''.$zainteresowania2.'\')');
					
		 	if ($ilosc > 0) {
		 		$db = $pdo->query("SELECT * FROM users WHERE login='".$login."'");
		 		echo 'Pomyślnie zarejestrowano użytkownika!<br><br>';
		 		echo '<table border="1">';
					echo '<tr>';
						echo '<th>Nazwisko</th>';
						echo '<th>Imię</th>';
						echo '<th>Login</th>';
						echo '<th style="color: red;">Hasło</th>';
						echo '<th>E-mail</th>';
						echo '<th>Ulica</th>';
						echo '<th>Nr budynku</th>';
						echo '<th>Nr mieszkania<br>(jeśli jest)</th>';
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
		 	} else {
		 		echo 'Oops! Wystąpił błąd podczas rejestracji użytkownika.';
		 	}
		}
		catch(PDOException $e) {
		 	echo 'Wystapił blad biblioteki PDO: ' . $e->getMessage();
		}
	}
?>