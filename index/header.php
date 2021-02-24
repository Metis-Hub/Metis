<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php
			if($_SESSION["cookies"]["visual_mode_cookie"] == "bright"){
				echo '<link rel="stylesheet" href="style.css" />';
			}
			elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark") {
				echo '<link rel="stylesheet" href="style_dark.css" />';
			}
		?>
		<link rel="icon" href="../image/faviconMetis.ico" type="image/x-icon" />
		<title>Metis</title>
	</head>

	<body>
		<header>
			<nav>
				<a class="active">Home</a>
				<a href="about/">About</a>
				<a href="contact/">Impressum</a>
				<div class="login-container">
					<form method="POST" action="../includes/login/login.inc.php">
						<input type="text" placeholder="Email" name="email" />
						<input type="password" placeholder="Passwort" name="pwd" />
						<button type="submit" name="login">Anmelden</button>
					</form>
				</div>
			</nav>
		</header>