<?php include "../../includes/set_link.php"; include "../../includes/std_session.php"; unset($_SESSION["user"]); ?><!DOCTYPE html>
<html lang="de">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php
			if($_SESSION["cookies"]["allow_set_cookies"] == false) {
				header("Location: ./../../");
			}
			if($_SESSION["cookies"]["visual_mode_cookie"] == "bright"){
				echo '<link rel="stylesheet" href="./../style.css" />';
			}
			elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark") {
				echo '<link rel="stylesheet" href="./../style_dark.css" />';
			}
		?>
		<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
		<title>Metis - Impressum</title>
	</head>

	<body>
		<header>
			<nav>
				<a href="./../../index/">Home</a>
				<a class="active">Impressum</a>
			</nav>
		</header>