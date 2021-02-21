<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		session_start();
		include("./../../login/user.php");
		if(!isLoggedIn()) {
			header("Location: ./../../index/loginFailed/you_not_logged_in.php");
		}
		if ($_SESSION["cookies_set"] == false)
			header("Location: ./../../../");
		if($_SESSION["visual_mode"] == "bright")
			echo "<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
		elseif($_SESSION["visual_mode"] == "dark")
			echo "<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
	?>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
	<title>Metis - Einstellungen</title>
</head>

<body>

	<header>

		<nav>
		<?php

		if($position == 0) {
			echo"
			<div><a class=\"active\">Home</a></div>\n
			<div><a href=\"./../tasks\">Aufgabenplaner</a></div>\n
			<div><a href=\"./../class\">Meine Klasse</a></div>\n
			<div><a href=\"./../learn\">Lernen</a></div>\n
			<div><a href=\"./../settings/\">Einstellungen</a></div>\n";
		}
		elseif($position == 1) {
			echo"
			<div><a href=\"./../home\">Home</a></div>\n
			<div><a class=\"active\">Aufgabenplaner</a></div>\n
			<div><a href=\"./../class\">Meine Klasse</a></div>\n
			<div><a href=\"./../learn\">Lernen</a></div>\n
			<div><a href=\"./../settings/\">Einstellungen</a></div>\n";
		}
		elseif ($position == 2) {
			echo"
			<div><a href=\"./../home\">Home</a></div>\n
			<div><a href=\"./../tasks\">Aufgabenplaner</a></div>\n
			<div><a class=\"active\">Meine Klasse</a></div>\n
			<div><a href=\"./../learn\">Lernen</a></div>\n
			<div><a href=\"./../settings/\">Einstellungen</a></div>\n";
		}
		elseif($position == 3) {
			echo"
			<div><a href=\"./../home\">Home</a></div>\n
			<div><a href=\"./../tasks\">Aufgabenplaner</a></div>\n
			<div><a href=\"./../class\">Meine Klasse</a></div>\n
			<div><a class=\"active\">Lernen</a></div>\n
			<div><a href=\"./../settings/\">Einstellungen</a></div>\n";
		}
		elseif ($position == 4) {
			echo"
			<div><a href=\"./../home\">Home</a></div>\n
			<div><a href=\"./../tasks\">Aufgabenplaner</a></div>\n
			<div><a href=\"./../class\">Meine Klasse</a></div>\n
			<div><a href=\"./../learn\">Lernen</a></div>\n
			<div><a class=\"active\">Einstellungen</a></div>\n";
		}

		echo"
			<div><a id=\"SignOut\" href=\"./../SignOut.php\">Abmelden</a></div>\n";
		?>

		</nav>

	</header>

