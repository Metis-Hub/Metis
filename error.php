 <!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Fehler!</title>
	<link rel="icon" href="./image/faviconMetis.ico" type="image/x-icon" />
	<?php
	$msg = "Fehler am Webserver! Es ist ein Fehler am Webserver aufgetreten.";
	session_start();
	if(isset($_SESSION["cookies"]["visual_mode_cookie"]) && $_SESSION["cookies"]["visual_mode_cookie"] == "dark") {
		echo "<link rel=\"stylesheet\" href=\"./index/style_dark.css\" />\n";
	}
	else {
		echo "<link rel=\"stylesheet\" href=\"./index/style.css\" />\n";
	}
	
	if(!isset($_GET["error"])) {
		echo "<script type=\"text/JavaScript\">window.history.back();</script>\n";
	}
	else {
		switch($_GET["error"]) {
			case "400":
			$msg = "Die Anfrage konnte so nicht verstanden werden%21";
			break;

			case "401":
			$msg = "Sie haben keine Berechtigung%2C diesen Zugriff auszuf%FChren%21 Es wurde ein verbotener Zugriff auf dem Webserver ausgef%FChrt.";
			break;

			case "403":
			$msg = "Verbotene Anfrage%21 Es wurde eine Verbotene Anfrage an den Webserver gesendet.";
			break;

			case "500":
			$msg = "Interner Fehler am Webserver%21 Es ist ein Interner Fehler am Webserver aufgetreten.";
			break;

			case "503":
			$msg = "Der Webserver ist zur Zeit %FCberlastet%21 Der Webserver hat wegen %DCberlastung den Dienst %28zeitweise%29 eingestellt%21";
			break;
		}
		$msg2 = "%0A%0AWollen Sie zur%FCck zur Urspr%FCnglichen Seite%3F";
		echo "\n\t<script type=\"text/JavaScript\">\n";
		echo "\t\tvar msg = unescape(\"" . $msg . "\");\n";
		echo "\t\tvar back = confirm(msg + unescape(\"" . $msg2 . "\"));\n";
		echo "\t\tif(back) {\n";
		echo "\t\t\twindow.history.back();\n";
		echo "\t\t}\n";
		echo "\t\twindow.onload = function() {\n";
		echo "\t\t\tdocument.getElementById(\"error\").innerHTML = msg + \" - Wir bitten um Entschuldigung.\";\n";
		echo "\t\t}\n";
		echo "\t</script>\n";
	}
	
	?>
</head>
<body hight="98%">
<?php

if(isset($_GET["error"])) {
	// Ausgabe
	echo "<p id=\"error\"></p>";
	echo "<a href=\"javascript:history.back();\">Zur&uuml;ck zur vorherigen Seite</a> - ";
	echo "<a href=\"../index.php\">Zur Startseite</a>";
}

?>
</body>
</html> 