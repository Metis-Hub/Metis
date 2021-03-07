<?php
function createAccount($table, $email, $pwd, $name) {
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
function viewAccounts($table) {
	global $conn;
	$sql = "SELECT * FROM $table";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		echo "<form method='POST'>";
		echo "<input type=submit name=$table-del value=".$row["id"]."> </input>";
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
	#ACHTUNG! alle felder sollten ausgefüllt werden
	if(isset($_POST["teacher_submit"])) {
		createAccount("teacher", $_POST["email"], $_POST["pwd"], $_POST["name"]);
	} else if(isset($_POST["student_submit"])) {
		createAccount("student", $_POST["email"], $_POST["pwd"], $_POST["name"]);
	} else if(isset($_POST["teacher-del"])) {
		$id = $_POST["teacher-del"];
		$sql = "DELETE FROM teacher WHERE id = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);

		mysqli_stmt_bind_param($stmt, "s", $id);
		mysqli_stmt_execute($stmt);
	} else if(isset($_POST["student-del"])) {
		$id = $_POST["student-del"];
		$sql = "DELETE FROM student WHERE id = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);

		mysqli_stmt_bind_param($stmt, "s", $id);
		mysqli_stmt_execute($stmt);
	}
	?>
	
	<header>
		<center><h1>Account erstellen</h1></center>
	</header>
	<h2>Student</h2>
	<form method="POST">
	<input type="text" placeholder="Name" name="name"> </input>
	<input type="text" placeholder="Email" name="email"> </input>
	<input type="text" placeholder="Password" name="pwd"> </input>

	<input type="submit" name="student_submit"> </input>
	</form>
	<?php
	viewAccounts("student");
	?>

	<h2> Teacher </h2>
	<form method="POST">
	<input type="text" placeholder="Name" name="name"> </input>
	<input type="text" placeholder="Email" name="email"> </input>
	<input type="text" placeholder="Password" name="pwd"> </input>

	<input type="submit" name="teacher_submit"> </input>
	</form>
	<?php
	viewAccounts("teacher");
	?>
</body>
</html>
