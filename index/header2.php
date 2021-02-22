<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php
			session_start();
			if ($_SESSION["cookies_set"] == false) {
				header("Location: ./../../");
			}
			if($_SESSION["visual_mode"] == "bright"){
				echo '<link rel="stylesheet" href="./../style.css" />';
			}
			elseif ($_SESSION["visual_mode"] == "dark") {
				echo '<link rel="stylesheet" href="./../style_dark.css" />';
			}
		?>
		<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
		<title><?php echo(($position == 1)?"&Uumlber uns - Metis":"Metis - Impressum")?></title>
	</head>

	<body>
		<header>
			<nav>
				<a href="./../../index/">Home</a>
				<a <?php echo(($position == 1)?"class=\"active\"":"href=\"./../about/\"");?>>About</a>
				<a <?php echo(($position == 2)?"class=\"active\"":"href=\"./../contact/\"");?>>Impressum</a>
			</nav>
		</header>