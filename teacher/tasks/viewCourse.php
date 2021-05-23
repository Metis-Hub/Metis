<?php
	$position = 1;
	$position2 = 0;
	include("./../header.inc.php");
	include("./header.inc.php");
include("./../../includes/DbAccess.php");
?>

<center>
	<h1> Kursansicht </h1>
	<hr>
<?php
$stmt = $conn -> prepare(file_get_contents("courseInfoQuery.sql"));
$stmt -> bind_param("i", $_GET["course"]);
$stmt -> execute();
$result = $stmt -> get_result();
if($row = $result -> fetch_assoc()) {
	echo "<table> <tr> <th> Lehrer </th> <td>", $row["salutation"]." ".$row["teacherName"]."</tr>";
	echo "<tr> <th> Kontaktdaten </th> <td> <a href=\"mailto: ".$row["teacherEmail"]."\">".$row["teacherEmail"]."</a></td></tr>";
	echo "<tr><th> Fach </th> <td>", $row["subject"], "</td> </tr> </table>";
} else {
	// Kurs existiert nicht
	echo "<h2> Der Kurs existiert nicht </h2>";
}
?>

</center>

<?php
include("./../footer.inc.php");
?>