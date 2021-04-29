<?php
include "../../includes/DbAccess.php";

$server = $DB_Server;
$username = $DB_Username;
$pw = $DB_PW;
$name = $DB_Name;

$content = "<?php\n" .
		   "\t\$DB_Server = \"" . $server . "\";\n" .
		   "\t\$DB_Username = \"" . $username . "\";\n" .
		   "\t\$DB_PW = \"" . $pw . "\";\n" .
		   "\t\$DB_Name = \"" . $name . "\";\n" .
		   "\t\$conn = new mysqli(\$DB_Server, \$DB_Username, \$DB_PW, \$DB_Name);\n" .
		   "?>";

file_put_contents("../../includes/DbAccess.php", $content);
header("location: ../passwords/");
?>