<?php
	session_start();
    if(isset($_POST["visual_mode"])) {
        $_SESSION["visual_mode"] = $_POST["visual_mode"];
		$_SESSION["caller"] = "registered/settings/ChangeSettings.php";
		$_SESSION["type"] = "set_all";
		header("Location: ./../../cookies.php");
		$_SESSION["called"] = false;

        header("Location: ./index.php");
    }
?>