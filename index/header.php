<!DOCTYPE html>
<html lang="de">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php
			if($_SESSION["cookies"]["visual_mode_cookie"] == "bright"){
				echo "<link rel=\"stylesheet\" href=\"style.css\" />\n";
			}
			elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark") {
				echo "<link rel=\"stylesheet\" href=\"style_dark.css\" />\n";
			}

			$wait = false;
			if(isset($_SESSION["to_much_wrong_logins"])) {
				unset($_SESSION["to_much_wrong_logins"]);
				$wait = true;
			}

			if(isset($_GET["error"])) {
				echo "<script type=\"text/JavaScript\">\n";

				switch($_GET["error"]) {
					case "you_not_logged_in":
					echo "alert(unescape(\"Sie sind nicht abgemeldet!\"));\n";
					break;
					case "no_account_found":
					echo "alert(unescape(\"Das Passwort oder der Benutztername oder beides ist ung%FCltig!\\nSolltest du dein Passwort vergessen haben,"
						 . "\\ninformiere bitte deinen Lehrer, damit dieser es zur%FCcksetzt.\"));\n";
					break;
					case "fields_are_empty":
					echo "alert(unescape(\"Sie sollten auch die Felder ausf%FCllen.\"));\n";
					break;
					case "email_field_are_empty":
					echo "alert(unescape(\"Sie haben keine E-Mail eingegeben.\"));\n";
					break;
					case "password_fields_are_empty":
					echo "alert(unescape(\"Sie haben kein Passwort eingegeben.\"));\n";
					break;
					case "to_much_wrong_logins":
					header("location: ./to_much_wrong_logins.html");
					break;
				}
				echo "window.location.href = \"./../index/\"";
				echo "</script>\n";
			}

			if($wait) {
				sleep(300);	// Wartet 3 min
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