<?php
#Zeigt die Details eines Tages an
#viewday.php?id=10
session_start();
if(!isset($_SESSION["user"])) {
	echo "Nicht Angemeldet";
	exit();
}
include("../DbAccess.php");
include("timetablemanager.php");

$date = secureDate(isset($_GET["day"])?$_GET["day"]:"");
$dayIndex = getDayIndex($date);

$prevDate = secureDate(date('Y-m-d', strtotime('-1 day', strtotime($date))), false);
$nextDate = secureDate(date('Y-m-d', strtotime('+1 day', strtotime($date))), true);

echo "<a href=?day=$prevDate> ".date("D d.m.", strtotime($prevDate))." </a> =|= ";
echo "".date("D d.m.Y", strtotime($date))."=|=";
echo "<a href=?day=$nextDate> ".date("D d.m.", strtotime($nextDate))." </a> ====";
echo "<a href=?> Heute </a> <hr>";


$courses = getCourses($date, $conn);
$conn -> close();
?>
<table>
	<tr> <th> </th> <th> Fach </th> <th> Aufgaben </th> </tr>
<?php
foreach(range(1, max(array_keys($courses))) as $index) {
	echo "<tr>", "<td>", $index, "</td>";
	if(!empty($courses[$index])) {
		$course = $courses[$index];
		echo "<td> <a href=./viewCourse.php?course=", $course["courseId"], "&day=", $date, ">", $course["subject"], "</a> </td>";
	} else {

	}
	echo "</tr>";
}
?>
</table>