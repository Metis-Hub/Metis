<?php
$position = 2;
$position2 = 0;
include "../header.inc.php";
include "./header.inc.php";

$daysNames = array("nix", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag");

if(!isset($_GET["class"])) {
	header("Location: ./index.php");
}
include "../../includes/DbAccess.php";

if(!empty($_GET["remove"]) && !empty($_GET["remId"]) &&!empty($_GET["remFrom"]) &&!empty($_GET["remTo"])  &&!empty($_GET["class"])) {
	$stmt = $conn -> prepare("DELETE FROM `day_has_class` WHERE dayId=? AND classId=? AND validFrom=? AND validTo=?");
	$stmt -> bind_param("iiss", $_GET["remId"], $_GET["class"], $_GET["remFrom"], $_GET["remTo"]);
	$stmt -> execute();
	$result = $stmt -> get_result();
}
?>

<?php
$stmt = $conn -> prepare("SELECT dayId, validFrom, validTo FROM day_has_class WHERE classId = ? ORDER BY validFrom ASC;");
$stmt -> bind_param("i", $_GET["class"]);
$stmt -> execute();
$result = $stmt -> get_result();

echo "<div class=\"left\"> <center>";
echo "<form method=GET action=addDay.header.php> <input type=number name=dayId placeholder=TagesId> <input type=date name=fromDate> <input type=date name = toDate> <input type=submit name=addDay value=Hinzuf&uuml;gen> <input type=hidden name=class value=",$_GET["class"],"> <input type=hidden name=day value=", isset($_GET["day"])?$_GET["day"]:"", "></form>";

echo "<table> <tr> <th> ID </th> <th> g&uuml;ltig ab </th> <th> g&uuml;ltig bis </th> </tr>";
while($row = $result -> fetch_assoc()) {
	echo "<tr> <td> <a href=?class=",$_GET["class"], "&day=", $row["dayId"], ">", $row["dayId"], "</a> </td> <td>", date("d.m.Y", strtotime($row["validFrom"])), "</td> <td>", date("d.m.Y", strtotime($row["validTo"])), "</td> <td>
		<a href=\"?remove=1&remId=",$row["dayId"], "&remFrom=", $row["validFrom"], "&remTo=",$row["validTo"],"&class=", $_GET["class"],"&day=", $_GET["day"], "\"> entfernen </a> </td> </tr>";
}
echo "</table></center></div>";

if(isset($_GET["day"])) {
	echo "<div class=\"right subwindow\"> <center>";
	
	$stmt = $conn -> prepare("SELECT * FROM metis.day_has_class JOIN `day` ON day_has_class.dayId = day.idDay WHERE dayId = ? AND classId = ?");
	$stmt -> bind_param("ii", $_GET["day"], $_GET["class"]);
	$stmt -> execute();
	$result = $stmt -> get_result();
	if($row = $result -> fetch_assoc()) {
		echo "<h2> <a target=\"_blank\" href=./viewDay.php?day=", $row["dayId"], ">", $daysNames[$row["dayIndex"]], "</a> </h2>";
		echo "<table> <tr> <th> ID </th> <th> g&uuml;ltig ab </th> <th> g&uuml;ltig bis </th> </tr> <tr> <td>", $row["dayId"], "</a> </td> <td>", date("d.m.Y", strtotime($row["validFrom"])), "</td> <td>", date("d.m.Y", strtotime($row["validTo"])), "</td></tr> </table>";
	}
	echo "<br>";

	$stmt = $conn -> prepare(file_get_contents("courseQuery.sql"));
	$stmt -> bind_param("i", $_GET["day"]);
	$stmt -> execute();
	$result = $stmt -> get_result();

	echo "<table> <tr> <th> Stunde </th> <th> Fach </th> <th> Lehrer </th> <th> Vertretung </th> </tr>";
	while($row = $result -> fetch_assoc()) {
		echo "<tr> <td>", $row["courseIndex"], "</td> <td>", $row["subject"], " </td> <td> <a href=mailto:", $row["email"], "> ", $row["salutation"], " ", $row["name"], " </a> </td> <td>",empty($row["isSubstitude"])?"Nein":"Ja", "</td></tr>";
	}
	echo "</center> </div>";
}
?>


<?php
include "../footer.inc.php";
?>