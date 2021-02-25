<!DOCTYPE html>
<html lang="de">
	<head>
		<title>Account erstellen</title>
		<link rel="icon" href="../image/faviconMetis.ico" type="image/x-icon" />
		<?php
			session_start();
			if (!isset($_SESSION["cookies"]["allow_set_cookies"]) || $_SESSION["cookies"]["allow_set_cookies"] == false)
				header("Location: ./../");
			if($_SESSION["cookies"]["visual_mode_cookie"] == "bright")
				echo "<link rel=\"stylesheet\" href=\"./../index/style.css\" />\n";
			elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark")
				echo "<link rel=\"stylesheet\" href=\"./../index/style_dark.css\" />\n";
		?>
	</head>
<body>
	<?php
		include("../includes/DbAccess.php");
		if ($conn->connect_errno) {
			echo "<h1>No DB-Connection</h1>";
			exit();
		}
	?>
	<?php
	#ACHTUNG! alle felder sollten ausgefüllt werden
	if(isset($_POST["teacher_submit"])) {
		$sql = "INSERT INTO teacher (email, name, password) VALUES (?, ?, ?)";
		$stmt = mysqli_stmt_init($conn);

		mysqli_stmt_prepare($stmt, $sql);

		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = password_hash($_POST["pwd"], PASSWORD_BCRYPT, array(
			"cost" => 5
		));

		mysqli_stmt_bind_param($stmt, "sss", $email, $name, $password);
		mysqli_stmt_execute($stmt);


	} else if(isset($_POST["student_submit"])) {
		$sql = "INSERT INTO student (email, name, password) VALUES (?, ?, ?)";
		$stmt = mysqli_stmt_init($conn);

		mysqli_stmt_prepare($stmt, $sql);

		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = password_hash($_POST["pwd"], PASSWORD_BCRYPT, array(
			"cost" => 5
		));

		mysqli_stmt_bind_param($stmt, "sss", $email, $name, $password);
		mysqli_stmt_execute($stmt);
	}
	?>
	
	<header>
		<nav><a href="./../index/">zur&uuml;ck</a></nav>
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
	$sql = "SELECT * FROM student";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		foreach($row as $key => $value) {
			echo "<b>$key</b>: $value, ";
		}
		echo "<br>";
	}
	?>

	<h2> Teacher </h2>
	<form method="POST">
	<input type="text" placeholder="Name" name="name"> </input>
	<input type="text" placeholder="Email" name="email"> </input>
	<input type="text" placeholder="Password" name="pwd"> </input>

	<input type="submit" name="teacher_submit"> </input>
	</form>
	<?php
	$sql = "SELECT * FROM teacher";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		foreach($row as $key => $value) {
			echo "<b>$key</b>: $value, ";
		}
		echo "<br>";
	}
	?>
</body>
</html>
