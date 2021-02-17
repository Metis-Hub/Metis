<!DOCTYPE html>
<html>
<head>
<?php

session_start();

function ErrorMsg($text) {

	echo "<script type=\"text/javascript\" language=\"Javascript\">alert(\"Error in cookies.php:\\n" . $text . "\");</script>";

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

	$caller = $_SESSION["caller"]; // = Path

	if(isset($_SESSION["type"])) {

		$type = $_SESSION["type"];

		if(($type == "cookies" && isset($_COOKIE["cookies"])) || $type == "set_cookies") {
			SetLongCookie("cookies", 1);
			$_SESSION["cookies_set"] = true;
			if(isset($_SESSION["first"]) && $_SESSION["first"] == true) {
				$_SESSION["visual_mode"] = "bright";
				SetLongCookie("visual_mode", "bright");
			}
		}
		elseif($type == "get_all") {

			if(isset($_COOKIE["cookies"])) {
				$_SESSION["cookies_set"] = true;
				$_SESSION["visual_mode"] = $_COOKIE["visual_mode"];
			}
			else {
				$_SESSION["cookies_set"] = false;
			}
		}
		elseif($type == "set_all") {
			if(isset($_SESSION["cookies"])) {
				SetLongCookie("cookies", 1);
			}
			if(isset($_SESSION["visual_mode"])) {
				SetLongCookie("visual_mode", "bright");
			}
		}
		elseif ($type == "get_all & set_all" || "set_all & get_all" || "get_all&set_all" || "set_all&get_all") {
			if(isset($_COOKIE["cookies"])) {
				$_SESSION["cookies_set"] = true;
				$_SESSION["visual_mode"] = $_COOKIE["visual_mode"];
				SetLongCookie("visual_mode", $_COOKIE["visual_mode"]);
				SetLongCookie("cookies_set", true);
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