<?php

// Wenn keine Cookies gesetzt wurden, bzw. nicht zugestimmt wurde wird zu JavaScript-Meldung weitergeleitet.
if (!isset($_COOKIE["cookie"])) {
	header('Location: ./../index.php');
}
// Da die JavaScript-Meldung nur ein temporäres Cookie setzt wird dies Cookie verlängert, sodass
// keine weitere Frage nach Cookies in nächster Zeit auftaucht
else {
	session_start();
	setcookie("cookie", "true", time() * 100, "/");	// Aktualisierung des Cookies, dass er ja nicht verschwindet

	if(isset($_SESSION["change_setting"])) {
		if($_SESSION["change_setting"] == 1) {
			setcookie("visual_mode", $_SESSION["visual_mode"], time() * 100);
			//TODO: Hier werden die anderen Einstellung als Cookie gespeichert
			$_SESSION["change_setting"] = 0;
			header("Location: ./../registered/settings");
		}
	}
	else {
		if(!isset($_COOKIE["visual_mode"])) {
			setcookie("visual_mode", "bright", time() * 100); // bei Erster Nutzung
			header('Location: ./../index');	// Annsonsten wird Seite nicht richtig dargestellt, deswegen neuladen
		}
		else {
			setcookie("visual_mode", $_COOKIE["visual_mode"], time() * 100);
		}
	}

	$_SESSION["visual_mode"] = $_COOKIE["visual_mode"];	// Modus wird in Sessions übergeben
}

include("header.php");

echo "<p>".$_SESSION["visual_mode"]."</p>";
?>

<a href="../registered/home">Simulierte Anmeldung</a>

<?php
include("footer.php");
?>