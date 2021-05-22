<html>
<head>
<?php
	session_start();
	if ($_SESSION["cookies_set"] == false) {
		header("Location: ./../../../");
	}
    if(isset($_POST["change_visual_mode"])) {
		echo "<script type=\"text/javascript\">alert(\"" . $_POST["visual_mode"] . "\");</script>";
		$_SESSION["cookie_request_set"] = "visual_mode_cookie";
        $_SESSION["cookies"]["visual_mode_cookie"] = $_POST["visual_mode"];
		$_SESSION["cookie_caller"] = "student/settings/ChangeSettings.php";
	}
?>
</head>
<body></body>
</html>
<?php
	if(isset($_POST["change_visual_mode"])) {
		header("Location: ./../../cookies.php");
		$_SESSION["called"] = false;

        header("Location: ./../settings");
    }
	if(isset($_POST["change_password"])) {
		header("Location: ./ChangePassword.php");
	}	
?>
