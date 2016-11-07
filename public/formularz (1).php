<!doctype html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Formularz</title>
</head>
<body>
	<?php
		//@polaczenie = new connection
		
		@$uzytkownicy[0] = $id;
		@$uzytkownicy[1] = $_POST["imie"];
		@$uzytkownicy[2] = $_POST["nazwisko"];
		@$uzytkownicy[3] = $_POST["haslo"];
		@$uzytkownicy[4] = $_POST["plec"];
		@$uzytkownicy[5] = $_POST["opis"];
				
		//Walidacja
		/* if(is_numeric($_POST["cena"])){
			echo "Cena jest wartością numeryczną"
		}else{
			echo "Cena nie jest wartością numeryczną"
		} 
		$imie = strlen($_POST["kod"]);
		if($kod == 3){
			echo "kod ma prawidłową długość";
		}
		*/
		
		
		//Moduł wyświetlania
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		echo "Nazwisko: ".$_POST["nazwisko"]."<br>";
		echo "Imię: ".$_POST["imie"];
	?>
</body>
