<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
	<title>Metis - Einstellungen</title>
<?php
	include("./../../login/user.php");
	if($_SESSION["cookies"]["visual_mode_cookie"] == "bright") {
		echo "	<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
	}
	elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark") {
		echo "	<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
	}

	if(isset($_POST["password_ok"])) {
		if((isset($_POST["new"]) && isset($_POST["new_2"])) && ($_POST["new"] == $_POST["new_2"])) {
			$_SESSION["new_passwort"] = $_POST["new"];
			$_SESSION["old_passwort"] = $_POST["old"];
			if(isPasswordOk($_SESSION["user"]["uname"], $_POST["old"])) {
				echo "\n<script type=\"text/JavaScript\">alert(unescape(\"Das Passwort ist OK%21\"));</script>";
				#Passwort ändern @Bruno!
			}
			else {
				echo "\n<script type=\"text/JavaScript\">alert(unescape(\"Das alte Passwort ist falsch%21\"));</script>";
			}
		}
		else {
			echo "\n<script type=\"text/JavaScript\">alert(unescape(\"Die Best%E4tigung des neuen Passwortes entspricht nicht den neuen%21\"));</script>";
		}

	}
?>
</head>

<body>

	<header>
		<nav>
			<a href="./../settings/">zur&uuml;ck</a>
		</nav>
	</header>

	<center>
		<form action="ChangePassword.php" method="post">
			<br />
			<br />
			<table width="40%">
				<tr>
					<td width="35%">Altes Passwort: </td>
					<td width="10%"></td>
					<td width="55%"><input type="password" name="old" placeholder="altes Passwort" width="100%" /></td>
				</tr>
				<tr><td><br /></td></tr>
				<tr>
					<td width="35%">Neues Password: </td>
					<td width="10%"></td>
					<td width="55%"><input type="password" name="new" placeholder="neues Passwort" width="100%" /></td>
				</tr>
				<tr>
					<td width="35%">Neues Password best&auml;tigen: </td>
					<td width="10%"></td>
					<td width="55%"><input type="password" name="new_2" placeholder="Best&auml;tigung des Neuens" width="100%" /></td>
				</tr>
				<tr><td><br /></td></tr>
				<tr>
					<td width="35%"></td>
					<td width="10%"><input type="submit" name="password_ok" value="&Auml;ndern" width="100%" /></td>
					<td width="55%"></td>
				</tr>
			</table>
		</form>
	</center>
</body>

</html>