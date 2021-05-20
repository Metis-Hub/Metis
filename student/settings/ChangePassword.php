<?php

include "../../includes/Random.php";
include "../../includes/std_session.php";

Rand::SetSeed(time());
$_SESSION["safe_password_seed"] = Rand::Next() 

?><!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./../../image/faviconMetis.ico" type="image/x-icon" />
	<script language="JavaScript" type="text/JavaScript" src="../../includes/link98346.js"></script>
	<title>Metis - Einstellungen</title>
<?php
	if($_SESSION["cookies"]["visual_mode_cookie"] == "bright") {
		echo "	<link rel=\"stylesheet\" href=\"./../mainStyle.css\" />\n";
	}
	elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark") {
		echo "	<link rel=\"stylesheet\" href=\"./../mainStyle_dark.css\" />\n";
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
		<table width="40%">
			<tr>
				<td width="35%">Altes Passwort: </td>
				<td width="10%"></td>
				<td width="55%"><input type="password" name="pwd_old" id="pwd_old" placeholder="altes Passwort" width="100%" /></td>
			</tr>
			<tr><td><br /></td></tr>
			<tr>
				<td width="35%">Neues Password: </td>
				<td width="10%"></td>
				<td width="55%"><input type="password" name="pwd" id="pwd" placeholder="neues Passwort" width="100%" /></td>
			</tr>
			<tr>
				<td width="35%">Neues Password best&auml;tigen: </td>
				<td width="10%"></td>
				<td width="55%"><input type="password" name="pwd2" id="pwd2" placeholder="Best&auml;tigung des Neuens" width="100%" /></td>
			</tr>
			<tr><td><br /></td></tr>
			<tr>
				<td width="35%"></td>
				<td width="10%"><button name="password_ok" onclick="hash('<?php echo $_SESSION["safe_password_seed"];?>', 'ChangePassword.php', true)" value="&Auml;ndern" width="100%">&Auml;ndern</button></td>
				<td width="55%"></td>
			</tr>
		</table>

		<form id="password" method="POST" action="ChangePassword2.php">
			<input type="hidden" name="pw" id="pw" value="" />
			<input type="hidden" name="pw_old" id="pw_old" value="" />
		</form>

	</center>
</body>

</html>