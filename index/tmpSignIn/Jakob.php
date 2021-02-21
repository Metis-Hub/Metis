<?php
# Das ist nur temporaer zur schnelleren anmeldung
session_start();
$_SESSION["tmpLogin"] = true;
$_SESSION["username"] = "Jakob";
$_SESSION["pw"] = "jakob";
header("Location: ./../../login/login.inc.php");
?>