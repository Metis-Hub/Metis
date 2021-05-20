<?php
	global $position;
	$position = 2;
	include("./../header.php");
	include ("./../../includes/tasks/timetablemanager.php");
	
	$date = secureDate(isset($_GET["date"])?$_GET["date"]:"");
?>

	<div class="table">
			<?php
			include("./../../includes/DbAccess.php");
			$week = getWeek($date, $conn);
			$conn -> close();

			foreach($week as $day) {
				echo "<fieldset>";
				var_dump($day);
				echo "<legend>", date("D - d.m.Y", strtotime($day["date"])), "</legend>";
				if(!empty($day["courses"])) {
					echo "<table>";
					foreach(range(1, max(array_keys($day["courses"]))) as $index) {
						if(!empty($day["courses"][$index])) {
							$course = $day["courses"][$index];
							echo "<tr> <td> $index </td> <td> <a href='./viewCourse.php?course=", $course["courseId"], "'>", $course["subject"], "</a> </td> </tr>";
						} else {

						}
						echo "</table>";
					}
				}

				echo "</fieldset>";
			}
			?>
	</div>

<?php
	include("./../footer.php");
?>
