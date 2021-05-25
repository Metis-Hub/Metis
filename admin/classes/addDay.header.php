<?php
include "../../includes/DbAccess.php";

if(!empty($_GET["addDay"])) {
	if(!empty($_GET["dayId"]) && !empty($_GET["fromDate"]) && !empty($_GET["toDate"])) {
		$stmt = $conn -> prepare("INSERT INTO `day_has_class`(`dayId`, `classId`, `validFrom`, `validTo`) VALUES (?, ?, ?, ?)");
		$stmt -> bind_param("iiss", $_GET["dayId"], $_GET["class"], $_GET["fromDate"], $_GET["toDate"]);
		$stmt -> execute();
		header("Location: classDays.php?day=".$_GET["day"]."&class=".$_GET["class"]);
	} else {
		header("Location: classDays.php?day=".$_GET["day"]."&class=".$_GET["class"]."&error=empty_fields");
	}
}
?>