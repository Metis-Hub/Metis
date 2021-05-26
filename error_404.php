<?php
session_start();
$link = "http://" . $_SERVER["HTTP_HOST"] . "/Metis/error_404.php";
# Ersetzten Sie den Link /\
# durch http://www.IhreDomain.de/Pfad_Zu_Metis/Metis/error_404.php
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Seite exsistiert nicht!</title>
	</head>
	<body>
		
	</body>
</html>