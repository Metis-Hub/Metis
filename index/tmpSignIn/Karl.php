<?php
# Das ist nur temporaer zur schnelleren anmeldung
session_start();
$_SESSION["tmpLogin"] = true;
$_SESSION["username"] = "Karl";
$_SESSION["pw"] = "karl";
header("Location: ./../../login/login.inc.php");
?>