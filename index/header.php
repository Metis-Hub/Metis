<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" href="../faviconMetis.ico" type="image/x-icon" />
		<title>Metis</title>
		<?php
			// Wenn keine Cookies gesetzt wurden, bzw. nicht zugestimmt wurde wird zu JavaScript-Meldung weitergeleitet.
			if (!isset($_COOKIE["cookie"]))
			header('Location: ./../index.php');
			else
			// Da die JavaScript-Meldung nur Tempräre Cookies setzt wird dies Cookie verlängert, sodass
			// keine weitere Frage nach Cookies in nächster Zeit auftaucht
			setcookie("cookie", "true", time() * 100);
		?>

	</head>
	<body>
		<header>
		<nav>
			<a class="active" href="#home">Home</a>
			<a href="about">About</a>
			<a href="contact">Impressum</a>
			<div class="login-container">
				<form method="POST" action="../login/signin.php">
					<input type="text" placeholder="Benutztername" name="username" />
					<input type="password" placeholder="Passwort" name="psw" />
					<button type="submit" name="login">Anmelden</button>
				</form>
			</div>
		</nav>