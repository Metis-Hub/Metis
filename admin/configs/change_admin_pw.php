<?php
include "../../includes/std_session.php";
include "../../forms/crypt.inc.php";
include "userdata.inc.php";

$text0 = "<!DOCTYPE html>\n<html>\n<head>\n\t<title>Metis - Passwort &auml;ndern</title>\n";
$text1 = "\n</head>\n<body></body>\n</html>";

if (isset($_POST["pw_old"]) && isset($_SESSION["safe_password_seed"])) {
	if(isset($_POST["pw"])) {
		/*if(strlen($_POST["pw"]) < 8) {
			echo $text0 . "<script type=\"text/JavaScript\">alert(unescape(\"Das neue Passwort muss mindestens 8 Stellen lang sein%21\"));</script>" . $text1;
		}
		else*/ if(password_hash(decrypt($_SESSION["safe_password_seed"], $_POST["pw_old"]), PASSWORD_DEFAULT) == $password) {
			echo $text0 . "<script type=\"text/JavaScript\">alert(unescape(\"123\"));</script>" . $text1;
		}
		else {
			echo $text0 . "<script type=\"text/JavaScript\">alert(\"" . $password . ";\\n" . password_hash(decrypt($_SESSION["safe_password_seed"], $_POST["pw_old"]), PASSWORD_DEFAULT) ."\");</script>" . $text1;
		}
	}
}

?>