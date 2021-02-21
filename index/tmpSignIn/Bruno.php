<?php
# Das ist nur temporaer zur schnelleren anmeldung
session_start();
$_SESSION["tmpLogin"] = true;
$_SESSION["username"] = "Bruno";
$_SESSION["pw"] = "bruno";
header("Location: ./../../login/login.inc.php");
?>