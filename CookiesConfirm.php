<?php
session_start();
$_SESSION["cookie_caller"] = "index/";
$_SESSION["first_cookie"] = true;
$_SESSION["cookie_request_set"] = true;

header("Location: cookies.php");

?>