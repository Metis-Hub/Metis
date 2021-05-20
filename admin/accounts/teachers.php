<?php
function emailIsTaken($email) {
	global $conn;

	$sql = "SELECT id FROM student WHERE email=?";
	$stmt = $conn -> prepare($sql);
	$stmt -> bind_param("s", $email);
	$stmt -> execute();
	$result = $stmt -> get_result();

	if($result->num_rows == 0) {
		$sql = "SELECT id FROM teacher WHERE email=?";
		$stmt = $conn -> prepare($sql);
		$stmt -> bind_param("s", $email);
		$stmt -> execute();
		$result = $stmt -> get_result();

		if($result->num_rows == 0) {
			return false;
		}
	}
	return true;
}

function updateTeacher() {
	global $conn;
	$sql = "UPDATE teacher SET ";
	$isFirst = true;
		
	if(!empty($_POST["name"])) {
		$sql .= ($isFirst ? "name = \"".$_POST["name"]."\"" : ", name = \"".$_POST["name"]."\"");
		$isFirst = false;
	}
	if(!empty($_POST["firstname"])) {
		$sql .= ($isFirst ? "firstname = \"".$_POST["firstname"]."\"" : ", firstname = \"".$_POST["firstname"]."\"");
		$isFirst = false;
	}
	if(!empty($_POST["email"])) {
		$sql .= ($isFirst ? "email = \"".$_POST["email"]."\"" : ", name = \"".$_POST["email"]."\"");
		$isFirst = false;
	}
	if(!empty($_POST["salutation"])) {
		$sql .= ($isFirst ? "salutation = \"".$_POST["salutation"]."\"" : ", name = \"".$_POST["salutation"]."\"");
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
$position2 = 1;
include "../header.php";
include "accountHeader.php";
include("../../includes/DbAccess.php");
	if ($conn->connect_errno) {
		echo "<h1>No DB-Connection</h1>";
		exit();
	}
?>
	<div class="left">
		<center> <h2>Lehrer</h2> </center>

		<!-- Suche -->
		<form method="GET">
			<?php
				echo '<input type = "text" name = "name" placeholder="Name" '.(!empty($_GET["name"]) ? ("value=".$_GET["name"]) :  "").'>';
				echo '<input type = "text" name = "mail" placeholder="Mail" '.(!empty($_GET["mail"]) ? ("value=".$_GET["mail"]) :  "").'>';
			?>
			<input type=submit name=search value="Suchen">
			<input type=submit name=newAccount value="Neuer Account">

			<br>
			<table>
				<tr> <th>ID</th> <th>Anrede</th> <th>Nachname</th> <th>Email</th></tr>
			<?php
			if(!empty($_GET["search"]) ||!empty($_GET["select"])) {
				$sql = "SELECT id, salutation, name, email FROM teacher";
			

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
					echo "<td>".$row["salutation"]."</td>";
					echo "<td>".$row["name"]."</td>";
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
		changePassword0(decrypt($_SESSION["safe_password_seed"], $_POST["pw"]), $_SESSION["students_select"], "teacher", $session = false);
		unset($_SESSION["students_select"]);
	}
	elseif(isset($_POST["createAccount"])) {
		if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["pwd"]) || empty($_POST["pwdConfirm"]) || empty($_POST["firstname"]) || empty($_POST["salutation"])) {
			echo "Nope, da waren leere Felder";
		} else {
			$name = $_POST["name"];
			$email = $_POST["email"];
			$pwd = $_POST["pwd"];
			$firstname = $_POST["firstname"];
			$salutation = $_POST["salutation"];

			if($pwd != $_POST["pwdConfirm"]) {
				echo "Die Passwörter stimmen nicht überein";
			} else {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL) || emailIsTaken($email)) {
					echo "Ung&uuml;ltige Email";
				} else {
					$password = password_hash($pwd, PASSWORD_BCRYPT, array(
						"cost" => 5
					));
					$stmt = $conn -> prepare("INSERT INTO teacher (name, email, password, firstname, salutation) VALUES (?, ?, ?, ?, ?)");
					if(!$stmt) {
						echo "SQL-Fehler";
					} else {
						$stmt -> bind_param("sssss", $name, $email, $password, $firstname, $salutation);
						$stmt -> execute();
						header("Location: teachers.php?select=".mysqli_insert_id($conn));
					}
				}
			}
		}
	}elseif(isset($_POST["updateUser"]) && isset($_GET["select"])) {
		if(!updateTeacher()) {
			#TODO
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
		<button name=\"password_ok\" onclick=\"hash('" . $_SESSION["safe_password_seed"] . "', 'teacher.php', true)\" value=\"&Auml;ndern\">&Auml;ndern</button>

		<form id=\"password\" method=\"POST\" action=\"teachers.php\">
			<input type=\"hidden\" id=\"pw\" name=\"pw\" value=\"\"></input>
			<input type=\"hidden\" id=\"pw_old\" name=\"pw_old\" id=\"pw_old\" value=\"\"></input>
		</form>";

			echo "</div>";
		} else {
			echo "<div class='right'>";
			echo "<h2>Lehrerinformation</h2>";

			$stmt = $conn -> prepare("SELECT id, salutation, firstname, name, email FROM teacher WHERE id = ?");
			$stmt -> bind_param("i", $_GET["select"]);
			$stmt -> execute();
			$result = $stmt -> get_result() -> fetch_assoc();

			$edit = isset($_POST["edit"]);
			if(!empty($result)) {
			echo "
				<form method=POST>
					<table>
						<tr> <th> ID </th> <td>".$result["id"]."</td></tr>
						<tr> <th> Anrede </th> <td>".$result["salutation"]."</td>". ($edit ? "<td> <input type = text name = salutation> </td>" : "")."</tr>
						<tr> <th> Vorname </th> <td>".$result["firstname"]."</td>". ($edit ? "<td> <input type = text name = firstname> </td>" : "")."</tr>
						<tr> <th> Nachname </th> <td>".$result["name"]."</td>". ($edit ? "<td> <input type = text name = name> </td>" : "")."</tr>
						<tr> <th> E-Mail </th> <td>".$result["email"]."</td>". ($edit ? "<td> <input type = text name = email> </td>" :"")."</tr>
						<tr> <th> Password </th> <td><a href='?select=".$_GET["select"]."&editPwd=1'>Passwort &auml;ndern</a></td></tr>
						<tr> <th> Klassen </th> <td>";
						{
							$stmt = $conn -> prepare("SELECT grade.className, grade.classId FROM teachersclass INNER JOIN grade ON grade.classid = teachersclass.classId WHERE teachersclass.teacherId = ?");
							$stmt -> bind_param("i", $result["id"]);
							$stmt -> execute();
							$result = $stmt -> get_result();
							while($element = $result -> fetch_assoc()) {
								echo "<a href = './../classes?select=".$element["classId"]."'>".$element["className"]."</a>  ";
							}
						}

					
						echo "</td></tr>
						<tr> <th> <input type=submit name=delete value=Entfernen> </th>
						<th> ".($edit ? "<input type=submit value=Abbrechen> </th> <th> <input type=submit name=updateUser value=Absenden>" : "<input type=submit name=edit value=Bearbeiten>")."</th> </tr>
					</table>
				</form>";
			} else {
				echo "Es gibt keinen Nutzer mit dieser ID";
			}
			echo "</div>";
			}
		} elseif(isset($_GET["newAccount"])) {
			echo "<div class='right'>";
			echo "<h2>Neuer Lehrer</h2>";

			echo "
				<form method=POST>
					<table>
						<tr> <th> Anrede </th> <td> <input type=text name=salutation placeholder=Anrede> </td></tr>
						<tr> <th> Vorname </th> <td> <input type=text name=firstname placeholder=Name> </td></tr>
						<tr> <th> Nachname </th> <td> <input type=text name=name placeholder=Nachname> </td></tr>
						<tr> <th> E-Mail </th><td> <input type=text name=email placeholder=E-Mail> </td></tr>
						<tr> <th> Password </th> <td><input type=password name=pwd placeholder=Passwort></td></tr>
						<tr> <th> Password best&auml;tigen </th> <td><input type=password name=pwdConfirm placeholder=Wiederholung></td></tr>
						<tr> <th> </th><th><input type=submit name=createAccount value='Account erstellen'></th></tr>
					</table>
				</form>
			";
		} elseif(false) {
			#TODO Account-Löschung
		}
		######## Ende ########
	?>
</body>
</html>
