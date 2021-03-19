<!DOCTYPE html>
<html lang="de">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="./../style.css" />
		<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
		<title>Metis - Administration</title>
	</head>

	<body>
		<header>
			<nav>
			<?php
				echo "<a ".(($position == 0) ? 'class="active"' : 'href="../index/"').">Home</a>";
				echo "<a ".(($position == 1) ? 'class="active"' : 'href="../accounts/"').">Accounts</a>";
				echo "<a ".(($position == 2) ? 'class="active"' : 'href="../classes/"').">Klassen</a>";
				
				#ersetzen um zum lehrer zu führen
				echo "<a class = 'right' href = './../../index/'> Zur&uuml;ck </a>";
			?>
			</nav>
		</header>