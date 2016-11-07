<!doctype html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Rejestracja</title>
</head>
<body>

<form method="POST" action="formularz.php">
	<label>Nazwisko:</label> <input type="text" name="nazwisko" /><br>
	<label>Imię:</label> <input type="text" name="imie" /><br>
	<label>Login:</label> <input type="text" name="login" /><br>
	<label>Hasło:</label> <input type="password" name="haslo" /><br>
	<label>Ulica i nr domu/mieszkania:</label> <input type="text" name="adres1a" /> &nbsp; <input type="number" name="adres1b" /><br>
	<label>Miejscowość:</label> <input type="text" name="adres3" /><label>Kod pocztowy:</label> <input type="text" name="adres2a" />-<input type="text" name="adres2b" /><br>
	Wykształcenie: <select name="wyksztalcenie">
		<option value="1">Podstawowe</option>
		<option value="2">Średnie</option>
		<option value="3">Wyższe</option>
	</select><br>
	<label>Zainteresowania:</label>
	
		
	<input type="submit" value="Wyślij" />	<input type="reset" value="Wyczyść" /><br>
</form>
</body>