<?php

session_start();

if(!isset($_SESSION["called"]) || $_SESSION["called"] == false) {
	$_SESSION["caller"] = "index/";
	$_SESSION["type"] = "get_all & set_all";
	header("Location: ../cookies.php");
	$_SESSION["called"] = false;
	$_SESSION["first"] = false;
}
elseif ($_SESSION["cookies_set"] == false) {
	// Wenn keine Cookies gesetzt wurden, bzw. nicht zugestimmt wurde wird zu JavaScript-Meldung weitergeleitet.
	header("Location: ./../../");
}

include("header.php");

?>
<p>
	<p><b><u>Das ist tempor&auml;r:</u></b></p>
	<ul>
		<li><p><a href="../registered/home">Simulierte Anmeldung</a></p></li>
		<li><p><a href="../../tmpDelCookies.php">Cookies l&ouml;schen</a></p></li>
	</ul>
</p>

<?php
include("footer.php");
?>