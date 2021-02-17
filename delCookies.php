<!Das ist temporaer um die Cookies dieser Web-Site zu löschen.>
<?php
session_start();
session_destroy();
setcookie("visual_mode", "bright", 1);
setcookie("visual_mode", "dark", 1);
setcookie("cookies", 1, 1);
setcookie("cookies", "true", 1);
setcookie("visual_mode", 0, 1);
setcookie("visual_mode", "false", 1);
?>
<html>
<head>
	<title>Cookies gel&ouml;scht!</title>
</head>
<body>
	<p><h1>Cookies wurden gel&ouml;scht!</h1></p>
	<p>
		<b>Wohin jetzt?</b>
		<ul>
			<li><a href="./../">localhost/index.php</a></li>
			<li><a href="./registered/home/">Home</a></li>
			<li><a href="./index/">index/</a></li>
		</ul>
	</p>
</body>
</html>