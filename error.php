 <!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Fehler!</title>
	<link rel="icon" href="./image/faviconMetis.ico" type="image/x-icon" />
	<?php	
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
	
	?>
</head>
<body hight="98%">
<?php

if(isset($_GET["error"])) {
 switch($_GET["error"]) {

  case "400":
   $meldung = 'Die Anfrage konnte so nicht verstanden werden!';
   break;

  case "401":
   $meldung = 'Sie haben keine Berechtigung, diesen Zugriff auszuf&uuml;hren! Es wurde ein verbotener Zugriff auf dem Webserver ausgef&uuml;hrt.';
   break;

  case "403":
   $meldung = 'Verbotene Anfrage! Es wurde eine Verbotene Anfrage an den Webserver gesendet.';
   break;

  case "500":
   $meldung = 'Interner Fehler am Webserver! Es ist ein Interner Fehler am Webserver aufgetreten.';
   break;

  case "503":
   $meldung = 'Der Webserver ist zur Zeit &uuml;berlastet! Der Webserver hat wegen &Uuml;berlastung den Dienst (zeitweise) eingestellt!';
   break;

  default:
  $meldung = 'Fehler am Webserver! Es ist ein Fehler am Webserver aufgetreten.';
 }

 // Ausgabe
 echo "<p id=\"fehler\">" . $meldung . " &mdash; Wir bitten um Entschuldigung!<br>";
 echo "<a href=\"javascript:history.back();\">Zur&uuml;ck zur vorherigen Seite</a> - ";
 echo "<a href=\"../index.php\">Zur Startseite</a></p>";
}

?>
</body>
</html> 