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
			<input type=submit name=search value=Suchen>
			<br>
			<input type=number name=dayIndex min=1 max=5 placeholder="TagesIndex (1-5)">
			<input type=submit name=newDay value="Neuer Tag">
		</form>
	


	<?php
	if(!isset($_GET["newDay"])) {
		if(!empty($_GET["day"])) {
			echo "</div><div class=right>";
			$id = $_GET["day"];
			echo "<h1> Tag $id</h1>";

			

			# Hinzufügen
			echo "<form metod=GET> <input name=courseId list=courses placeholder=KursId> <datalist id=courses>";
			$result = $conn -> query("SELECT courseId, `long` as subject, name FROM course JOIN teacher on teacherId = id JOIN subject on subject.subjectId = course.subjectId");
			while($row = $result -> fetch_assoc()) {
				echo "<option value=".$row["courseId"]."> ".$row["subject"]." ".$row["name"]."</option>";
			}
			
			echo "</datalist><input name=courseIndex type=number placeholder=\"Stunde (1-12)\"><label> Vertretung </label> <input placeholder=Vertretung type=checkbox name=substitute> <input name=day type=hidden value=", isset($_GET["day"])?$_GET["day"]:"","><input type=submit name=addCourse value=Hinzuf&uuml;gen> </form>";
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
		} else {
			$days = array("nix", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag");
			$stmt = $conn -> prepare("SELECT * FROM day");
			$stmt -> execute();
			$result = $stmt -> get_result();

			echo "<br> <table> <tr> <th> TagesId </th> <th> Wochentag </th> </tr>";
			while($row = $result -> fetch_assoc()) {
				echo "<tr> <td> <a href=\"?day=", $row["idDay"], "\">", $row["idDay"], "</a> </td> <td>", $days[$row["dayIndex"]], "</td> </tr>";
			}
			echo "</table>";
		}
	}
	if(isset($_GET["newDay"]) && !empty($_GET["dayIndex"])) {
		$index = $_GET["dayIndex"];
		$stmt = $conn -> prepare("INSERT INTO day (dayIndex) VALUES (?)");
		$stmt -> bind_param("i", $index);
		$stmt -> execute();

		header("Location: ?search=1&day=".$conn-> insert_id);
	}
	?>
<?php
include "../footer.inc.php";
?>
