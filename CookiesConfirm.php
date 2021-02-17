<?php
session_start();
$_SESSION["caller"] = "index/";
$_SESSION["type"] = "set_cookies";
$_SESSION["first"] = true;

header("Location: cookies.php");

?>