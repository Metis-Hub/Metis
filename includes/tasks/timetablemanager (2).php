<?php

## Returns a valid Date
function secureDate($input, $next = true) {
	$date = null;
	if(!empty($input)) {
		$date = $input;
		$d = DateTime::createFromFormat('Y-m-d', $date);
		if(!($d && $d->format("Y-m-d") === $date)) {
			$date = date("Y-m-d", strtotime("today"));
		}
	} else {
		$date = date("Y-m-d", strtotime("today"));
	}

	$dayIndex = date("N", strtotime($date));
	if($dayIndex > 5) {
		$date = date("Y-m-d", strtotime($next ? "next monday" : "last friday", strtotime($date)));
		$dayIndex = 1;
	}
	return $date;
}

## Returns the Index of the given Date (1-5)
function getDayIndex($date) {
	return date("N", strtotime($date));
}

## Returns all Day-Objects for the given Date
function getDays($date, $conn) {
	$days = array();
	foreach($_SESSION["user"]["classes"] as $class) {
		$dayIndex = getDayIndex($date);
		$stmt = $conn -> prepare(file_get_contents("dayquery.sql"));
		$stmt -> bind_param("iiss", $class, $dayIndex, $date, $date);
		$stmt -> execute();
		$result = $stmt -> get_result();
		if($rows = $result -> fetch_assoc()) {
			$days[$rows["classId"]] = $rows["dayId"];
		}
	}
	return $days;
}
function displayDate($date) {
	return date("D", strtotime($date)) + ", " + date("W", strtotime($date)) + ".KW";
}

## Returns all Courses for the given Date
function getCourses($date, $conn) {
	$courses = array();
	foreach(getDays($date, $conn) as $class => $day) {
		$stmt = $conn -> prepare(file_get_contents("coursequery.sql"));
		$stmt -> bind_param("i", $class);
		$stmt -> execute();
		$result = $stmt -> get_result();
		
		while($rows = $result -> fetch_assoc()) {
			$index = $rows["courseIndex"];
			if(empty($courses[$index])) {
				$courses[$index] = $rows;
			}
		
			echo "<br>";
		}
	}
	return $courses;
}


function getWeek($week, $conn) {
	// get all dates from week
	$dto = new DateTime();
	$dto->setISODate($year, $week);
	$ret['week_start'] = $dto->format('Y-m-d');
	$dto->modify('+6 days');
	$ret['week_end'] = $dto->format('Y-m-d');
}
?>