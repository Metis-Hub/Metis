<?php
include ("../DbAccess.pho");

if(isset($_GET["courses"])) {
	$conn -> query("INSERT INTO `course` (teacherId, subjectId) VALUES (1, 1)");
	$conn -> query("INSERT INTO `course` (teacherId, subjectId) VALUES (2, 2)");
}

if(isset($_GET["days"])) {
	$id = null;
	foreach(array() as $day) {
		
	}
}
$conn -> query("")


header("Location: index.php");
?>