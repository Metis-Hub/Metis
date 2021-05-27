<?php
$position = 3;
include "../header.inc.php";
include "userdata.inc.php";
include "../../includes/Random.php";

Rand::SetSeed(time());
$_SESSION["safe_password_seed"] = Rand::Next();

?>
		
		<!-- Datenbank -->
		<h2><u>Datenbankeinstellungen</u></h2>
		<form action="../configs/" method="POST">
			<table width="25%" border="0">
				<tr><td width="40%">DB-Servername:</td><td><input type="text" name="$server" placeholder="DB-Servername" width="90%"></input></td></tr>
				<tr><td width="40%">DB-Username:</td><td><input type="text" name="$username" placeholder="DB-Username" width="90%"></input></td></tr>
				<tr><td width="40%">DB-Userpassword:</td><td><input type="password" name="$pw" placeholder="DB-Userpassword" width="90%"></input></td></tr>
				<tr><td width="40%">DB-Name:</td><td><input type="text" name="$name" placeholder="DB-Name" width="90%"></input></td></tr>
				<tr><td></td><td><input type="submit" name="$submit_db_conf" value="&Uuml;bernehmen"></input></td></tr>
			</table>
		</form>

		<!-- Laden der Datenbankstruktur -->
		<form action="../configs/" method="POST">
			<input type="submit" name="createTables" value="Erstelle Tabellen"></input>
		</form>

		<!-- Zugriff Admin -->
		<h2><u>Adminzugriff &auml;ndern</u></h2>
		<table width="25%" border="0">

			<form action="../configs/" method="POST">
				<tr>
					<td width="40%">Benutzername:</td>
					<td width="40%"><input type="text" name="$user_name" placeholder="z.B.: &quot;Admin&quot;"></input></td>
					<td align="left" colspan="2"><input type="submit" name="$submit_change_user_name" value="&Auml;ndern"></input></td>
				</tr>
			</form>

			<tr><td colspan="3"><hr /></td></tr>

			<tr><td width="40%">Altes Passwort:</td><td><input type="password" name="pwd_old" id="pwd_old" placeholder="altes Passwort"></input></td></tr>
			<tr><td width="40%">Neues Passwort:</td><td><input type="password" name="pwd" id="pwd" placeholder="neues Passwort"></input></td></tr>
			<tr><td width="40%">Best&auml;tigung:</td><td><input type="password" name="pwd2" id="pwd2" placeholder="neus Passwort wiederholen"></input></td></tr>
			<tr><td></td><td><button name="password_ok" onclick="hash('<?php echo $_SESSION["safe_password_seed"];?>', 'change_admin_pw.php', true)" value="&Auml;ndern" width="100%">&Auml;ndern</button></td></tr>
			
			<tr><td colspan="3"><hr /></td></tr>
			<form action="../configs/" method="POST">
				<tr>
					<td align="left" colspan="2"><input type="submit" name="$submit_reset" value="Zur&uuml;cksetzen"></input></td>
				</tr>
			</form>
		</table>

		<form id="password" method="POST" action="change_admin_pw.php">
			<input type="hidden" name="pw" id="pw" value="" />
			<input type="hidden" name="pw_old" id="pw_old" value="" />
		</form>
<?php

if(isset($_POST["\$submit_db_conf"])) {
	
	$_SESSION["\$server"] = $_POST["\$server"];
	$_SESSION["\$username"] = $_POST["\$username"];
	$_SESSION["\$pw"] = $_POST["\$pw"];
	$_SESSION["\$name"] = $_POST["\$name"];
	$_SESSION["ask_for_dbAccess_change"] = true;
	header ("location: ../configs/");
} elseif (isset($_GET["change_db_access"])) {

	$server = $_SESSION["\$server"];
	unset ($_SESSION["\$server"]);
	$username = $_SESSION["\$username"];
	unset ($_SESSION["\$username"]);
	$pw = $_SESSION["\$pw"];
	unset ($_SESSION["\$pw"]);
	$name = $_SESSION["\$name"];
	unset ($_SESSION["\$name"]);

	if ($_GET["change_db_access"] == "false") header("location: ../configs/");
	elseif ($_GET["change_db_access"] == "true") {
		$call_config = true;
		include "config.php";
		SetDBAccess($server, $username, $pw, $name);
	}
} elseif (isset($_POST["createTables"])) {
	$call_config = true;
	include "./../../includes/DbAccess.php";
	$conn -> multi_query(file_get_contents("setup.sql"));
	$conn -> close();
	unset ($_POST["createTables"]);
	echo '<script>alert("Die Tabellen wurden erfolreich erstellt.");</script>';
} elseif (isset($_POST["\$submit_change_user_name"]) && !empty($_POST["\$user_name"])) {
	$content = "<?php\nglobal \$user_name;\n\$user_name = \"" . $_POST["\$user_name"] . 
	"\";\nglobal \$password;\n\$password = '" . $password . "';\n?>";
	file_put_contents ("userdata.inc.php", $content, true);
	file_put_contents ("../.htpasswd", $_POST["\$user_name"] . ":" . $password, true);
} elseif (isset($_POST["\$submit_reset"])) {
	$content = "<?php\nglobal \$user_name;\n\$user_name = \"Admin" . 
	"\";\nglobal \$password;\n\$password = '" . password_hash("admin", PASSWORD_DEFAULT) . "';\n?>";
	file_put_contents ("userdata.inc.php", $content, true);
	file_put_contents ("../.htpasswd", "Admin:" . password_hash("admin", PASSWORD_DEFAULT), true);
}


include "../footer.inc.php";
?>