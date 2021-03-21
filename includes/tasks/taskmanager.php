<?php
class TaskManager {
	private $days;

	function __construct() {
		$days = array();
	}

	function addDay($date) {
		# date => day
		$days[$date] = array("10/3" => array(new Task("Lost")));
	}

	function getDays() {

	}
}
class Day {
	private $tasks;
	function __construct() {
		#class => array(task)
		$tasks = array();
	}
	function addTask($class, $task) {
		if(is_a($task, "Task")) {

		}elseif(is_array($task)) {
			foreach($task as $subtask) {
				if(is_a($subtask, "Task")) {

				} else {
					#TODO keine task
				}
			}
		} else {
			#TODO überhaupt keine Task
		}
	}
}
class Task {
	public $class;
	public $title;
	public $description;


	function __construct() {
	}
}

$tasks = new TaskManager();
$tasks -> addDay("Lass mich");



?>