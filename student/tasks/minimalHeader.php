<?php
include "../../includes/set_link.php";
include "../../includes/std_session.php";
include "../../includes/user.php";

// Datum
date_default_timezone_set("Europe/Berlin");
?>

<!DOCTYPE html>
<html lang="de">
<head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		if(!isLoggedIn()) {
			header("Location: ./../../index/index.php?error=you_not_logged_in");
		}
		if (!isset($_SESSION["cookies"]["allow_set_cookies"]) || $_SESSION["cookies"]["allow_set_cookies"] == false)
			header("Location: ./../../../");
		if($_SESSION["cookies"]["visual_mode_cookie"] == "bright")
			echo "\n\t<!-- Heller Syle -->\n\t<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n\t\n";
		elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark")
			echo "\n\t<!-- Dunkler Style -->\n\t<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n\t\n";
	?>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
	<title>Metis<?php if(isset($title)) {echo " - ".$title;}?></title>

</head>
<body onLoad=UpdateTime()>