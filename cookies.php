<!DOCTYPE html>
<html>
<head>
<?php

session_start();

function ErrorMsg($text) {

	echo "\n<script type=\"text/javascript\" language=\"Javascript\">\n
	alert(\"Error in cookies.php:\\n" . $text . "\");\n
	</script>\n";

	return;
}

function GetSettings($name) {
	if(isset($_COOKIE[$name])) {
		$_SESSION[$name] = $_COOKIE[$name];
		return $_COOKIE[$name];
	}
	else {
		ErrorMsg("Cookie \"" . $name . "\" exsistiert nicht!");
	}
}

function SetLongCookie($name, $traid) {
	setcookie($name, $traid, time() * 100);
}

if(isset($_SESSION["caller"])) {

	$caller = $_SESSION["caller"];

	if(isset($_SESSION["type"])) {

		$type = $_SESSION["type"];

		if(($type == "cookies" && isset($_COOKIE["cookies"])) || $type == "set_cookies") {
			SetLongCookie("cookies", true);
			$_SESSION["cookies_set"] = true;
			if(isset($_SESSION["first"]) && $_SESSION["first"] = true) {
				$_SESSION["visual_mode"] = "bright";
				$_COOKIE["visual_mode"] = "bright";
			}
		}
		elseif($type == "all") {

			if(isset($_COOKIE["cookies"])) {
				$_SESSION["cookies_set"] = true;
				$_SESSION["visual_mode"] = $_COOKIE["visual_mode"];
			}
			else {
				$_SESSION["cookies_set"] = false;
			}
		}
		else {
			$_SESSION["cookies_set"] = false;
		}

		$_SESSION["called"] = true;

	}
	else {
		ErrorMsg("\$_SESSION[\\\"type\\\"] is not set!");
	}

	header("Location: " . $caller);
}
else {
	ErrorMsg("\$_SESSION[\\\"caller\\\"] is not set!");
}

?>
</head>
<body>
	<p>
		Fehler!
	</p>
</body>
</html>