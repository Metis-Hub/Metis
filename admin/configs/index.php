<?php
$position = 3;
include "../header.inc.php";
?>
		
		<!-- Datenbank -->
		<h2><u>Datenbankeinstellungen</u></h2>
		<form action="../configs/" method="POST">
			<table width="25%" border="0">
				<tr><td width="40%">DB-Servername:</td><td><input type="text" name="$server" placeholder="DB-Servername" width="90%"></input></td></tr>
				<tr><td width="40%">DB-Username:</td><td><input type="text" name="$username" placeholder="DB-Username" width="90%"></input></td></tr>
				<tr><td width="40%">DB-Userpassword:</td><td><input type="password" name="$pw" placeholder="DB-Userpassword" width="90%"></input></td></tr>
				<tr><td width="40%">DB-Name:</td><td><input type="text" name="$name" placeholder="DB-Name" width="90%"></input></td></tr>
				<tr><td align="center" colspan="2"><input type="submit" name="$submit_db_conf" value="&Uuml;bernehmen"></input></td></tr>
			</table>
		</form>

		<!-- Laden der Datenbankstruktur -->
		<form>
			<input type="submit" name="createTables" value="Erstelle Tabellen"></input>
		</form>



		<!-- Umgebung -->
		<h2><u>Serverumgebungseinstellungen</u></h2>
		<form action="../configs/" method="POST">
			<table width="25%" border="0">
				<tr><td width="40%">Domain:</td><td><input type="text" name="$domain" placeholder="z.B.: &quot;Metis.de&quot;"></input></td></tr>
				<tr><td width="40%">Pfad zum Metisordner:</td><td><input type="text" name="$path" placeholder="z.B.: &quot;Schule/Metis/&quot;"></input></td></tr>
				<tr><td align="center" colspan="2"><input type="submit" name="$submit_server_conf" value="&Uuml;bernehmen"></input></td></tr>
			</table>
		</form>

<?php

if(isset($_POST["\$submit_db_conf"])) {
	
	$_SESSION["\$server"] = $_POST["\$server"];
	$_SESSION["\$username"] = $_POST["\$username"];
	$_SESSION["\$pw"] = $_POST["\$pw"];
	$_SESSION["\$name"] = $_POST["\$name"];
	$_SESSION["ask_for_dbAccess_change"] = true;
	header("location: ../configs/");
}
elseif (isset($_GET["change_db_access"])) {

	$server = $_SESSION["\$server"];
	unset($_SESSION["\$server"]);
	$username = $_SESSION["\$username"];
	unset($_SESSION["\$username"]);
	$pw = $_SESSION["\$pw"];
	unset($_SESSION["\$pw"]);
	$name = $_SESSION["\$name"];
	unset($_SESSION["\$name"]);

	if ($_GET["change_db_access"] == "false") header("location: ../configs/");
	elseif($_GET["change_db_access"] == "true") {
		$call_config = true;
		include "config.php";
		SetDBAccess($server, $username, $pw, $name);
	}
} elseif(isset($_GET["createTables"])) {
	# TODO
	include ("./../../includes/DbAccess.php");
	$conn -> multi_query(file_get_contents("setup.sql"));
	$conn -> close();
}

include "../footer.inc.php";
?>