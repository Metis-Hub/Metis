<?php
include("./../../includes/DbAccess.php");

echo "<a href=day.php?day=", $_GET["day"], "> Zur&uuml;ck </a>", "<hr>";

$stmt = $conn -> prepare(file_get_contents("courseInfoQuery.sql"));
$stmt -> bind_param("i", $_GET["course"]);
$stmt -> execute();
$result = $stmt -> get_result();
if($rows = $result -> fetch_assoc()) {
	var_dump($rows);
}
?>