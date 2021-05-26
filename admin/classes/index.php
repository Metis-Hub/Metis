<?php
global $position;
$position = 2;
$position2 = 0;
include "../header.inc.php";
include "./header.inc.php";

include "../../includes/DbAccess.php";

if(isset($_POST["renameClass"]) && !empty($_POST["newName"]) && !empty($_GET["select"])){
	$stmt = $conn -> prepare("UPDATE grade SET className=? WHERE classId=?");
	$stmt -> bind_param("si", $_POST["newName"], $_GET["select"]);
	$stmt -> execute();
}
if(isset($_POST["delClass"]) && !empty($_GET["select"])) {
	$stmt = $conn -> prepare("DELETE FROM grade WHERE classId = ?");
	$stmt -> bind_param("i", $_GET["select"]);
	$stmt -> execute();
}
if(isset($_GET["newClass"]) && isset($_POST["createClass"])){
	if(!empty($_POST["className"])) {
		$stmt = $conn -> prepare("INSERT INTO grade (className) VALUES (?)");
		$stmt -> bind_param("s", $_POST["className"]);
		$stmt -> execute();
		$success = true;
		header("Location: ./?select=".mysqli_insert_id($conn));
	}
}
if(isset($_POST["addStudent"]) && !empty($_POST["studentId"])) {
	$stmt = $conn -> prepare("INSERT INTO studentsclass (studentId, classId) VALUES (?, ?)");
	$stmt -> bind_param("ii", $_POST["studentId"], $_GET["select"]);
	$stmt -> execute();
}


?>
		<h1> Klassen </h1>
		<div class="left">
			<form method="GET">
				<?php
					echo '<input type = "text" name = "class" placeholder="Klassenname" '.(!empty($_GET["class"]) ? ("value=".$_GET["class"]) :  "").'>';
				?>
				<input type="submit" name="search" value="Suchen">
				<input type="submit" name="newClass" value="Neue Klasse">
			<?php
			##### Suchsystem #####
			if(isset($_GET["search"]) ||!empty($_GET["select"])) {
				echo "<table><tr> <th>Klassenname</th></tr>";
				$result;
				if(!empty($_GET["class"])) {
					$class = $_GET["class"];
					$stmt = $conn -> prepare("SELECT classId, className FROM grade WHERE className LIKE ?");
					$stmt -> bind_param("s", $class);
					$stmt -> execute();
					$result = $stmt -> get_result();
				} else {
					$result = $conn -> query("SELECT classId, className FROM grade");
				}

				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td> <a href=\"?select=".$row["classId"]."\">".$row["className"]."</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			if(isset($_POST["removeStudent"])) {
				$id = $_POST["id"];
				$stmt = $conn -> prepare("DELETE FROM studentsclass WHERE studentId = ? and classId = ? LIMIT 1");
				$stmt -> bind_param("ii", $id, $_GET["select"]);
				$stmt -> execute();
				$_POST["classSearch"] = "ja";
			}
			?>
			</form>
		</div>
		
		<?php
		##### Erweiterte Eingaben #####
		### Klasseninformation ###
		if(isset($_GET["select"])) {
			echo "<div class=\"right subwindow\">";


			$class = $_GET["select"];
			$stmt = $conn -> prepare("SELECT classId, className FROM grade WHERE classId = ?");
			if(!$stmt) {
				echo "SQL error";
				exit();
			}
			$stmt -> bind_param("i", $_GET["select"]);
			$stmt -> execute();
			$result = $stmt -> get_result() -> fetch_assoc();

			echo "<h1> Klasse ".$result["className"]." </h1>";
			
			## Klasseneinstellung ##
			echo "<form method=POST>";
			echo "<input type = \"text\" name=\"newName\" placeholder=\"neuer Name\">";
			echo "<input type = \"submit\" name=\"renameClass\" value=\"Name &auml;ndern\">";
			echo "<input type = \"submit\" name=\"delClass\" value=\"Klasse l&ouml;schen\">";
			echo "</form>";

			## Hinzufügen von Schülern ##
			echo "<form method=POST>";
			echo "<input type=\"number\" name=\"studentId\" placeholder=\"Sch&uuml;lerId\">";
			echo "<input type=\"submit\" name=\"addStudent\" value=\"Sch&uuml;ler hinzuf&uuml;gen\">";
			echo "</form>";
			
			echo "<a target=\"_blank\" href=./classDays.php?class=".$_GET["select"]."> Stundenplan </a>";
			echo "<hr>";

			## Schülerauswahl ##
			echo "<form method=POST>";
			echo "<input type=\"text\" name=\"searchkey\" placeholder=\"Suche\">";
			echo "<input type=\"submit\" name=\"classSearch\" value=\"Sch&uuml;ler suchen\">";
			echo "</form>";
			
			# Ausgabe der Schüler
			if(isset($_POST["classSearch"])) {
				$key = empty($_POST["searchkey"]) ? "%" : "%".$_POST["searchkey"]."%";
				$stmt = $conn -> prepare("SELECT student.id, student.name, student.surname, student.email FROM studentsclass INNER JOIN student ON student.id = studentsclass.studentId WHERE classid = ? AND (name LIKE ? OR email LIKE ?) LIMIT 30");
				$stmt -> bind_param("iss", $_GET["select"], $key, $key);
				$stmt -> execute();
				$result = $stmt -> get_result();
				echo "<br> <center><table> <tr> <th> ID </th> <th>Vorname</th> <th>Name</th> <th>Email</th></tr>";
				while($row = $result -> fetch_assoc()) {
					echo "<tr>";
					echo "<td> <button onclick=\"location.href = './../accounts/students.php?select=".$row["id"]."&backToClass=".$_GET["select"]."'\">".$row["id"]."</button></td>";
					echo "<form method = POST><td>".$row["name"]."</td>";
					echo "<td>".$row["surname"]."</td>";
					echo "<td>".$row["email"]."</td>";
					echo "<td> <input type='hidden' name='id' value = ".$row["id"];
					echo "><input type='submit' name='removeStudent' value='Entfernen'></td>";
					echo "</form></tr>";
				}
				echo "</center></table>";
			}

			echo "</div>";

		### Neue Klasse ###
		}elseif(isset($_GET["newClass"])){
			echo "<div class=\"right\">";
			echo "<h1> Neue Klasse </h1>";
			echo "<form method=POST> <input type=text name=className placeholder = 'Klassenname'> <input type=submit name=createClass> </form>";
			echo "</div>";
		}
		?>
<?php
include "../footer.inc.php";
?>