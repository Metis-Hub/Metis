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
<form action="courses.php" methode="GET">
	<input type="text" placeholder="Kursname" name="look_for_course"></input>
	<input type="submit" name="search" value="Suchen"></input>
	<input type="submit" name="new_course" value="Kurs hinzuf&uuml;gen"></input>
</form>

<?php

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

		echo "<tr>\n<td>" . $row["courseId"]  . "</td><td>" . $row["salutation"] . " " .  $row["name"]  . "</td><td>" . $row["subject"]  . "</td>";

		echo "</tr>";
	}
}

echo "</table>";
?>
</div>

<?php
include "../footer.inc.php";
?>