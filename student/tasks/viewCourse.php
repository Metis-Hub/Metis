<?php
$title = "Aufgabenansicht";
include("./minimalHeader.php");
include("./../../includes/DbAccess.php");

$stmt = $conn -> prepare(file_get_contents("courseInfoQuery.sql"));
$stmt -> bind_param("i", $_GET["course"]);
$stmt -> execute();
$result = $stmt -> get_result();
if($rows = $result -> fetch_assoc()) {
	var_dump($rows);
}
?>



<php?
include("./../footer.php");
?>