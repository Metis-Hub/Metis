<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="../logoMetis (2).png" type="image/png">
		<title>Metis</title>
	</head>
	<body>
		<header>
		<nav>
			<a class="active" href="#home">Home</a>
			<a href="#about">About</a>
			<a href="#contact">Contact</a>
			<div class="login-container">
				<form action="">
					<input type="text" placeholder="Username" name="username"/>
					<input type="password" placeholder="Password" name="psw"/>
					<button type="button" onclick="window.location.href = '../login/signup.html';">Registrieren</button>
					<button type="submit" name="login">Login</button>
				</form>
			</div>
		</nav>