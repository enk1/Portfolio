<?php
	ob_start();
	session_start();
	include('baza.php');

	$wiadomosc = '
		<html> 
   		<head> 
      		<title>Zamówienie od '.$_SESSION['nadawca'].'</title> 
   		</head>
   		<body>
      		<b>Zamówienie</b>:<br>
      		'.$_SESSION['wiadomosc'].'
      		<br><br>Adres zamówienia:<br>
      		'.$_SESSION['adres_dostawy_0'].'<br>
      		'.$_SESSION['adres_dostawy_1'].'<br>
      		'.$_SESSION['adres_dostawy_2'].'<br>
   		</body>
   		</html>
	';
	if(mail('grzywaczewski.jakub@gmail.com', 'Zamówienie', $wiadomosc)){
		echo 'Wiadomość została wysłana';
	}
?>