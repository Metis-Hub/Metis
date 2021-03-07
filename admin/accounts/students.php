<?php
function emailIsTaken($email) {
	global $conn;

	#TODO

	return false;
}
function createStudent($email, $pwd, $name) {
	global $conn;




	$sql = "INSERT INTO $table (email, name, password) VALUES (?, ?, ?)";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	$password = password_hash($pwd, PASSWORD_BCRYPT, array(
		"cost" => 5
	));

	mysqli_stmt_bind_param($stmt, "sss", $email, $name, $password);
	mysqli_stmt_execute($stmt);
}

function updateStudent() {
	global $conn;
	$sql = "UPDATE student SET ";
	$isFirst = true;
		
	if(!empty($_POST["name"])) {
		$sql .= ($isFirst ? "name = \"".$_POST["name"]."\"" : ", name = \"".$_POST["name"]."\"");
		$isFirst = false;
	}
	if(!empty($_POST["surname"])) {
		$sql .= ($isFirst ? "surname = \"".$_POST["surname"]."\"" : ", surname = \"".$_POST["surname"]."\"");
		$isFirst = false;
	}
	if(!empty($_POST["email"])) {
		$sql .= ($isFirst ? "email = \"".$_POST["email"]."\"" : ", name = \"".$_POST["email"]."\"");
		$isFirst = false;
	}
	$sql .= " WHERE id = ?";
	$stmt = $conn -> prepare($sql);

	if($stmt === false) {
		return false;
	}

	$stmt -> bind_param("i", $_GET["select"]);
	$stmt -> execute();
	return true;
}

function viewStudents() {
	global $conn;
	$sql = "SELECT * FROM student";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		echo "<form method='POST'>";
		echo "<input type=submit name=student-del value=".$row["id"]."> </input>";
		foreach($row as $key => $value) {
			if($table == "student") {
				if($key == "name" || $key == "email") {
					echo "<b>$key</b>: $value, ";
				}
			} else {
				if($key == "name" || $key == "email") {
					echo "<b>$key</b>: $value, ";
				}
			}
		}
		echo "</form>";
	}
}

$position = 1;
$position2 = 0;
include "../header.php";
include "accountHeader.php";
include("../../includes/DbAccess.php");
	if ($conn->connect_errno) {
		echo "<h1>No DB-Connection</h1>";
		exit();
	}
?>

	<?php
	if(isset($_POST["student_submit"])) {
		if(!empty($_POST["email"] && !empty($_POST["pwd"]) && !empty($_POST["name"]))) {
			if(!emailIsTaken($_POST["email"])) {
				createStudent($_POST["email"], $_POST["pwd"], $_POST["name"]);
			} else {
				#email ist vergeben
			}
		} else {
			#leere felder
		}
	}
	elseif(isset($_POST["student-del"])) {
		$id = $_POST["student-del"];
		$sql = "DELETE FROM student WHERE id = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);

		mysqli_stmt_bind_param($stmt, "s", $id);
		mysqli_stmt_execute($stmt);
	}elseif(isset($_POST["updateUser"]) && isset($_GET["select"])) {
		if(!updateStudent()) {
			#TODO
			echo "SQL-Fehler";
		}
	}elseif(isset($_POST["updatePwd"])) {

	}
	?>
	<div class="left">
		<center> <h2>Sch&uuml;ler</h2> </center>

		<!-- Suche -->
		<form method="GET">
			<?php
				echo '<input type = "text" name = "name" placeholder="Name" '.(!empty($_GET["name"]) ? ("value=".$_GET["name"]) :  "").'>';
				echo '<input type = "text" name = "mail" placeholder="Mail" '.(!empty($_GET["mail"]) ? ("value=".$_GET["mail"]) :  "").'>';
				echo '<input type = "text" name = "class" placeholder="Klasse" '.(!empty($_GET["class"]) ? ("value=".$_GET["class"]) :  "").'>';
			?>
			<input type=submit name=search value="Suchen">
			<input type=submit name=newAccount value="Neuer Account">

			<br>
			<table>
				<tr> <th>ID</th> <th>Name</th> <th>Email</th></tr>
			<?php
			if(!empty($_GET["search"]) ||!empty($_GET["select"])) {
				$sql = "SELECT id, Name, email FROM student";
			

				$isFirst = true;
				if(!empty($_GET["name"])) {
					 $sql .= ($isFirst ? " WHERE " : " && ")." Name = \"".$_GET["name"]."\"";
					 $isFirst = false;
				}
				if(!empty($_GET["mail"])) {
					 $sql .= ($isFirst ? " WHERE " : " && ")." email = \"".$_GET["mail"]."\"";
					 $isFirst = false;
				}
				$sql .= " LIMIT 20";

				$result = $conn -> query($sql);

				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td> <input type=submit name=select value=".$row["id"]."></td>";
					echo "<td>".$row["Name"]."</td>";
					echo "<td>".$row["email"]."</td>";
					echo "</tr>";
				}
			}
			?>
			</table>
		</form>
	</div>
	<?php
	if(!empty($_GET["select"])) {
		echo "<div class='right'>";
		echo "<h2>Student</h2>";

		$stmt = $conn -> prepare("SELECT * FROM student WHERE id = ?");
		$stmt -> bind_param("i", $_GET["select"]);
		$stmt -> execute();
		$result = $stmt -> get_result() -> fetch_assoc();

		$edit = isset($_POST["edit"]);
		echo "
			<form method=POST>
				<table>
					<tr> <th> ID </th> <td>".$result["id"]."</td></tr>
					<tr> <th> Name </th> <td>".$result["Name"]."</td>". ($edit ? "<td> <input type = text name = name> </td>" : "")."</tr>
					<tr> <th> Nachname </th> <td>".$result["id"]."</td>". ($edit ? "<td> <input type = text name = surname> </td>" : "")."</tr>
					<tr> <th> E-Mail </th> <td>".$result["email"]."</td>". ($edit ? "<td> <input type = text name = email> </td>" :"")."</tr>
					<tr> <th> Password </th> <td><input type=submit name=changePwd value = 'Passwort &auml;ndern'></td></tr>
					<tr> <th> Klassen </th> <td> Stuff </td></tr>
				</table>
				".($edit ? "<input type=submit name=updateUser value=Absenden><input type=submit value=Abbrechen>" : "<input type=submit name=edit value=Bearbeiten>")."
			</form
		";
		echo "</div>";
		} elseif(isset($_GET["newAccount"])) {
			echo "<div class='right'>";
			echo "<h2>Neuer Sch&uuml;ler</h2>";

			echo "
				<form method=POST>
					<table>
						<tr> <th> Name </th> <td> <input type = text name = name> </td></tr>
						<tr> <th> Nachname </th> <td> <input type = text name = surname> </td></tr>
						<tr> <th> E-Mail </th><td> <input type=text name=email> </td></tr>
						<tr> <th> Password </th> <td><input type=password name=pwd></td></tr>
					</table>
				</form>
			";
		}
	?>
</body>
</html>
