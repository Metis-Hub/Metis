<?php
session_start();
include "./../DbAccess.php";

class TaskManager {
	private $days;

	function __construct() {
		$days = array();
	}

	function fetchDays($from, $to) {
		$days["date"] = new Day();
	}
	function clearDays() {
		$days = array();
	}

	function getDays() {
		return $days;
	}
}

class Day {
	private $courses;
	#TODO
	private $timespans;

	function __construct($date) {
		$courses = array();
	}
	function fetchCourses() {
		$sql = "SELECT * FROM ";
	}
}
class Course {
	private $courseId;
	private $courseName;
	private $courseShort;

	function __construct() {

	}
}

class Task {
	public $class;
	public $title;
	public $description;


	function __construct($id) {
	}
}


function addDefaultDays() {
	global $conn;
	foreach (array("Mon", "Tue", "Wed", "Thu", "Fri") as $day) {
		$conn -> query("INSERT INTO `day` (DayName) VALUES (\"$day\")");
	}
	foreach (array("eng" => "Englisch", "de" => "Deutsch", "ma" => "Mathe") as $short => $long) {
		$conn -> query("INSERT INTO `subject` (`short`, `long`) VALUES (\"".$short."\", \"".$long."\")");
	}

}
addDefaultDays();
$date = new DateTime();
echo $date->modify("+1 days")->format('D');
?>