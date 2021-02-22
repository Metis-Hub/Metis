<?php
	session_start();
	if ($_SESSION["cookies_set"] == false) {
		header("Location: ./../../../");
	}
    if(isset($_POST["change_visual_mode"])) {
        $_SESSION["visual_mode"] = $_POST["visual_mode"];
		$_SESSION["caller"] = "registered/settings/ChangeSettings.php";
		$_SESSION["cookies.php_type"] = "set_all";
		header("Location: ./../../cookies.php");
		$_SESSION["called"] = false;

        header("Location: ./../settings");
    }
	if(isset($_POST["change_password"])) {
		header("Location: ./ChangePassword.php");
	}	
?>