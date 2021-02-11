<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="./../mainStyle.css" />
		<link rel="icon" href="./../faviconMetis.ico" type="image/x-icon" />
		<title>Metis</title>
	</head>
	<body>
		<header>
		<nav>

			<?php

			if($position == 0) {
			echo
			'
			<a class="active" href="./../home">Home</a>
			<a href="./../class">Meine Klasse</a>
			<a href="./../class">Einstellungen</a>
			';
			}
			else if($position == 1) {
			echo
			'
			<a href="./../home">Home</a>
			<a class="active"  href="">Meine Klasse</a>
			<a href="">Einstellungen</a>
			';
			}

			echo
			'
			<a id="SignOut" href="./../index.php">Abmelden</a>
			</div>
			';

			?>
		</nav>