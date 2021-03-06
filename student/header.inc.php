<?php

include "../../includes/set_link.php";
include "../../includes/std_session.php";
include "../../includes/user.php";

// Datum
date_default_timezone_set("Europe/Berlin");

global $date;
$date = array(
"wochentag" => array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"),
	"monat" => array(1=>"Januar",2=>"Februar",3=>"M&auml;rz",4=>"April",5=>"Mai",6=>"Juni",7=>"Juli",8=>"August",
					 9=>"September",10=>"Oktober",11=>"November",12=>"Dezember")
);

// Datum ende
?>
<!DOCTYPE html>
<html lang="de">
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		if(!isLoggedIn() || $_SESSION["user"]["usertype"] != "student") header("Location: ./../../index/index.php?error=you_not_logged_in");
		elseif(max_time()) header("Location: ./../../index/index.php?error=max_inactive_time");
		if (!isset($_SESSION["cookies"]["allow_set_cookies"]) || $_SESSION["cookies"]["allow_set_cookies"] == false) header("Location: ./../../../");
		if($_SESSION["cookies"]["visual_mode_cookie"] == "bright")
			echo "\n\t<!-- Heller Syle -->\n\t<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n\t\n";
		elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark")
			echo "\n\t<!-- Dunkler Style -->\n\t<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n\t\n";
	?>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
	<title>Metis - <?php switch($position){case 0: echo"Home"; break; case 1: echo "Notendurchschnitte"; break; case 2: echo "Aufgabenplaner"; break; case 3: echo "Meine Klasse"; break;
		case 4: echo "Lernen"; break; case 5: echo "Einstellungen"; break;}?></title>

</head>


<body onload="UpdateTime()">
	
	<header>

		<!-- Kopfzeile -->
		<nav>

			<!-- Home -->
			<div><a <?php echo"class=\"".(($position==0)?" active":"\"href=\"./../home/")."\"";?>>Home</a></div>
			
			<!-- Noten -->
			<div><a <?php echo"class=\"".(($position==1)?" active":"\"href=\"./../grades/")."\"";?>>Noten</a></div>
			
			<!-- Aufgabenplaner -->
			<div><a <?php echo"class=\"".(($position==2)?" active":"\"href=\"./../tasks/")."\"";?>>Aufgabenplaner</a></div>
			
			<!-- Lernen -->
			<div><a <?php echo"class=\"".(($position==4)?" active":"\"href=\"./../learn/")."\"";?>>Lernen</a></div>
			
			<!-- Einstellungen -->
			<div><a <?php echo"class=\"".(($position==5)?" active":"\"href=\"./../settings/")."\"";?>>Einstellungen</a></div>
			
			<!-- Abmelden -->
			<div><a id="SignOut" href="./../../forms/logout.php">Abmelden</a></div>

		</nav>

