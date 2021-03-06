<?php 
include "../../includes/set_link.php";
include "../../includes/std_session.php";
include "../../includes/user.php";
 ?><!DOCTYPE html>
<html lang="de">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		if(!isLoggedIn()|| $_SESSION["user"]["usertype"] != "teacher") header("Location: ./../../index/index.php?error=you_not_logged_in");
		elseif(max_time()) header("Location: ./../../index/index.php?error=max_inactive_time");
		if (!isset($_SESSION["cookies"]["allow_set_cookies"]) || $_SESSION["cookies"]["allow_set_cookies"] == false) header("Location: ./../../../");
		if($_SESSION["cookies"]["visual_mode_cookie"] == "bright")
			echo "<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
		elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark")
			echo "<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
	?>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
	<title>
		Metis - <?php switch($position){case 0: echo"Home";break;case 1: echo"Aufgaben";break;case 2: echo"Klassen";break;
		case 3: echo"Lernen";break;case 4: echo"Einstellungen";break;}?>
	</title>
</head>

<body>
	
	<header>
		<nav>
			<div><a <?php echo(($position == 0)?"class=\"active\"": "href=\"./../home\"")?>>Home</a></div>
			<div><a <?php echo(($position == 1)?"class=\"active\"": "href=\"./../tasks\"")?>>Aufgaben</a></div>
			<div><a <?php echo(($position == 3)?"class=\"active\"": "href=\"./../learn\"")?>>Lernen</a></div>
			<div><a <?php echo(($position == 4)?"class=\"active\"": "href=\"./../settings\"")?>>Einstellungen</a></div>
			<?php if(!empty($_SESSION["user"]["seeAdmin"])) { echo "<div><a class=left href=./../../admin/index> Admin </a> </div>"; }?>
			
			<div><a id="SignOut" href="./../../forms/logout.php">Abmelden</a></div>
		</nav>
	</header>

