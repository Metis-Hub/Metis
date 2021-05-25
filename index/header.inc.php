<?php unset($_SESSION["user"]);
include "../includes/Random.php";

Rand::SetSeed(time());
$_SESSION["safe_password_seed"] = Rand::Next();

?><!DOCTYPE html>
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

			if(isset($_SESSION["to_much_wrong_logins"])) {
				unset($_SESSION["to_much_wrong_logins"]);
				$_SESSION["wait"] = true;
				$_GET["error"] = "to_much_wrong_logins";
			}

			if(isset($_GET["error"])) {
				echo "<script type=\"text/JavaScript\">\n";

				switch($_GET["error"]) {
					case "you_not_logged_in":
					echo "alert(unescape(\"Sie sind nicht angemeldet!\"));\n"; sleep(1);
					break;
					case "no_account_found":
					echo "alert(unescape(\"Das Passwort, der Benutztername oder beides ist ung%FCltig!\\nSollten Sie Ihr Passwort vergessen haben, so "
						 . "informieren Sie bitte den Administrator, damit dieser es zur%FCcksetzt.\"));\n"; sleep(1);
					break;
					case "fields_are_empty":
					echo "alert(unescape(\"Sie sollten auch die Felder ausf%FCllen.\"));\n"; // sleep(1), sind wir mal nett ;-)
					break;
					case "email_field_is_empty":
					echo "alert(unescape(\"Sie haben keine E-Mail eingegeben.\"));\n"; sleep(1);
					break;
					case "password_field_is_empty":
					echo "alert(unescape(\"Sie haben kein Passwort eingegeben.\"));\n"; sleep(1);
					break;
					case "to_much_wrong_logins":
					echo "alert(\"Sie haben zu viel falsche Daten gesendet!\");\n"; sleep(1);
					echo "window.location.href = \"./../index/\"\n";
					break;
					case "invalid_email":
					echo "alert(unescape(\"Email ist ungl%FCltig!\"));\n"; sleep(1);
					break;
					default:
					echo "alert(\"Der Code wurde manipuliert!\");\n";
				}
				echo "</script>\n";
			}

		?>
		<link rel="icon" href="../image/faviconMetis.ico" type="image/x-icon" />
		<script language="JavaScript" type="text/JavaScript" src="../includes/link98346.js"></script>
		<title>Metis</title>
	</head>

	<body>
		<header>
			<nav>
				<a class="active">Home</a>
				<a href="about/">About</a>
				<a href="contact/">Impressum</a>
				<div class="login-container">
					<input type="text" placeholder="Email" name="email" id="email" />
					<input type="password" placeholder="Passwort" name="pwd" id="pwd" />
					<button name="login" onclick="hash('<?php echo $_SESSION["safe_password_seed"]; ?>', 'index.php', false)">Anmelden</button>
					<form id="password" method="POST" action="./../forms/login.php">
						<input type="hidden" name="pw" id="pw" value="" />
						<input type="hidden" name="email" id="Email" value="" />
					</form>
				</div>
			</nav>
		</header>
