<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		if(session_status() != 2) {
			session_start();
		}
		include("./../../login/user.php");
		if(!isLoggedIn()) {
			header("Location: ./../../index/loginFailed/you_not_logged_in.php");
		}
		if (!isset($_SESSION["cookies"]["allow_set_cookies"]) || $_SESSION["cookies"]["allow_set_cookies"] == false)
			header("Location: ./../../../");
		if($_SESSION["cookies"]["visual_mode_cookie"] == "bright")
			echo "<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
		elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark")
			echo "<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
	?>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
	<title>
		Metis - <?php switch($position){case 0: echo"Home";break;case 1:echo"Notendurchschnitte";break;case 2: echo"Aufgabenplaner";break;case 3: echo"Meine Klasse";break;
		case 4: echo"Lernen";break;case 5: echo"Einstellungen";break;}?>
	</title>
</head>

<body>
	
	<header>
		<nav>
			<div><a <?php echo(($position == 0)?"class=\"active\"": "href=\"./../home\"")?>>Home</a></div>
			<div><a <?php echo(($position == 1)?"class=\"active\"": "href=\"./../grades\"")?>>Noten</a></div>
			<div><a <?php echo(($position == 2)?"class=\"active\"": "href=\"./../tasks\"")?>>Aufgabenplaner</a></div>
			<div><a <?php echo(($position == 3)?"class=\"active\"": "href=\"./../class\"")?>>Meine Klasse</a></div>
			<div><a <?php echo(($position == 4)?"class=\"active\"": "href=\"./../learn\"")?>>Lernen</a></div>
			<div><a <?php echo(($position == 5)?"class=\"active\"": "href=\"./../settings\"")?>>Einstellungen</a></div>
			<div><a id="SignOut" href="./../SignOut.php">Abmelden</a></div>
		</nav>
	</header>

