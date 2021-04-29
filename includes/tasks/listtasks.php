<?php
#Zeigt alle verfügbaren aufgaben an
session_start();
if(!isset($_SESSION["user"])) {
	echo "Nicht Angemeldet";
	exit();
}


include("./../DbAccess.php");


$sql = "SELECT * FROM `task` WHERE `classId` IN (".implode(",", $_SESSION["user"]["classes"]).")";
$result = $conn -> query($sql);

echo "<table> <tr> <th> Titel </th> <th> Beschreibung </th> <th> Klasse </th> </tr>";
while($row = $result -> fetch_assoc()) {
	echo "<tr> <td> <a href=./viewtask.php?id=".$row["taskId"].">".$row["title"]."</a> </td> <td> ".$row["description"]."</td> <td>".$row["classId"]."</td> </tr>";
}
echo "</table>";
?>