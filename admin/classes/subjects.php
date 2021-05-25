<?php
$position = 2;
$position2 = 2;
include "../header.inc.php";
include "./header.inc.php";
include "./../../includes/DbAccess.php";
?>
<center>
<br>
<h1> F&auml;cher </h1>
	<form method="GET">
		<input type="text" name="long" placeholder="Langform">
		<input type="text" name="short" placeholder="Kurzform">
		<input type="submit" name="addSubject" value="Hinzuf&uuml;gen">
	</form>

	<?php
		# Hinzufügen
		if(!empty($_GET["addSubject"]) && !empty($_GET["long"]) && !empty($_GET["short"])) {
			$long = $_GET["long"];
			$short = $_GET["short"];

			$stmt = $conn -> prepare("INSERT INTO subject (`long`, `short`) VALUES (?, ?)");
			$stmt -> bind_param("ss", $long, $short);
			$stmt -> execute();
			$result = $stmt -> get_result();
		# Löschen
		} elseif(!empty($_GET["rem"])) {
			$id = $_GET["rem"];

			$stmt = $conn -> prepare("DELETE FROM subject WHERE subjectId = ?");
			$stmt -> bind_param("i", $id);
			$stmt -> execute();
		}

		$stmt = $conn -> prepare("SELECT * FROM subject");
		$stmt -> execute();
		$result = $stmt -> get_result();

		echo "<table> <tr> <th> ID </th> <th> Langform </th> <th> Kurzform </th> </tr>";
		while($row = $result -> fetch_assoc()) {
			echo "<tr> <td>", $row["subjectId"], "</td> <td>", $row["long"], "</td> <td>", $row["short"], "</td> <td> <a href=?rem=",$row["subjectId"], "> entfernen </a> </td> </tr>";
		}
		echo "</table>";
	?>

</center>
<?php
include "../footer.inc.php";
?>