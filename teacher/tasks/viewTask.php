<?php
	$position = 1;
	$position2 = 0;
	include("./../header.inc.php");
	include("./header.inc.php");

	# Überprüfung ob die taskId gesetzt ist
	if(empty($_GET["task"])) {
		header("./");
	}
?>

<center>

<?php
	include("./../../includes/DbAccess.php");

	
	$stmt = $conn -> prepare(file_get_contents("viewTask.sql"));
	$stmt -> bind_param("ii", $_GET["task"], $_SESSION["user"]["id"]);
	$stmt -> execute();
	$result = $stmt -> get_result();
	
	if($row = $result -> fetch_assoc()) {
		echo "<fieldset>",
			"<table> <tr> <th> Kurs </th> <td> <a href=viewCourse.php?course=", $row["courseId"], " target=\"_blank\"> ", $row["subject"], "</a> </td> </tr>",
			"<tr> <th> Titel </th> <td> ", $row["title"], "</td> </tr>",
			"<tr> <th> Aufgabe </th> <td> ", $row["description"], "</td> </tr>",
			"<tr> <th> Abgabedatum </th> <td> ", date("d.m.Y.", strtotime($row["toDate"])), "</td> </tr>",
			"</table>";
			
			if(!empty($_GET["viewStudents"])) {
				echo "<hr/>";
					$stmt = $conn -> prepare("SELECT COUNT(*) FROM student_has_task WHERE taskId = ?  && hasDone = 1 UNION SELECT COUNT(*) FROM student_has_task WHERE taskId = ?");
					$stmt -> bind_param("ii", $_GET["task"], $_GET["task"]);
					$stmt -> execute();
					$result = $stmt -> get_result();

					if(mysqli_num_rows($result) < 2) {
						echo "Dieser Aufgabe wurde kein Sch&uuml;ler zugeordnet";
					} else {
						if($row = $result -> fetch_assoc()) {
							echo $row["COUNT(*)"], "/";
							$row = $result -> fetch_assoc();
							echo $row["COUNT(*)"], " Sch&uuml;ler haben diese Aufgabe erledigt";
						}
						echo "<table> <tr> <th> Name </th> <th> Erledingt </th> </tr>";
						$stmt = $conn -> prepare(file_get_contents("tasksStudents.sql"));
						$stmt -> bind_param("i", $_GET["task"]);
						$stmt -> execute();
						$result = $stmt -> get_result();
						while($row = $result -> fetch_assoc()) {
							echo "<tr> <td> <a href=mailto:",$row["email"], ">", $row["name"], " ", $row["surname"], " </a> </td> <td> ", empty($row["hasDone"])?"Nein":"Ja", "</tr>";
						}
						echo "</table>";
					}
			} else {
				echo "<a href=?task=".$_GET["task"]."&viewStudents=1> Sch&uuml;ler anzeigen </a>";
			}

		
		echo "</fieldset>";
	} else {
		echo "<h1> Sie haben keinen Zugriff auf diese Aufgabe! </h1>";
	}

?>

</center>

<?php
	include("./../footer.inc.php");
?>