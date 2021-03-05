<!Das ist temporaer um die Cookies dieser Web-Site zu löschen.>
<html>
<head>
<?php
session_start();
if(!isset($_SESSION["cookies"]["allow_set_cookies"]) || $_SESSION["cookies"]["allow_set_cookies"] == false) {
	session_destroy();
}
else {
	session_destroy();
	session_start();
	$_SESSION["cookie_request_del"] = true;
	$_SESSION["cookie_caller"] = "./tmpDelCookies.php";
	header("location: ./cookies.php");
}
?>
	<title>Cookies gel&ouml;scht!</title>
</head>
<body>
	<p><h1>Cookies wurden gel&ouml;scht!</h1></p>
	<p>
		<b>Wohin jetzt?</b>
		<ul>
			<li><a href="./../Metis/">localhost/index.php</a></li>
			<li><a href="./student/home/">Home</a></li>
			<li><a href="./index/">index/</a></li>
		</ul>
	</p>
</body>
</html>