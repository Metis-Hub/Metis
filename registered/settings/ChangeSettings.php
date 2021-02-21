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
		$_SESSION["cookies.php_type"] = "set_all";
		header("Location: ./../../cookies.php");
		$_SESSION["called"] = false;

        header("Location: ./../settings");
    }
	if(isset($_POST["change_password"])) {
		if($_SESSION["visual_mode"] == "bright")
			echo "	<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
		elseif($_SESSION["visual_mode"] == "dark")
			echo "	<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
	}
	if(isset($_POST["password_ok"])) {
		
	}
	
?>
</head>

<body>
<?php
	if(isset($_POST["change_password"])) {
		echo "<center><form action=\"ChangeSettings.php\" method=\"post\"><table width=\"40%\"><tr><td width=\"40%\">Altes Passwort: </td><td width=\"60%\"><input type=\"password\" name=\"old\""
		." placeholder=\"altes Passwort\" width=\"100%\"/></td></tr><tr><td><br /></td></tr><tr><td width=\"40%\">Neues Password: </td><td width=\"60%\"><input type=\"password\" name=\"new\" "
		."placeholder=\"neues Passwort\" width=\"100%\"/></td></tr><tr><td width=\"40%\">Neues Password best&auml;tigen: </td><td width=\"60%\"><input type=\"password\" name=\"new_2\""
		."placeholder=\"Best&auml;tigung des Neuens\" width=\"100%\"/></td></tr></table><p width=\"100%\"><input type=\"submit\" name=\"password_ok\" width=\"40%\"></input></p></form></center>";		
	}
?>
</body>

</html>

<!--	<center>
		<form action=\"ChangeSettings.php\" method=\"post\">
			<table width=\"40%\">
				<tr>
					<td width=\"40%\">Altes Passwort: </td>
					<td width=\"60%\"><input type=\"password\" name=\"old\" placeholder=\"altes Passwort\" width=\"100%\"/></td>
				</tr>
				<tr><td><br /></td></tr>
				<tr>
					<td width=\"40%\">Neues Password: </td>
					<td width=\"60%\"><input type=\"password\" name=\"new\" placeholder=\"neues Passwort\" width=\"100%\"/></td>
				</tr>
				<tr>
					<td width=\"40%\">Neues Password best&auml;tigen: </td>
					<td width=\"60%\"><input type=\"password\" name=\"new_2\" placeholder=\"Best&auml;tigung des Neuens\" width=\"100%\"/></td>
				</tr>
			</table>
			<p width=\"100%\"><input type=\"submit\" name=\"password_ok\" width=\"40%\"></input></p>
		</form>
	</center>
-->