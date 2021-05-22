<?php
if(isset($_GET["confirm"]) && $_GET["confirm"] == "true") {
	session_start();
	$_SESSION["cookie_caller"] = "index/";
	$_SESSION["first_cookie"] = true;
	$_SESSION["cookie_request_set"] = true;
	
	header("location: cookies.php");
}	else {
	header("location: index.php");
}
?>