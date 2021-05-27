<?php
$path = $_SERVER["HTTP_HOST"] . substr($_SERVER['PHP_SELF'], 0, strlen($_SERVER['PHP_SELF']) - 13);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> Seite exsistiert nicht! </title>
		<link rel="stylesheet" href="<?php echo $path . "student/mainStyle.css"; ?>" />
	</head>
	<body>
		<h1> Seite wurde nicht gefunden! </h1>
		<p> Entschuldigung, aber die Seite &quot;<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>&quot; exsitiert leider nicht, oder nicht mehr! </p>
		<button onclick="location.href='<?php echo $path;?>';">Hauptseite / Startseite</button>
		<button onclick="location.href='################# TODO ####################';">zur&uuml;ck / letzte Seite</button>
	</body>
</html>