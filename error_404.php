<?php

session_start();
if(!isset($_SESSION["error_404"])) {
	$_SESSION["error_404"] = true;
	header("loaction: localhost/Metis/error_404.php");
}
else {
	unset($_SESSION["error_404"]);
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Seite exsistiert nicht!</title>
		<?php
			if($_SESSION["cookies"]["visual_mode_cookie"] == "bright") {	//Style wird nicht gewählt
				echo "<link rel=\"stylesheet\" href=\"index/style_dark.css\" />\n";
			}
			else {
				echo "<link rel=\"stylesheet\" href=\"index/style.css\" />\n";
			}
		?>
	</head>
	<body>
		
	</body>
</html>