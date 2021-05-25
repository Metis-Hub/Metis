<?php
function emailIsTaken($email) {
	global $conn;

	$sql = "SELECT id FROM student WHERE email=? UNION SELECT id FROM teacher WHERE email=?";


	return !($result->num_rows == 0);
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

$position = 1;
$position2 = 0;
include "../header.inc.php";
include "accountHeader.inc.php";
include("../../includes/DbAccess.php");
	if ($conn->connect_errno) {
		echo "<h1>No DB-Connection</h1>";
		exit();
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
				<tr> <th>ID</th> <th>Name</th> <th>Nachname</th> <th>Email</th></tr>
			<?php
			if(!empty($_GET["search"]) ||!empty($_GET["select"])) {
				$sql = "SELECT id, name, surname, email FROM student";
			

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
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["surname"]."</td>";
					echo "<td>".$row["email"]."</td>";
					echo "</tr>";
				}
			}
			?>
			</table>
		</form>
	</div>
	<?php

	######## Aktionsbehandlung ########
	if(isset($_POST["pw"])) {
		include "../../includes/login/crypt.php";
		include "../../includes/user.php";
		changePassword0(decrypt($_SESSION["safe_password_seed"], $_POST["pw"]), $_SESSION["students_select"], "student", $session = false);
		unset($_SESSION["students_select"]);
		//echo $_POST["pw"];
	}
	elseif(isset($_POST["createAccount"])) {
		if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["pwd"]) || empty($_POST["pwdConfirm"]) || empty($_POST["surname"])) {
			echo "Nope, da waren leere Felder";
		} /*else if(strlen($_POST["pwd"]) < 8) {	// Mindestlänge beträgt 8
			echo "Passwort zu kurz!";
		}*/
		else {
			$name = $_POST["name"];
			$email = $_POST["email"];
			$pwd = $_POST["pwd"];
			$surname = $_POST["surname"];

			if($pwd != $_POST["pwdConfirm"]) {
				echo "Die Passw&ouml;rter stimmen nicht &uuml;berein";
			} else {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL) || emailIsTaken($email)) {
					echo "Ung&uuml;ltige Email";
				} else {
					$password = password_hash($pwd, PASSWORD_BCRYPT, array(
						"cost" => 5
					));
					$stmt = $conn -> prepare("INSERT INTO student (name, email, password, surname) VALUES (?, ?, ?, ?)");
					if(!$stmt) {
						echo "SQL-Fehler";
					} else {
						$stmt -> bind_param("ssss", $name, $email, $password, $surname);
						$stmt -> execute();
						header("location: students.php?select=".mysqli_insert_id($conn));
					}
				}
			}
		}
	} elseif(isset($_POST["updateUser"]) && isset($_GET["select"])) {
		if(!updateStudent()) {
			#TODO funktioniert nicht
			echo "Hast du entwa Felder freigelassen?";
		}
	}



	######## Auswahl ########
	if(!empty($_GET["select"])) {
		if(!empty($_GET["editPwd"])) {
			echo "<div class=\"right\">";
			echo "<h2>Passwort&auml;nderung</h2>";
				include "../../includes/Random.php";
				Rand::SetSeed(time());
				$_SESSION["safe_password_seed"] = Rand::Next();
				$_SESSION["students_select"] = $_GET["select"];
				echo "
		<input type=\"password\" id=\"pwd\" name=\"pwd\" placeholder=\"Neues Passwort\"></input>
		<input type=\"password\" id=\"pwd2\" name=\"pwd2\" placeholder=\"Passwort wiederholen\"></input>
		<input type=\"hidden\" id=\"pwd_old\" name=\"pwd_old\" value=\"12345678\"></input>
		<button name=\"password_ok\" onclick=\"hash('" . $_SESSION["safe_password_seed"] . "', 'students.php', true)\" value=\"&Auml;ndern\">&Auml;ndern</button>

		<form id=\"password\" method=\"POST\" action=\"students.php\">
			<input type=\"hidden\" id=\"pw\" name=\"pw\" value=\"\"></input>
			<input type=\"hidden\" id=\"pw_old\" name=\"pw_old\" id=\"pw_old\" value=\"\"></input>
		</form>";

			echo "</div>";
		} else {
			echo "<div class=\"right\">";
			echo "<h2>Sch&uuml;lerinformation</h2>";

			$stmt = $conn -> prepare("SELECT * FROM student WHERE id = ?");
			$stmt -> bind_param("i", $_GET["select"]);
			$stmt -> execute();
			$result = $stmt -> get_result() -> fetch_assoc();

			$edit = isset($_POST["edit"]);
			if(!empty($result)) {
			echo "
	<form method=POST>
		<table>
			<tr> <th> ID </th> <td>" . $result["id"]."</td></tr>
			<tr> <th> Name </th> <td>".$result["name"]."</td>". ($edit ? "<td> <input type=\"text name=\"name\"> </td>" : "")."</tr>
			<tr> <th> Nachname </th> <td>".$result["surname"]."</td>". ($edit ? "<td> <input type=\"text name=\"surname\"> </td>" : "")."</tr>
			<tr> <th> E-Mail </th> <td>".$result["email"]."</td>". ($edit ? "<td> <input type=\"text name=\"email\"> </td>" :"")."</tr>
			<tr> <th> Password </th> <td><a href='?select=".$_GET["select"]."&editPwd=1'>Passwort &auml;ndern</a></td></tr>
			<tr> <th> Klassen </th> <td>";
			{
				// displaying all classes
				$stmt = $conn -> prepare("SELECT grade.className, grade.classId FROM studentsclass INNER JOIN grade ON grade.classid = studentsclass.classId WHERE studentsclass.studentId = ?");
				$stmt -> bind_param("i", $result["id"]);
				$stmt -> execute();
				$result = $stmt -> get_result();
				while($element = $result -> fetch_assoc()) {
					echo "<a href = './../classes?select=".$element["classId"]."'>".$element["className"]."</a>  ";
				}
			}

					
			echo "</td></tr>
			<tr> <th> <input type=\"submit\" name=\"delete\" value=\"Entfernen\"> </th>
			<th> ".($edit ? "<input type=\"submit\" value=\"Abbrechen\"> </th> <th> <input type=\"submit\" name=\"updateUser\" value=\"Absenden\">" : "<input type=\"submit\" name=\"edit\" value=\"Bearbeiten\">")."</th> </tr>
		</table>
	</form>";
			} else {
				echo "Es gibt keinen Nutzer mit dieser ID";
			}
			echo "</div>";
			}
		} elseif(isset($_GET["newAccount"])) {
			echo "<div class=\"right\">";
			echo "<h2>Neuer Sch&uuml;ler</h2>";

			echo "
	<form method=POST>
		<table>
			<tr> <th> Name </th> <td> <input type=\"text\" name=\"name\" placeholder=\"Name\"> </td></tr>
			<tr> <th> Nachname </th> <td> <input type=\"text\" name=\"surname\" placeholder=\"Nachname\"> </td></tr>
			<tr> <th> E-Mail </th><td> <input type=\"text\" name=\"email\" placeholder=\"E-Mail\"> </td></tr>
			<tr> <th> Password </th> <td><input type=\"password\" name=\"pwd\" placeholder=\"Passwort\"></td></tr>
			<tr> <th> Password best&auml;tigen </th> <td><input type=\"password\" name=\"pwdConfirm\" placeholder=\"Wiederholung\"></td></tr>
			<tr> <th> </th><th><input type=\"submit\" name=\"createAccount\" value=\"Account erstellen\"></th></tr>
		</table>
	</form>";
		} elseif(false) {
			#TODO Account-Löschung
		}
		######## Ende ########
	?>

</body>
</html>
