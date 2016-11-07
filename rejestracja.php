<?php
	session_start();
	if(isset($_POST['haslo'])){

	}
?>
<!doctype html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Rejestracja użytkownika</title>
	<style>	
		body {background-color: lightgrey;}
		form {width: 700px;}
		input[type="number"] {width: 75px;};
	</style>
</head>
<body>
<form method="POST" action="formularz.php">
	<fieldset>
		<legend><b>Formularz rejestracji nowego użytkownika</b></legend>
		<label>Nazwisko:</label> <input type="text" name="nazwisko" /><br>
		<label>Imię:</label> <input type="text" name="imie" /><br>
		<label>Login:</label> <input type="text" name="login" /><br>
		<label>Hasło:</label> <input type="password" name="haslo" /><br><br>
		<label>E-mail:</label> <input type="text" name="email" /><br><br>
		<label>Ulica:</label> <input type="text" name="ulica" /> &nbsp;<label>nr domu:</label> <input type="text" name="budynek" />  <label>nr mieszkania:</label> <input type="text" name="mieszkanie" /><br>
		<label>Miejscowość:</label> <input type="text" name="miejscowosc" /><br>
		<label>Kod pocztowy:</label> <input type="text" name="kod" /><br><br>
		Wykształcenie: <select name="wyksztalcenie">
			<option value="Podstawowe">Podstawowe</option>
			<option value="Średnie">Średnie</option>
			<option value="Wyższe">Wyższe</option>
		</select><br><br>
		<label>Zainteresowania:</label><br>
		<label><input type="checkbox" name="zainteresowania[]" value="Nauka" />Nauka</label><br />
		<label><input type="checkbox" name="zainteresowania[]" value="Sport" />Sport</label><br />
		<label><input type="checkbox" name="zainteresowania[]" value="Muzyka" />Muzyka</label><br />
		<label><input type="checkbox" name="zainteresowania[]" value="Taniec" />Taniec</label><br />
		<label><input type="checkbox" name="zainteresowania[]" value="Literatura" />Literatura</label>
		<br><br>	
		<input type="submit" value="Wyślij" />	<input type="reset" value="Wyczyść" />
	 </fieldset>
</form>
</body>