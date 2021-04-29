<?php unset($_SESSION["user"]); ?><!DOCTYPE html>
<?php
include "../includes/Random.php";
Rand::SetSeed(time());
$_SESSION["safe_passwort_seed"] = Rand::Next();
?>
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
					echo "alert(unescape(\"Sie sind nicht abgemeldet!\"));\n";
					break;
					case "no_account_found":
					echo "alert(unescape(\"Das Passwort oder der Benutztername oder beides ist ung%FCltig!\\nSolltest du dein Passwort vergessen haben,"
						 . "\\ninformiere bitte deinen Lehrer, damit dieser es zur%FCcksetzt.\"));\n";
					break;
					case "fields_are_empty":
					echo "alert(unescape(\"Sie sollten auch die Felder ausf%FCllen.\"));\n";
					break;
					case "email_field_is_empty":
					echo "alert(unescape(\"Sie haben keine E-Mail eingegeben.\"));\n";
					break;
					case "password_field_is_empty":
					echo "alert(unescape(\"Sie haben kein Passwort eingegeben.\"));\n";
					break;
					case "to_much_wrong_logins":
					echo "alert(\"Sie haben zu viel falsche Daten gesendet!\");\n";
					break;
					case "invalid_email":
					echo "alert(unescape(\"Email ist ungl%FCltig!\"));\n";
					break;
				}
				if(!$_GET["error"] != "to_much_wrong_logins") {
					echo "window.location.href = \"./../index/\"";
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
					<button name="login" onclick="hash('<?php echo $_SESSION["safe_passwort_seed"]; ?>')">Anmelden</button>
					<form id="password" method="POST" action="../includes/login/login.inc.php">
						<input type="hidden" name="pw" id="pw" value="" />
						<input type="hidden" name="email" id="Email" value="" />
					</form>
				</div>
			</nav>
		</header>
