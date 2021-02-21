<?php

session_start();

if(!isset($_SESSION["called"]) || $_SESSION["called"] == false) {
	$_SESSION["caller"] = "index/";
	$_SESSION["cookies.php_type"] = "get_all & set_all";
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
		<li><a href="./../registered/home">Die Fake-Anmeldung bleibt!</a></li>
		<li>tempor&auml;re Anmeldung als:
			<ul>
				<li><a href="tmpSignIn/Jakob.php">Jakob (un = Jakob; pw = jakob)</a></li>
				<li><a href="tmpSignIn/Bruno.php">Bruno (un = Bruno; pw = bruno)</a></li>
				<li><a href="tmpSignIn/Karl.php">Karl (un = Karl; pw = karl)</a></li>
			</ul>
		</li>		
		<li><a href="./../tmpDelCookies.php">Cookies l&ouml;schen</a></li>
	</ul>
	<p>
		<h2>Zur Anmeldung:</h2>
		Zuerst Lokalserver (bei Xampp), und dann erst die Batch-Datei ("startBackend.bat") starten.
	</p>
</p>

<?php
include("footer.php");
?>