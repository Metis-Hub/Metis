<?php
include ("../DbAccess.php");

if(isset($_GET["courses"])) {
	$conn -> query("INSERT INTO `course` (teacherId, subjectId) VALUES (1, 1)");
	$conn -> query("INSERT INTO `course` (teacherId, subjectId) VALUES (2, 2)");
	$conn -> query('INSERT INTO `subject` (`short`, `long`) VALUES ("ma", "Mathe"), ("info", "Informatik")');
}

if(isset($_GET["days"])) {
	foreach(array(1, 2, 3, 4, 5) as $day) {
		$conn -> query("INSERT INTO `day` (dayIndex) VALUES ($day)");
		$id = $conn -> insert_id;

		$conn -> query('INSERT INTO `day_has_class` (dayId, classId, validFrom, validTo) VALUES ('.$id.', 1, "2021-01-01", "2022-01-01")');

		foreach(array(1, 2) as $course) {
			$conn -> query("INSERT INTO `day_has_course` (courseId, dayId, courseIndex) VALUES ($course, $id, $couse)");
		}
	}
}


#header("Location: index.php");
?>