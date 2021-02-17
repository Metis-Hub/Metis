<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php
			session_start();
			if ($_SESSION["cookies_set"] == false)
				header("Location: ./../../../");
			if($_SESSION["visual_mode"] == "bright")
				echo "<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
			elseif($_SESSION["visual_mode"] == "dark")
				echo "<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
		?>
		<link rel="icon" href="./../../faviconMetis.ico" type="image/x-icon" />
		<title>Metis</title>
	</head>
	<body>
		<header>
		<nav>

			<?php

			if($position == 0) {
				echo
				'
				<div><a class="active">Home</a></div>
				<div><a href="./../tasks">Aufgabenplaner</a></div>
				<div><a href="./../class">Meine Klasse</a></div>
				<div><a href="./../learn">Lernen</a></div>
				<div><a href="./../settings/index.php">Einstellungen</a></div>
				';
			}
			elseif($position == 1) {
				echo
				'
				<div><a href="./../home">Home</a></div>
				<div><a class="active">Aufgabenplaner</a></div>
				<div><a href="./../class">Meine Klasse</a></div>
				<div><a href="./../learn">Lernen</a></div>
				<div><a href="./../settings/index.php">Einstellungen</a></div>
				';
			}
			elseif ($position == 2) {
				echo
				'
				<div><a href="./../home">Home</a></div>
				<div><a href="./../tasks">Aufgabenplaner</a></div>
				<div><a class="active">Meine Klasse</a></div>
				<div><a href="./../learn">Lernen</a></div>
				<div><a href="./../settings/index.php">Einstellungen</a></div>
				';
			}
			elseif($position == 3) {
				echo
				'
				<div><a href="./../home">Home</a></div>
				<div><a href="./../tasks">Aufgabenplaner</a></div>
				<div><a href="./../class">Meine Klasse</a></div>
				<div><a class="active">Lernen</a></div>
				<div><a href="./../settings/index.php">Einstellungen</a></div>
				';
			}
			elseif ($position == 4) {
				echo
				'
				<div><a href="./../home">Home</a></div>
				<div><a href="./../tasks">Aufgabenplaner</a></div>
				<div><a href="./../class">Meine Klasse</a></div>
				<div><a href="./../learn">Lernen</a></div>
				<div><a class="active">Einstellungen</a></div>
				';
			}


			echo
			'
			<div><a id="SignOut" href="./../SignOut.php">Abmelden</a></div>
			</div>
			';

			?>
		</nav>