<?php
	global $position;
	$position = 2;
	include("./../header.php");
	include ("./../../includes/tasks/timetablemanager.php");
	include("./../../includes/DbAccess.php");

	$date = secureDate(isset($_GET["date"])?$_GET["date"]:"");
	$next = changeWeek($date, true);
	$prev = changeWeek($date, false);
?>
	<div class="table">
			<?php
			echo "<table><tr><td><a href='?date=".date("W-Y", strtotime($prev))."'> letzte Woche (".date("W", strtotime($prev)).".KW) </a></td>";
			echo "<td>".date("W", strtotime($date)).".KW</td>";
			echo " <td> <a href='?date=".date("W-Y", strtotime($next))."'> n&auml;chste Woche (".date("W", strtotime($next)).".KW) </a> </td></tr></table>";
			
			$week = getWeek($date, $conn);
			$conn -> close();

			foreach($week as $day) {
				echo "<fieldset>";
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
