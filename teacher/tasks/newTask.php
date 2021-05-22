<?php
	global $position;
	$position = 1;
	$position2 = 1;
	include("./../header.inc.php");
	include("./header.inc.php");
?>
	<center>
	<form method=POST>
		<table>
			<tr>
				<td>
					<!-- Fächerauswahl -->
					<select name=course>
						<?php
						$stmt = $conn -> prepare(file_get_contents("coursesQuery.sql"));
						$stmt -> bind_param("i", $_SESSION["user"]["id"]);
						$stmt -> execute();
						$result = $stmt -> get_result();
						while($row = $result -> fetch_assoc()) {
							echo "<option value=".$row["courseId"].">".$row["long"]."</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input name=date type=date placeholder=Datum>
				</td>
			</tr>
			<tr>
				<td>
					<input type=text name=title placeholder=Titel></input>
				</td>
			</tr>
			<tr>
				<td>
					<textarea name ="description" cols="50" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<input list=grade name=grade>
					<datalist id=grade>
						<?php
							include("./../../includes/DbAccess.php");
							$result = $conn -> query("SELECT classId, className FROM grade");
							while($row = $result->fetch_object()){
								echo "<option name=".$row->classId."> ".$row -> className."</option>";
							}

						?>
					</datalist>
				</td>
			</tr>
			<tr>
				<td>
					<input type=submit name=submitTask>
				</td>
			</tr>
		</table>
	</form>
	</center>
<?php
	if(isset($_POST["submitTask"])) {
		# Erweiterungsmöglichkeit: testen ob das datum an einem wochenende ist
		if(!empty($_POST["course"]) && !empty($_POST["date"]) && !empty($_POST["title"]) && !empty($_POST["grade"])) {
			$date = date("Y-m-d", strtotime($_POST["date"]));
			$today = date("Y-m-d");
			$stmt = $conn -> prepare("INSERT INTO task (courseId, title, description, toDate, createdDate) VALUES (?, ?, ?, ?, ?)");
			$stmt -> bind_param("issss", $_POST["course"], $_POST["title"], $_POST["description"], $date, $today);
			$stmt -> execute();
			$id = $conn -> insert_id;


			$stmt = $conn -> prepare("SELECT studentId FROM studentsclass JOIN grade ON grade.classId = studentsclass.classId AND className = ?");
			$stmt -> bind_param("s", $_POST["grade"]);
			$stmt -> execute();
			$result = $stmt -> get_result();

			$students = array();
			while($row = $result -> fetch_assoc()) {
				array_push($students, $row["studentId"]);
			}

			if(!empty($students)) {
				$sql = "INSERT INTO student_has_task (studentId, taskId) VALUES (".implode(", $id ), (", $students).", $id)";
				$conn -> query($sql);
			}
			
			header("Location: ./viewTask.php?task=$id");
			
		} else {
			echo "<script> window.alert(\"Freie Felder\"); </script>";
		}

	}
	include("./../footer.inc.php");
?>