<?php
session_start();
include ('baza.php');

$login = $_POST['login'];
$haslo = $_POST['haslo'];

//var_dump($login);
//var_dump($haslo);
//exit();
			
if(isset($_POST['zaloguj'])){
	if(!empty($login) && !empty($haslo)){
		$sprawdz = $pdo->prepare("SELECT * FROM users WHERE login = ?");
		try {
			$sprawdz->bindValue(1, $_POST['login']);
			$sprawdz->execute();
			if($sprawdz->rowCount() > 0) {
				$dana = $sprawdz->fetch(PDO::FETCH_ASSOC);
				if($dana['haslo'] === $haslo){
					$_SESSION['login'] = $dana['login'];
					header('Location: sklep.php');
				} else {
					echo "Hasło niepoprawne";
				}
			} else {
				echo "Nie ma takiego użytkownika";
			}
		} catch (PDOExeption $e){
			$e->getMessage();
		}
	} else {
		echo "Wprowadź login i hasło";
	}
}
?>