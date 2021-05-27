<?php
include "../../includes/std_session.php";
include "./../../includes/user.php";
include "../../forms/crypt.inc.php";

$text0 = "<!DOCTYPE html>\n<html>\n<head>\n\t<title>Metis - Passwort &auml;ndern</title>\n";
$text1 = "\n</head>\n<body></body>\n</html>";

if (isset($_POST["pw_old"]) && isset($_SESSION["safe_password_seed"])) {
	if(isset($_POST["pw"])) {
		if(strlen($_POST["pw"]) < 8) {
			echo $text0 . "<script type=\"text/JavaScript\">alert(unescape(\"Das neue Passwort muss mindestens 8 Stellen lang sein%21\"));</script>" . $text1;
		}
		else if(changePassword(decrypt($_SESSION["safe_password_seed"], $_POST["pw_old"]), decrypt($_SESSION["safe_password_seed"], $_POST["pw"]))) {
			header("Location: ./../settings/");
		}
		else {
			echo $text0 . "<script type=\"text/JavaScript\">alert(unescape(\"Das alte Passwort ist falsch%21\"));window.location.href=\"./../settings/\";</script>" . $text1;
		}
	}
}
?>