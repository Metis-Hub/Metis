<?php
#Zeigt die Details eines Tages an
#viewday.php?id=10
session_start();
if(!isset($_SESSION["user"])) {
	echo "Nicht Angemeldet";
	exit();
}

# Reading the date
$date = null;
if(!empty($_GET["date"])) {
	$date = $_GET["date"];
	$d = DateTime::createFromFormat('Y-m-d', $date);
	if(!($d && $d->format("Y-m-d") === $date)) {
		$date = date("Y-m-d", strtotime("today"));
	}
} else {
	$date = date("Y-m-d", strtotime("today"));
}

$dayIndex = date("N", strtotime($date));
if($dayIndex > 5) {
	$date = date("Y-m-d", strtotime("next Monday"));
	$dayIndex = 1;
}
# 

echo "Datum: ", $date, "<br>";

include("./../DbAccess.php");


$days = array();
foreach($_SESSION["user"]["classes"] as $class) {
	$stmt = $conn -> prepare(file_get_contents("dayquery.sql"));

	$stmt -> bind_param("iiss", $class, $dayIndex, $date, $date);
	$stmt -> execute();
	$result = $stmt -> get_result();
	if($rows = $result -> fetch_assoc()) {
		$days[$rows["classId"]] = $rows["dayId"];
	}
}
echo "Klasse => Tag: ";
var_dump($days);
echo "<br>";

echo "Kurse: ";
foreach($days as $class => $day) {
	$stmt = $conn -> prepare(file_get_contents("coursequery.sql"));
	$stmt -> bind_param("i", $class);
	$stmt -> execute();
	$result = $stmt -> get_result();
	while($rows = $result -> fetch_assoc()) {
		var_dump($rows);
		echo "<br>";
	}
}

?>