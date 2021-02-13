<?php
include("header.php");

// Wenn keine Cookies gesetzt wurden, bzw. nicht zugestimmt wurde wird zu JavaScript-Meldung weitergeleitet.
if (!isset($_COOKIE["cookie"])) {
	header('Location: ./../index.php');
}
// Da die JavaScript-Meldung nur Tempräre Cookies setzt wird dies Cookie verlängert, sodass
// keine weitere Frage nach Cookies in nächster Zeit auftaucht
else {

	setcookie("cookie", "true", time() * 100);	// Aktualisierung des Cookies, dass er ja nicht verschwindet

	if(!isset($_COOKIE["visual_mode"])) {
		setcookie("visual_mode", "bright", time() * 100); // bei Erster Nutzung
	}
	else {
		setcookie("visual_mode", $_COOKIE["visual_mode"], time() * 100);	// Annsonsten wird alter Modus behalten.
	}

}

?>

<a href="../registered/home">Simulierte Anmeldung</a>

<?php
include("footer.php");
?>