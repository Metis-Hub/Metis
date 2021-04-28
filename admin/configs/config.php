<?php
# Niemand soll das über den Browser aufrufen.
if(!$call_config || !isset($call_config)) header("location: error.php");
else {
	include "../../includes/DbAccess.php";
}

function SetDBAccess($server, $username, $pw, $name) {
	if($server == "") $server = $DB_Server;
	if($username == "") $username = $DB_Username;
	if($pw == "") $pw = (isset($DB_PW)? $DB_PW : "");
	if($name == "") $name = $DB_Name;

	$content = "<?php\n" . "\t\$DB_Server = \"" . $server . "\";\n" . "\t\$DB_Username = \"" . 
				$username . "\";\n" . "\t\$DB_PW = \"" . $pw . "\";\n" . "\t\$DB_Name = \"" . $name . "\";\n" .
			   "\t\$conn = new mysqli(\$DB_Server, \$DB_Username, \$DB_PW, \$DB_Name);\n" . "?>";

	file_put_contents("../../includes/DbAccess.php", $content);
	header("location: ../index/");
}

?>