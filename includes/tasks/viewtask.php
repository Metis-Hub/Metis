<?php
#Zeigt die Details zu einer Aufgabe an
#viewtask.php?id=10
session_start();
if(!isset($_SESSION["user"])) {
	echo "Nicht Angemeldet";
	exit();
}


include("./../DbAccess.php");
$sql = "SELECT * FROM `task` WHERE taskId = ? AND `classId` IN (".implode(",", $_SESSION["user"]["classes"]).") LIMIT 1";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("i", $_GET["id"]);
$stmt -> execute();

$result = $stmt -> get_result() -> fetch_assoc();

var_dump($result);
?>