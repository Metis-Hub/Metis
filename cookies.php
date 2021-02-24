<?php
session_start();
$time = time() + (3600*24*360);	// Das wäre ein Jahr
$caller = "Location: ".((isset($_SESSION["cookie_caller"]))?$_SESSION["cookie_caller"]:"index/");

if(isset($_SESSION["cookie_request_set"])) {	// Zuerst werden die Cookies gesetzt
	
	if(isset($_SESSION["first_cookie"])) {	// Bei den ersten Aufruf (wenn noch keine Cookies gesetzt wurde), werden diese gesetzt

		unset($_SESSION["first_cookie"]);

		setcookie("allow_set_cookies", 1, $time);
		setcookie("visual_mode_cookie", "bright", $time);
	}
	elseif($_SESSION["cookie_request_set"] == "visual_mode_cookie") {
		setcookie("visual_mode_cookie", $_SESSION["cookies"]["visual_mode_cookie"], $time);
	}

	// Nun wird die Seite neugeladen und dabei die Sessions mit den Cookieinhalten gesetzt
	unset($_SESSION["cookie_request_set"]);
	$_SESSION["cookie_request_get"] = true;
	header("Location:".$_SERVER['REQUEST_URI']);
}
elseif(isset($_SESSION["cookie_request_get"])) {	// Und dannach abgerufen
	
	unset($_SESSION["cookie_request_get"]);
	
	if(!isset($_COOKIE["allow_set_cookies"])) {
		$_SESSION["cookies"]["allow_set_cookies"] = false;
		header($caller);
	}
	else {
		$_SESSION["cookies"]["allow_set_cookies"] = true;
		$_SESSION["cookies"]["visual_mode_cookie"] = $_COOKIE["visual_mode_cookie"];
		$_SESSION["cookies"]["request_send"] = true;
		header($caller);
	}
}
elseif(isset($_SESSION["cookie_request_del"])) {
	
	unset($_SESSION["cookie_request_del"]);

	setcookie("allow_set_cookies", 1, 1);	// Die Cookies werden auf eine abgelaufene Zeit gesetzt
	setcookie("visual_mode_cookie", $_COOKIE["visual_mode_cookie"], 1);

	$_SESSION["cookie_request_get"] = true;
	header("Location:".$_SERVER['REQUEST_URI']);	// Neuladen
}

?>