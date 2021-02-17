<?php

session_start();

if(!isset($_SESSION["called"]) || $_SESSION["called"] == false) {
	$_SESSION["caller"] = "index/";
	$_SESSION["type"] = "all";
	header("Location: ../cookies.php");
}
elseif ($_SESSION["cookies_set"] == false) {
	// Wenn keine Cookies gesetzt wurden, bzw. nicht zugestimmt wurde wird zu JavaScript-Meldung weitergeleitet.
	header('Location: ./../../');
}
include("header.php");

?>

<a href="../registered/home">Simulierte Anmeldung</a>

<?php
include("footer.php");
?>