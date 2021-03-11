<?php
$position = 2;
include "../header.php";
include "../../includes/DbAccess.php";
?>
		<h1> Klassen </h1>
		<div class="left">
			<form method="GET">
				<?php
					echo '<input type = "text" name = "class" placeholder="Klassenname" '.(!empty($_GET["class"]) ? ("value=".$_GET["class"]) :  "").'>';
				?>
				<input type=submit name=search value="Suchen">
				<input type=submit name=newClass value="Neue Klasse">
			<?php
			##### Suchsystem #####
			if(isset($_GET["search"]) ||!empty($_GET["select"])) {
				echo "<table><tr> <th>ID</th> <th>Klassenname</th></tr>";
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
					echo "<td> <input type=submit name=select value=".$row["classId"]."></td>";
					echo "<td>".$row["className"]."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			if(isset($_POST["removeTeacher"])) {
				$id = $_POST["id"];
				$stmt = $conn -> prepare("DELETE FROM teachersclass WHERE teacherId = ? AND classId = ? LIMIT 1");
				$stmt -> bind_param("ii", $id, $_GET["select"]);
				$stmt -> execute();
				$_POST["classSearch"] = "ja";
			}elseif(isset($_POST["removeStudent"])) {
				$id = $_POST["id"];
				$stmt = $conn -> prepare("DELETE FROM studentsclass WHERE studentId = ? and classId = ? LIMIT 1");
				$stmt -> bind_param("ii", $id, $_GET["select"]);
				$stmt -> execute();
				$_POST["classSearch"] = "ja";
			}

			#TODO (tmp)
			echo "jo";
			if(isset($_POST["adduser"])) {
				echo "jo";
				$id = $_POST["userid"];
				if(isset($_POST["type"]) && $_POST["type"] == "Lehrer") {
					$stmt = $conn -> prepare("INSERT INTO teachersclass (teacherId, classId) VALUES (?, ?)");
					$stmt -> bind_param("ii", $id, $_GET["select"]);
					$stmt -> execute();
				}else {
					$stmt = $conn -> prepare("INSERT INTO studentsclass (studentId, classId) VALUES (?, ?)");
					$stmt -> bind_param("ii", $id, $_GET["select"]);
					$stmt -> execute();
				}
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
			#TODO
			echo "<input type = \"submit\" name=\"deleteClass\" value=\"Klasse l&ouml;schen\">";
			echo "<input type = \"submit\" name=\"changeClassName\" value=\"Name &auml;ndern\">";
			echo "</form>";

			## Angeh�rigensuche ##
			echo "<form method=POST>";
			
			# Accountauswahl #
			echo "<label> Sch&uuml;ler </label> <input type=\"radio\" name = \"type\" value = \"Sch&uuml;ler\"".((isset($_POST["type"]) && $_POST["type"] == "Lehrer") ? "" : "checked").">";
			echo "<label> Lehrer </label> <input type=\"radio\" name = \"type\" value = \"Lehrer\"".((isset($_POST["type"]) && $_POST["type"] == "Lehrer") ? "checked" : "").">";

			# Suche #
			echo "<input type=\"text\" name=\"searchkey\" placeholder=\"Suche\">";
			echo "<input type=\"submit\" name=\"classSearch\" value=\"Suchen\">";

			#TODO (tmp)
			echo "<input type=\"number\" name=\"userid\" placeholder=\"ID\">";
			echo "<input type=\"submit\" name=\"adduser\" value=\"Hinzuf&uuml;gen\">";

			echo "</form>";


			if(isset($_POST["classSearch"])) {
				if(isset($_POST["type"]) && $_POST["type"] == "Lehrer") {
					$key = empty($_POST["searchkey"]) ? "%" : $_POST["searchkey"];
					$stmt = $conn -> prepare("SELECT teacher.id, teacher.salutation, teacher.name, teacher.email FROM teachersclass INNER JOIN teacher ON teacher.id = teachersclass.teacherId WHERE classid = ? AND (name LIKE ? OR email LIKE ?) LIMIT 20");
					$stmt -> bind_param("iss", $_GET["select"], $key, $key);
					$stmt -> execute();
					$result = $stmt -> get_result();
					echo "<table> <tr> <th> ID </th> <th>Anrede</th> <th>Name</th> <th>Email</th></tr>";
					while($row = $result -> fetch_assoc()) {
						echo "<tr>";
						echo "<td> <button onclick=\"location.href = './../accounts/teachers.php?select=".$row["id"]."&backToClass=".$_GET["select"]."'\">".$row["id"]."</button></td>";
						echo "<form method = POST><td>".$row["salutation"]."</td>";
						echo "<td>".$row["name"]."</td>";
						echo "<td>".$row["email"]."</td>";
						echo "<td> <input type='hidden' name='id' value = ".$row["id"];
						echo "><input type='submit' name='removeTeacher' value='Entfernen'></td>";
						echo "</form></tr>";
					}
					echo "</table>";
				} else {
					$key = empty($_POST["searchkey"]) ? "%" : $_POST["searchkey"];
					$stmt = $conn -> prepare("SELECT student.id, student.name, student.surname, student.email FROM studentsclass INNER JOIN student ON student.id = studentsclass.studentId WHERE classid = ? AND (name LIKE ? OR email LIKE ?) LIMIT 20");
					$stmt -> bind_param("iss", $_GET["select"], $key, $key);
					$stmt -> execute();
					$result = $stmt -> get_result();
					echo "<table> <tr> <th> ID </th> <th>Vorname</th> <th>Name</th> <th>Email</th></tr>";
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
					echo "</table>";
				}
			}



			echo "</div>";

		### Neue Klasse ###
		}elseif(isset($_GET["newClass"])){
			$success = false;
			echo "<div class=\"right\">";
			if (isset($_POST["createClass"])) {
				if(!empty($_POST["className"])) {
					$sql = "INSERT INTO grade (className) VALUES (?)";
					$stmt = $conn -> prepare($sql);
					$stmt -> bind_param("s", $_POST["className"]);
					$stmt -> execute();
					$success = true;
					header("Location: ./?select=".mysqli_insert_id($conn));
				} else {
					#TODO
					echo "Empty Fields";
				}
			}
			if(!$success) {
				echo "<h1> Neue Klasse </h1>";
				echo "<form method=POST> <input type=text name=className placeholder = 'Klassenname'> <input type=submit name=createClass> </form>";
			}
			echo "</div>";
		}
		?>
<?php
include "../footer.php";
?>