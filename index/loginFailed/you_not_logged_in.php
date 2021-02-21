<?php
session_start();
?>
<html>
<head>
	<title>Nicht Angemeldet!</title>
	<?php
		if($_SESSION["visual_mode"] == "bright"){
			echo '<link rel="stylesheet" href="../style.css" />';
		}
		elseif ($_SESSION["visual_mode"] == "dark") {
			echo '<link rel="stylesheet" href="../style_dark.css" />';
		}
	?>
	<link rel="icon" href="../image/faviconMetis.ico" type="image/x-icon" />
	<script type="text/JavaScript">
		alert(unescape("Sie sind nicht abgemeldet!"));
		window.location = "./../../index/";
	</script>
</head>
<body>
</body>
</html>