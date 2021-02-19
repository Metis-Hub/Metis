<!DOCTYPE html>
<html>

<head>
	<title>Metis - Einstellungen</title>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
<?php
	session_start();
	if ($_SESSION["cookies_set"] == false) {
		header("Location: ./../../../");
	}
    if(isset($_POST["change_visual_mode"])) {
        $_SESSION["visual_mode"] = $_POST["visual_mode"];
		$_SESSION["caller"] = "registered/settings/ChangeSettings.php";
		$_SESSION["type"] = "set_all";
		header("Location: ./../../cookies.php");
		$_SESSION["called"] = false;

        header("Location: ./../settings");
    }
	if(isset($_POST["password_ok"])) {
		
	}

?>
</head>

<body>
<?php
	if(isset($_POST["change_password"])) {
		if($_SESSION["visual_mode"] == "bright")
			echo "	<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
		elseif($_SESSION["visual_mode"] == "dark")
			echo "	<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
		echo"
	<center>
		<form action=\"ChangeSettings.php\" method=\"post\">
			<table>
				<tr>
					<td>Altes Passwort: </td>
					<td><input type=\"password\" name=\"old\" /></td>
				</tr>
				<tr>
					<td>Neues Password: </td>
					<td><input type=\"password\" name=\"new\" /></td>
				</tr>
				<tr>
					<td>Neues Password best&auml;tigen: </td>
					<td><input type=\"password\" name=\"new_2\" /></td>
				</tr>
				<tr>
					<td><input type=\"submit\" name=\"password_ok\"></input></td>
				</tr>
			</table>
		</form>
	</center>
";		
	}
?>
</body>

</html>