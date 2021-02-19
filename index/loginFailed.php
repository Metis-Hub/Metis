<?php
session_start();
if(!isset($_SESSION["login_failed"]) || $_SESSION["login_failed"] == false) {
	header("Location: ./../index/");
}
else {
	$_SESSION["login_failed"] = false;
}
?>
<html>
<head>
	<title>Login Fehlgeschlagen!</title>
	<?php
		if($_SESSION["visual_mode"] == "bright"){
			echo '<link rel="stylesheet" href="style.css" />';
		}
		elseif ($_SESSION["visual_mode"] == "dark") {
			echo '<link rel="stylesheet" href="style_dark.css" />';
		}
	?>
	<link rel="icon" href="../faviconMetis.ico" type="image/x-icon" />
	<script type="text/JavaScript">
		alert(unescape("Das Passwort oder der Benutztername oder beides ist ung%FCltig!\nSolltest du dein Passwort vergessen haben, informiere bitte deinen Lehrer,\ndamit dieser es zur%FCcksetzt."));
		window.location = "./../index/";
	</script>
</head>
<body>
</body>
</html>