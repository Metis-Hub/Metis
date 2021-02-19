<!DOCTYPE html>
<html>

<head>
	<title>Metis - Einstellungen</title>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
<?php
	session_start();
	if ($_SESSION["cookies_set"] == false)
		header("Location: ./../../../");
    if(isset($_POST["change_visual_mode"])) {
        $_SESSION["visual_mode"] = $_POST["visual_mode"];
		$_SESSION["caller"] = "registered/settings/ChangeSettings.php";
		$_SESSION["type"] = "set_all";
		header("Location: ./../../cookies.php");
		$_SESSION["called"] = false;

        header("Location: ./../settings");
    }
?>
</head>

<body>
<?php
	if(isset($_POST["password_ok"])) {
		if(!$_POST["old"] || !$_POST["new"] || !$_POST["new_2"]){
			if(!$_POST["old"]) {
				echo
	"<p><b>Altes Passwort ist nicht eingegeben!</b></b>";
			}
			if(!$_POST["new"]) {
				echo
	"<p><b>Neues Passwort ist nicht eingegeben!</b></b>";
			}
			if(!$_POST["new_2"]){ 
				echo
	"<p><b>Neues Passwort ist nicht best&auml;tigt!</b></b>";
			}
			echo
	"<p><a href=\"./../settings\"><u>Klicken Sie hier um zu den Einstellungen zur&uuml;ckzukehren.</u></a></p>";
		}
		elseif($_POST["new"] != $_POST["new_2"]) {
			echo
	"<p><b>Passwortbest&auml;tigung stimmt nicht mit den neuen Passwort &uuml;berein!</b></p>";
		}
	}
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