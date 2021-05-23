<?php
	global $position;
	$position = 2;
	include("./../header.inc.php");
	include ("./timetablemanager.inc.php");
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

					# Für alle Kurse (1 - max)
					foreach(range(1, max(array_keys($day["courses"]))) as $index) {
						# wenn der in der Stunde ein Kurs eingetragen ist
						if(!empty($day["courses"][$index])) {
							$course = $day["courses"][$index];
							echo "<tr> <td> $index </td> <td> <a href='./viewCourse.php?course=", $course["courseId"], "'  target='_blank' class=course", !empty($day["isSubstitute"])?", substitute":"", ">", $course["subject"], "</a> </td>";
							
							foreach($course["tasks"] as $task) {
								echo "<td> <a href='./viewTask.php?task=", $task["taskId"], "' target='_blank' class=", ($task["hasDone"]?"done":"undone")," task>", $task["title"], "</a></td>";
							}
							echo "</tr>";
						# sonst -> Freistunde
						} else {
							
							echo "<tr> <td>", $index, "</td> <td> Frei </td> </tr>";
						}
					}
					if(!empty($day["extraTasks"])) {
							echo "<tr> <th colspan=2> extra </th>";

							foreach($day["extraTasks"] as $task) {
								echo "<td> <a href='./viewTask.php?task=", $task["taskId"], "' target='_blank' class=", ($task["hasDone"]?"done":"undone")," task>", $task["title"], "</a></td>";
							}
							echo "</tr>";
						}
						echo "</table>";
				}

				echo "</fieldset>";
			}
			?>
	</div>

<?php
	include("./../footer.inc.php");
?>
