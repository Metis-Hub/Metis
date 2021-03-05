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
		<?php
			if($_SESSION["cookies"]["visual_mode_cookie"] == "dark") {	//Style wird nicht gewählt
				echo "<link rel=\"stylesheet\" href=\"./index/style_dark.css\" />\n";
			}
			else {
				echo "<link rel=\"stylesheet\" href=\"./index/style.css\" />\n";
			}

			if(!isset($_SESSION["error_404"])) {
				$_SESSION["error_404"] = true;
				echo "\t\t\t<script type=\"text/JavaScript\">\n";
				echo "\t\t\t\twindow.onload = function () {\n";
				echo "\t\t\t\twindow.location.href = \"" . $link . "\"\n";
				echo "\t\t\t}\n";
				echo "\t\t</script>\n";
			}
			else {
				unset($_SESSION["error_404"]);
				echo $_SERVER['PHP_SELF'];
				echo $_SERVER['HTTP_REFERER'];
			}
		?>
	</head>
	<body>
		
	</body>
</html>