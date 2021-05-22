<?php
$title = "Aufgabenansicht";
include("./minimalHeader.inc.php");
include("./../../includes/DbAccess.php");

function defaultDate($date) {
	return date("d.m.Y (D)", strtotime($date));
}
function setDone($taskId, $studentId, $bool, $conn) {
	$stmt = $conn -> prepare("UPDATE `student_has_task` SET `hasDone`= ? WHERE `taskId` = ? AND `studentId` = ?");
	$stmt -> bind_param("iii", $bool, $taskId, $studentId);
	$stmt -> execute();
}

if(isset($_GET["hasDone"])) {
	if($_GET["hasDone"] == "true") {
		setDone($_GET["task"], $_SESSION["user"]["id"], 1, $conn);
	} else {
		setDone($_GET["task"], $_SESSION["user"]["id"], 0, $conn);
	}
}
?>
<center>
	<h1> Aufgabenansicht </h1>
	<hr>
	<center>
		<?php
		$stmt = $conn -> prepare(file_get_contents("taskInfoQuery.sql"));
		$stmt -> bind_param("ii", $_GET["task"], $_SESSION["user"]["id"]);
		$stmt -> execute();
		$result = $stmt -> get_result();
		if($task = $result -> fetch_assoc()) {
			echo "<fieldset><legend>"."<a href=./viewCourse.php?course=".$task["courseId"]."> ".$task["subject"]."</a>"."</legend>";
			echo "<table> <tr> <th>", $task["title"] ,"</th> </tr>";
			echo "<tr> <td> <fieldset>", $task["description"] ,"</fieldset></td> </tr>";
			echo "<tr> <th> Abgabe </th> <td>", defaultDate($task["toDate"]), "</td> </tr>";
			echo "<tr> <th> Erstelt am </th> <td>", defaultDate($task["createdDate"]), "</td> </tr>";
			echo "<tr> <th>".($task["hasDone"]?"Erledigt":"Nicht Erledigt")."</th> <td> <a href=?task=".$_GET["task"]."&hasDone=".(!$task["hasDone"]?"true":"false").">".(!$task["hasDone"]?"als erledigt markieren":"als nicht erledigt markieren")."</a>";
			echo "</table>";
			
			echo "</legend>";
		} else {
			echo "<h2> Du hast keinen Zugriff auf diese Aufgabe </h2>";
		}


		?>
	</center>
<?php
include("./../footer.inc.php");
?>