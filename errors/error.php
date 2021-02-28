 <!DOCTYPE html>
<html lang="de">
 <head>
  <meta charset="UTF-8">
  <title>Fehlermeldung</title>

 <style>
 p.fehler {
  background-color: #FFFFDF;
  padding: 15px;
 }
 </style>

 </head>
<body>

<?php
if (isset($_GET["error"])) {

 // Individuelle Fehlerausgabe
 switch ($_GET["error"]) {

  case "400":
   $meldung = 'Die Anfrage konnte so nicht verstanden werden!';
   break;

  case "401":
   $meldung = 'Sie haben keine Berechtigung, diesen Zugriff auszuführen! Es wurde ein verbotener Zugriff auf dem Webserver ausgeführt.';
   break;

  case "403":
   $meldung = 'Verbotene Anfrage! Es wurde eine Verbotene Anfrage an den Webserver gesendet.';
   break;

  case "500":
   $meldung = 'Interner Fehler am Webserver! Es ist ein Interner Fehler am Webserver aufgetreten.';
   break;

  case "503":
   $meldung = 'Der Webserver ist zur Zeit überlastet! Der Webserver hat wegen Überlastung den Dienst (zeitweise) eingestellt!';
   break;

  default:
  $meldung = 'Fehler am Webserver! Es ist ein Fehler am Webserver aufgetreten.';
 }

 // Ausgabe
 echo '<p id="fehler">' . $meldung . '. &mdash; Wir bitten um Entschuldigung!<br>';
 echo '<a href="javascript:history.back();">Zurück zur vorherigen Seite</a> - ';
 echo '<a href="../index.php">Zur Startseite</a></p>';
}
?>
</body>
</html> 