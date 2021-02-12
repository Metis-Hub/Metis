<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" href="../faviconMetis.ico" type="image/x-icon" />
		<title>Metis</title>

		<script type="text/javascript">
			alert("Diese Web-Site verwendet Cookies.\nBitte stimmen Sie zu, um unsere Web-Site zu verwenden.");
		</script>

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