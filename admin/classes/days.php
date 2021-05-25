<?php
$position = 2;
$position2 = 4;
include "../header.inc.php";
include "./header.inc.php";
include "./../../includes/DbAccess.php";

if(!empty($_GET["day"])) {
	$dayId = $_GET["day"];
}
?>
	<h1> Tage </h1>
	<div class="left">
		<form method="GET">
			<input type=number placeholder=TagesId name="day">
			<input type=submit value=Suchen>
		</form>
	</div>


	<?php
	if(!empty($_GET["day"])) {
		echo "<div class=right>";
		echo "<h1> Tag </h1>";

		$id = $_GET["day"];




		# Hinzufügen
		echo "<form metod=GET> <input name=courseId type=number placeholder=KursId> <input name=courseIndex type=number placeholder=\"Stunde (1-12)\"><label> Vertretung </label> <input placeholder=Vertretung type=checkbox name=substitute> <input name=day type=hidden value=", isset($_GET["day"])?$_GET["day"]:"","><input type=submit name=addCourse value=Hinzuf&uuml;gen> </form>";
		if(isset($_GET["addCourse"])) {
			$stmt = $conn -> prepare("INSERT INTO day_has_course (dayId, courseId, courseIndex, isSubstitute) VALUES (?, ?, ?, ?)");

			$day = $_GET["day"];
			$course = $_GET["courseId"];
			$index = $_GET["courseIndex"];
			$substitute = empty($_GET["substitute"])?0:1;

			if(!empty($day) && !empty($day) && !empty($day) && !empty($day)) {
				$stmt -> bind_param("iiii", $day, $course, $index, $substitute);
				$stmt -> execute();
			} else {
				echo "<script> window.alter(\"Leere Felder\") </script>";
			}
		} elseif(isset($_GET["remIndex"])) {
			$stmt = $conn -> prepare("DELETE FROM `day_has_course` WHERE dayId=? AND courseIndex=?");
			
			$index = $_GET["remIndex"];
			$day = $_GET["day"];
			if(!empty($day) && !empty($day) && !empty($day) && !empty($day)) {
				$stmt -> bind_param("ii", $day, $index);
				$stmt -> execute();
			} else {
				echo "<script> window.alter(\"Leere Felder\") </script>";
			}
		}

		# Ansicht
		$stmt = $conn -> prepare(file_get_contents("./daysCourses.sql"));
		$stmt -> bind_param("i", $id);
		$stmt -> execute();
		$result = $stmt -> get_result();

		echo "<table> <tr> <th> Stunde </th> <th> Fach </th> <th> Lehrer </th></tr>";
		while($row = $result -> fetch_assoc()) {
			echo "<tr> <td>", $row["courseIndex"], " </td> <td>", $row["subject"], "</td> <td> <a href=\"mailto:", $row["email"], "\">", $row["salutation"]." ".$row["teacherName"], " </a> </td> <td>", (empty($row["isSubstitute"])?"":"(Vertretung)"), "</td> <td> <a href=?day=", $_GET["day"], "&remIndex=", $row["courseIndex"], "> entfernen </a> </td></tr>";
		}
		echo "</table>";
		echo "</div>";
	}
	?>
<?php
include "../footer.inc.php";
?>
