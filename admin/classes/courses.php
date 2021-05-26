<?php
$position = 2;
$position2 = 1;
### including ###
include "../header.inc.php";
include "./header.inc.php";
include "../../includes/DbAccess.php";

?>

<!-- course - form -->
<h1>Kurse</h1>
<div class="left">
<form methode="GET">
	<input type="text" placeholder="Kursname" name="course"></input>
	<input type="submit" name="search" value="Suchen"></input>
	<input type="submit" name="new_course" value="Kurs hinzuf&uuml;gen"></input>
</form>

<?php
## Creating / Deleting Courses
if(isset($_GET["createCourse"]) && !empty($_GET["teacherId"]) && !empty($_GET["subjectId"])) {
	$subject = $_GET["subjectId"];
	$teacher = $_GET["teacherId"];

	$stmt = $conn -> prepare("INSERT INTO course (teacherId, subjectId) VALUES (?, ?)");
	$stmt -> bind_param("ii", $teacher, $subject);
	$stmt -> execute();

	header("Location: ?search=Suchen&course=".$conn -> insert_id);
} elseif(!empty($_GET["delCourse"])) {
	$id = $_GET["delCourse"];
	$stmt = $conn -> prepare("DELETE FROM course WHERE courseId = ?");
	$stmt -> bind_param("i", $id);
	$stmt -> execute();
}


if(isset($_GET["search"])) {

	### connection ###
	$res = $conn -> query("
	SELECT course.courseId, course.teacherId, course.subjectId, salutation, name, email, `long` as `subject` FROM course
	JOIN teacher on course.teacherId = id
	JOIN subject on course.subjectId = subject.subjectId
	");

	### output ###
	echo "<table border=\"0\">";
	echo "<tr> <th>Id</th> <th>Lehrer</th> <th>Fach</th> </tr>";

	while($row = $res -> fetch_assoc()) {
		echo "<tr>\n<td>" . $row["courseId"]  . "</td><td> <a href=\"mailto:" . $row["email"] . "\">" . $row["salutation"] . " " .  $row["name"]  . "</a></td><td>" . $row["subject"]  . "</td> <td> <a href=\"?search=Suchen&delCourse=".$row["courseId"]."\"> entfernen </a> </td> </tr>";
	}
	echo "</table>";
}
?>
</div>

<?php
if(isset($_GET["new_course"])) {
	echo "<div class=\"right\"> <h1> Neuer Kurs </h1>";
	echo "<form method=GET> <input  class=\"datalist\" list=teachers name=teacherId placeholder=LehrerId> <input list=subjects name=subjectId placeholder=FachId>";

	$result = $conn -> query("SELECT id, email FROM teacher");
	echo "<datalist id=teachers>";
	while($row = $result -> fetch_assoc()) {
		echo "<option value=".$row["id"].">".$row["email"]."</option>";
	}
	echo "</datalist>";

	$result = $conn -> query("SELECT subjectId, `long` as subject FROM subject");
	echo "<datalist  class=\"datalist\" id=subjects>";
	while($row = $result -> fetch_assoc()) {
		echo "<option value=".$row["subjectId"].">".$row["subject"]."</option>";
	}
	echo "</datalist>";
	echo "<input type=submit name=createCourse value=Erstellen></form>";
}
?>

<?php
include "../footer.inc.php";
?>