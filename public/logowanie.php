<?php
	session_start();
?>
<!doctype html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Wysokość trójkąta, równoległoboku i trapezu</title>
</head>
<body>
	<?php
		$_SESSION["imie"] = "Jan";
		$_SESSION["nazwisko"] = "Kowalski";
		
		session_destroy();
	?>
</body>